<?php

Class loginController Extends baseController {

    public function index() {
        //logs::get_instance()->log(array('id' => 2, 'user' => 'hi'), 'hey');
        //login::get_instance()->logout();
        $status = login::get_instance()->check_login();
        if ($status == 'valid') {
            $this->registry->template->title = "ريحانة | تم الدخول";
            $this->registry->template->show('login');
        } else {
            if ($_POST) {
                $user_data['username'] = mysql_real_escape_string($_POST['username']);
                $user_data['password'] = md5($_POST['password']);
                $status = login::get_instance()->log_in($user_data);
                if ($status == 'blocked') {
                    $this->registry->template->title = "ريحانة | تم إيقاف الحساب !";
                    $this->registry->template->show('blocked');
                    return;
                } else if ($status == 'valid') {
                    header('location:' . ROOT_URL);
                } else {
                    $this->registry->template->error = 'البيانات التى أدخلتها غير صحيحة';
                }
            }
            $this->registry->template->title = "ريحانة | الدخول الى البرنامج";
            $this->registry->template->show('login');
        }
    }

    public function stats() {
        $this->registry->template->welcome = 'viewing stats';
        $this->registry->template->show('index');
    }

}

?>
