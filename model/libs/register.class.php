<?php

class Register {

    private $user_data;
    private static $instance = NULL;

    static function get_instance() {
        if (self::$instance == NULL)
            self::$instance = new Register();
        return self::$instance;
    }

    function get_current_user($load_img = 0) {
        $user_email = $_SESSION['user_info']['email'];
        $table = db::$tables['users'];
        $query = "SELECT * FROM $table WHERE `email` = '$user_email' LIMIT 1";
        $stmt = db::getInstance()->query($query);
        $result = db::getInstance()->fetchAll($stmt);
        if ($load_img) {
            $table = db::$tables['users_img'];
            $query = "SELECT * FROM $table WHERE `user_id` = '{$result[0]['id']}' LIMIT 1";
            $stmt = db::getInstance()->query($query);
            $result2 = db::getInstance()->fetchAll($stmt);
            $result[0]['img'] = $result2[0]['img_name'];
        }
        return $result[0];
    }

    function get_user($settings = array()) {
        $table = db::$tables['users'];

        foreach ($settings as $setting => $value)
            $query_end = "`$setting` = '$value'";

        $query = "SELECT * FROM $table WHERE $query_end LIMIT 1";
        $stmt = db::getInstance()->query($query);
        $result = db::getInstance()->fetchAll($stmt);
        return $result;
    }

    function new_user($data) {
        $data['status'] = 1;
        $data['time_added'] = time();
        $data['date_added'] = TimeTools::get_time_id(date('Y-m-d'));
        $check = Operations::get_instance()->init($data, 'users');
        Operations::get_instance()->init(
                array(
            //'img_name' => '.jpg',
            'user_id' => $check,
            'time_added' => time(),
            'date_added' => TimeTools::get_time_id(date('Y-m-d')),
                ), 'users_img');
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
        $table = db::$tables['users_emails'];
        $query = "INSERT INTO $table VALUES (NULL,'{$this->user_data['id']}',1,UNIX_TIMESTAMP(NOW()))
            ON DUPLICATE KEY UPDATE `attempts` = `attempts` + 1 , `time` = UNIX_TIMESTAMP(NOW())";
        $stmt = db::getInstance()->query($query);
    }

    function check_user_email($email) {
        $user = $this->get_user(array('email' => $email));
        $table = db::$tables['users_emails'];
        $query = "SELECT * FROM $table WHERE `user_id` = '{$user[0]['id']}'";
        $stmt = db::getInstance()->query($query);
        $result = db::getInstance()->fetchAll($stmt);
        if (($result[0]['sent'] < 3) || ($result[0]['time_added'] < 3))
            return true;
        else
            return false;
    }

    function load_users($page = 1) {

        $elements_per_page = 18;
        $offset = ($page - 1) * $elements_per_page;
        $limit = "$offset,$elements_per_page";

        $table = db::$tables['users'];
        $query = "SELECT count(*) as `count` FROM $table WHERE `status` != '10'";
        $stmt = db::getInstance()->query($query);
        $result = db::getInstance()->fetchAll($stmt);
        $count = $result[0]['count'];

        $query = "SELECT * FROM $table WHERE `status` != '10' LIMIT $limit";
        $stmt = db::getInstance()->query($query);
        $result = db::getInstance()->fetchAll($stmt);

        return array('count' => $count, 'users' => $result);
    }

}
