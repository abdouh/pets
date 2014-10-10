<?php

class Login {

    private $user_data;
    private static $instance = NULL;

    static function get_instance() {
        if (self::$instance == NULL)
            self::$instance = new Login();
        return self::$instance;
    }

    function log_in($user_data, $block_bypass = false) {
        $status = $this->check_login($user_data, $block_bypass);
        if ($status == 'valid') {
            $this->valid_attempt();
            if (isset($user_data['remember_me']))
                $expire = time() + (30 * 24 * 60 * 60);
            else
                $expire = time() + (2 * 60 * 60);
            $_SESSION['user_info'] = array('email' => $user_data['email'], 'password' => $user_data['password']);
            setcookie('site_id', session_id(), $expire, '/pets/');
        }else if ($status == 'invalid') {
            $this->invalid_attempt();
        } else if ($status == 'empty') {
            $status = 'invalid';
        }
        return $status;
    }

    function check_login($user_data = array(), $block_bypass = false) {
        if (empty($user_data))
            $user_data = isset($_SESSION['user_info']) ? $_SESSION['user_info'] : array();

        if (empty($user_data))
            return 'invalid';

        $email = $user_data['email'];
        $password = $user_data['password'];

        $this->get_data($email);

        if (empty($this->user_data))
            return 'empty';

        else if (($this->user_data['is_blocked'] == 1) && !$block_bypass)
            return 'blocked';

        else if (($this->user_data['password'] == $password) && ($this->user_data['status'] != 1) && ($this->user_data['status'] != 10))
            return 'deactivated';

        else if ($this->user_data['password'] == $password)
            return 'valid';

        else
            return 'invalid';
    }

    function get_data($email) {
        if (!empty($this->user_data))
            return;
        $table = db::$tables['users'];
        $query = "SELECT * FROM $table WHERE `email` = '$email' LIMIT 1";
        $stmt = db::getInstance()->query($query);
        $result = db::getInstance()->fetchAll($stmt);
        $this->user_data = $result[0];
    }

    function invalid_attempt() {
        $table = db::$tables['login_attempts'];
        $query = "INSERT INTO $table VALUES (NULL,'{$this->user_data['id']}',1,UNIX_TIMESTAMP(NOW()))
            ON DUPLICATE KEY UPDATE `attempts` = `attempts` + 1 , `time` = UNIX_TIMESTAMP(NOW())";
        $stmt = db::getInstance()->query($query);
    }

    function valid_attempt() {
        $table = db::$tables['login_attempts'];
        $query = "DELETE FROM $table WHERE `user_id` = '{$this->user_data['id']}'";
        $stmt = db::getInstance()->query($query);
        $table = db::$tables['users'];
        $query = "UPDATE $table SET `is_blocked` = 0 WHERE `id` = '{$this->user_data['id']}'";
        $stmt = db::getInstance()->query($query);
    }

    function logout() {
        if (isset($_SESSION['user_info'])) {
            unset($_SESSION['user_info']);
            setcookie('site_id', session_id(), time() - 3600, '/pets/');
        }
    }

}