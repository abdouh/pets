<?php

session_start();

class Login {

    private $user_data;
    private static $instance = NULL;

    static function get_instance() {
        if (self::$instance == NULL)
            self::$instance = new login();
        return self::$instance;
    }

    function log_in($user_data) {
        $status = $this->check_login($user_data);
        if ($status == 'valid') {
            $this->valid_attempt();
            if (isset($user_data['remember_me']))
                $expire = time() + (30 * 24 * 60 * 60);
            else
                $expire = time() + (2 * 60 * 60);
            $_SESSION['user_info'] = array('username' => $user_data['username'], 'password' => $user_data['password']);
            setcookie('site_id', session_id(), $expire, '/');
        }else if ($status == 'invalid') {
            $this->invalid_attempt();
        }
        return $status;
    }

    function get_data($username) {
        if (!empty($this->user_data))
            return;
        $table = db::$tables['sys_users'];
        $query = "SELECT * FROM $table WHERE `sys_users_name` = '$username' LIMIT 1";
        $stmt = db::getInstance()->query($query);
        $result = db::getInstance()->fetchAll($stmt);
        $this->user_data = $result[0];
    }

    function check_login($user_data = array()) {
        if (empty($user_data))
            $user_data = isset($_SESSION['user_info']) ? $_SESSION['user_info'] : array();
        $username = $user_data['username'];
        $password = $user_data['password'];
        $this->get_data($username);
        if (empty($this->user_data)) {
            return 'invalid';
        }

        if ($this->user_data['is_blocked'] == 1) {
            return 'blocked';
        } else if ($this->user_data['sys_users_password'] == $password) {
            return 'valid';
        } else {
            return 'invalid';
        }
    }

    function invalid_attempt() {
        $table = db::$tables['login_attempts'];
        $query = "INSERT INTO $table VALUES ({$this->user_data['sys_users_id']},1,UNIX_TIMESTAMP(NOW()))
            ON DUPLICATE KEY UPDATE `attempts` = `attempts` + 1 , `time` = UNIX_TIMESTAMP(NOW())";
        $stmt = db::getInstance()->query($query);
    }

    function valid_attempt() {
        $table = db::$tables['login_attempts'];
        $query = "DELETE FROM $table WHERE `sys_users_id` = '{$this->user_data['sys_users_id']}'";
        $stmt = db::getInstance()->query($query);
    }

    function logout() {
        unset($_SESSION['user_info']);
        setcookie('site_id', session_id(), time() - 3600, '/');
    }

}