<?php

class Logs {

    private static $instance;
    private $log_type;

    static function get_instance() {
        if (self::$instance == NULL)
            self::$instance = new logs ();
        return self::$instance;
    }

    function log($data, $type) {
        $this->log_type = $type;
        $method_name = 'log_' . $type;
        if (method_exists('Logs', $method_name))
            $this->$method_name($data);
        else
            $this->log_error($data);
    }

    function log_login($data) {
        $login_date = date('Y-m-d', time());
        $user_id = $data['user_id'];
        $login_ip = $_SERVER;
        $operation_status = 1;
        $is_logged = $data['is_logged'];

        $table = db::$tables['login_logs'];
        $query = "INSERT INTO $table VALUES 
            (NULL, get_time_id('$login_date'), '$user_id', '$login_ip', '$operation_status', '$is_logged')";
        $stmt = db::getInstance()->query($query);
    }

    function log_register($data) {
        $register_date = date('Y-m-d', time());
        $user_id = $data['user_id'];
        $register_ip = $_SERVER;
        $operation_status = 1;

        $table = db::$tables['register_logs'];
        $query = "INSERT INTO $table VALUES 
            (NULL, get_time_id('$register_date'), '$user_id', '$register_ip', '$operation_status')";
        $stmt = db::getInstance()->query($query);
    }

    function log_order($data) {
        $manufacture_date = date('Y-m-d', time());
        $manufacture_status = 1;
        $manufacture_comment = $data['comment'];
        $table = db::$tables['manufacture_logs'];
        $query = "INSERT INTO $table VALUES 
            (NULL, get_time_id('$manufacture_date'), '$manufacture_status', '$manufacture_comment')";
        $stmt = db::getInstance()->query($query);
    }

    function log_sale($data) {
        $sales_date = date('Y-m-d', time());
        $sales_status = 1;
        $sales_comment = $data['comment'];
        $table = db::$tables['sales_logs'];
        $query = "INSERT INTO $table VALUES 
            (NULL, get_time_id('$sales_date'), '$sales_status', '$sales_comment')";
        $stmt = db::getInstance()->query($query);
    }

    function log_error($data) {
        $fp = fopen(LOGS_URL . 'system_errors.php', 'a');

        $str = date('Y-m-d h:i A', time())
                . "\t SYSTEM LOG ERROR - TYPE : {$this->log_type} \t ATTEMPTED DATA " . json_encode($data) . "\n";
        fputs($fp, $str);
        fclose($fp);
    }

    function dump_logs() {
        $fp = fopen(LOGS_URL . 'dump_logs.php', 'r');
        $date = fgets($fp);
        fclose($fp);
        if ($date >= date('Y-m-d', time()))
            return;

        $array = array(
            'login_logs' => LOGS_URL . 'login_logs/',
            'register_logs' => LOGS_URL . 'register_logs/',
            'manufacture_logs' => LOGS_URL . 'manufacture_logs/',
            'sales_logs' => LOGS_URL . 'sales_logs/',
        );

        foreach ($array as $table_name => $file_dir) {
            $table = db::$tables[$table_name];
            $query = "SELECT * FROM $table";
            $stmt = db::getInstance()->query($query);
            $result = db::getInstance()->fetchAll($stmt);

            $fp = fopen($file_dir . 'log-' . date('Y-m-d', time()) . '.php', 'a');
            foreach ($result as $num => $array) {
                $str = date('Y-m-d h:i A', time())
                        . "\t SYSTEM LOG DATA " . json_encode($array) . "\n";
                fputs($fp, $str);
            }

            fclose($fp);

            $query = "TRUNCATE $table";
            $stmt = db::getInstance()->query($query);
        }

        $fp = fopen(LOGS_URL . 'dump_logs.php', 'w');
        fputs($fp, date('Y-m-d', time()));
        fclose($fp);
    }

}
