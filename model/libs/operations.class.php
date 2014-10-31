<?php

class Operations {

    private $data;
    private $table_name;
    private $op_type;
    private $clause;
    private $key;
    private $settings;
    private $validations = array();
    private $checks = array();
    private static $instance = null;

    static function get_instance() {
        if (self::$instance == null)
            self::$instance = new operations ();
        return self::$instance;
    }

    function init($data, $table_name, $op_type = 'insert', $clause = '') {
        $this->reset_arrays();
        $this->data = $this->prepare_data($data);
        $this->table_name = $table_name;
        $this->op_type = $op_type;
        $this->grab_settings();
        $this->clause = empty($clause) ? $this->get_clause() : $clause;
        $this->validate();
        if (!in_array(null, $this->validations) && method_exists($this, $this->op_type))
            $return = $this->{$this->op_type}();
        else
            return $this->checks;

        if ($this->op_type == 'insert')
            return $return;

        return true;
    }

    function grab_settings() {
        //file exists check should be implemented here
        $this->settings = include 'settings/' . $this->table_name . '.php';
        $this->key = $this->settings['key'];
    }

    function reset_arrays() {
        $this->data = array();
        $this->table_name = array();
        $this->op_type = null;
        $this->clause = null;
        $this->key = null;
        $this->settings = array();
        $this->validations = array();
        $this->checks = array();
    }

    function pre_validate($data, $table_name, $op_type = 'insert') {
        $this->reset_arrays();
        $this->data = $this->prepare_data($data);
        $this->table_name = $table_name;
        $this->grab_settings();
        $this->validate();
        if (!in_array(null, $this->validations))
            return true;
        else
            return $this->checks;
    }

    function validate() {
        foreach ($this->data as $field => $value) {
            $validations = $this->settings['fields'][$field]['validations'];
            $valid = array();
            foreach ($validations as $validation => $specs) {
                $params[0] = $value;
                if (is_array($specs)) {
                    foreach ($specs as $spec)
                        $params[] = $spec;
                }
                $obj = new Validation();
                if (method_exists('Validation', $validation))
                    $valid[$validation] = forward_static_call_array(array('Validation', $validation), $params);
                else
                    $valid[$validation] = false;
            }
            $this->checks[$field] = $valid;
            $this->validations[$field] = !in_array(null, $valid);
        }
        //print_r($this->checks);
    }

    function prepare_data($data) {
        $new_data = array();
        foreach ($data as $field => $value) {
            $new_data[$field] = filter_var($value, FILTER_SANITIZE_STRING);
        }
        return $new_data;
    }

    function get_clause() {
        return "WHERE `{$this->key}` = '{$this->data[$this->key]}'";
    }

    function insert() {
        $columns = array();
        $values = array();
        foreach ($this->data as $field => $value) {
            $columns[] = "`$field`";
            $values[] = "'$value'";
        }
        $query = "INSERT INTO " . db::$tables[$this->table_name]
                . " (\n" . join(",\n", $columns) . "\n) VALUES (\n" . join(",\n", $values) . "\n)";
        $result = db::getInstance()->query($query);

        return db::getInstance()->insertId();
    }

    function update() {
        $updates = array();
        foreach ($this->data as $field => $value) {
            $updates[] = "`$field` = '$value'";
        }

        $query = "UPDATE " . db::$tables[$this->table_name]
                . " \nSET " . join(",\n", $updates) . "\n" . $this->clause;
        $result = db::getInstance()->query($query);
    }

    function delete() {
        $query = "DELETE FROM " . db::$tables[$this->table_name]
                . "\n" . $this->clause;
        $result = db::getInstance()->query($query);
    }

    function generate_errors() {
        
    }

}
