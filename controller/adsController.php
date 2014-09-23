<?php

Class adsController Extends baseController {

    public function index() {
        session_start();
        $this->registry->template->title = 'Ads | Add Ad Here';
        $this->registry->template->show('add_ad');
    }

    public function file_upload() {
        session_start();
        if ($_POST) {
            echo 'no file';
        }
    }

    public function processad() {
        if ($_POST) {
            $errors = array();
            if (login::get_instance()->check_login() == 'valid')
                goto a;

            $username = addslashes($_POST['reg_username']);
            $email = addslashes($_POST['reg_email']);
            $pass = addslashes($_POST['reg_password']);
            $confirm_pass = addslashes($_POST['reg_confirm_pass']);

            if (!Validation::email($email)) {
                $errors[] = 'يجب ادخال بريد الكترونى صحيح';
            } else if (Register::get_instance()->check_exists($email)) {
                $errors[] = 'البريد الالكترونى الذى تم ادخاله مستخدم بالفعل';
            }

            if (empty($pass))
                $errors[] = 'يجب ادخال كلمة مرور';
            else if (strlen($pass) < 6)
                $errors[] = 'يجب أن لا تقل كلمة مرور عن 6 أحرف';

            if ($pass != $confirm_pass)
                $errors[] = 'تأكيد كلمة المرور غير صحيح';

            a:
            if (empty($errors)) {
                Register::get_instance()->new_user(array('email' => $email,
                    'username' => $username, 'password' => md5($pass)));
                echo json_encode(array('operation' => 1));
            } else {
                echo json_encode(array('operation' => 2, 'errors' => $errors));
            }
        }
    }

}

