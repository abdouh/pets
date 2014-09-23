<?php

class Register {

    private $user_data;
    private static $instance = NULL;

    static function get_instance() {
        if (self::$instance == NULL)
            self::$instance = new Register();
        return self::$instance;
    }

    function new_user($data) {
        $data['time_added'] = time();
        $data['date_added'] = TimeTools::get_time_id(date('Y-m-d'));
        $check = Operations::get_instance()->init($data, 'users');
    }

    function check_exists($email) {
        $table = db::$tables['users'];
        $query = "SELECT * FROM $table WHERE `email` = '$email' LIMIT 1";
        $stmt = db::getInstance()->query($query);
        $result = db::getInstance()->fetchAll($stmt);
        if (!empty($result))
            return true;
        else
            return false;
    }

    function forgot_pass($email) {
        
    }

}