<?php

Class indexController Extends baseController {

    public function index() {
        //session_start();
        //Login::get_instance()->logout();


        /* $xml = simplexml_load_file(__SITE_PATH . '/controller/egypt.xml');
          foreach ($xml->children() as $opt) {
          $att = $opt->attributes();
          $city = $att['label'];
          $table = db::$tables['cities'];
          $query = "INSERT INTO $table VALUES(null,'$city',3,'')";
          $stmt = db::getInstance()->query($query);
          $city_id = db::getInstance()->insertId();
          foreach ($opt->children() as $reg) {
          $reg = trim($reg);
          $table = db::$tables['regions'];
          $query = "INSERT INTO $table VALUES(null,'$reg','$city_id','3')";
          $stmt = db::getInstance()->query($query);
          }
          } // end foreach */

        $settings = array();
        if ($_GET) {
            if (isset($_GET['pt']) && is_numeric($_GET['pt']))
                $settings['pet_id'] = intval($_GET['pt']);
            if (isset($_GET['ty']) && is_numeric($_GET['ty']))
                $settings['type'] = intval($_GET['ty']);
            if (isset($_GET['p']) && is_numeric($_GET['p']))
                $settings['page'] = intval($_GET['p']);
        }
        $settings['status'] = 1;

        $this->registry->template->pagination = ads::pagination();
        $this->registry->template->ads = ads::load_ads(1, $settings);
        $this->registry->template->title = 'Home | Pets Services';
        $this->registry->template->show('index');
    }

    public function login() {
        session_start();
        if ($_POST) {
            if (login::get_instance()->check_login() == 'valid')
                goto a;

            $errors = array();
            $block_bypass = false;
            $user_data['email'] = addslashes($_POST['email']);
            $user_data['password'] = md5($_POST['password']);


            $securimage = new Securimage();
            if ($securimage->check($_POST['captcha_code']) == false) {
                
            } else {
                $block_bypass = true;
            }

            $status = login::get_instance()->log_in($user_data, $block_bypass);

            if ($status == 'invalid')
                $errors[] = 'بيانات الدخول التى تم ادخالها غير صحيحة';
            else if ($status == 'blocked')
                $errors[] = 'الكود الذى تم ادخاله غير صحيح';
            else if ($status == 'deactivated')
                $errors[] = 'لقد تم تعطيل هذا الحساب';

            a:
            if (empty($errors)) {
                echo json_encode(array('operation' => 1));
            } else {
                echo json_encode(array('operation' => 2, 'errors' => $errors, 'status' => $status));
            }
        }
    }

    public function captcha() {
        $this->registry->template->show('securimage_show');
    }

    public function register() {
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
            if (empty($username))
                $errors[] = 'يجب ادخال اسم المستخدم';
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

    public function forgotpass() {
        if ($_POST) {
            $errors = array();
            if (login::get_instance()->check_login() == 'valid')
                goto a;

            $email = addslashes($_POST['forgot_email']);

            if (!Validation::email($email)) {
                $errors[] = 'يجب ادخال بريد الكترونى صحيح';
            } else if (!Register::get_instance()->check_exists($email)) {
                $errors[] = 'هذا البريد الالكترونى غير مسجل بالموقع';
            }
            a:
            if (empty($errors)) {
                //Register::get_instance()->forgot_pass($email);
                echo json_encode(array('operation' => 1));
            } else {
                echo json_encode(array('operation' => 2, 'errors' => $errors));
            }
        }
    }

    public function petsCp() {
        $this->registry->template->pagination = ads::pagination();

        $ads = ads::load_ads(0, array(), 1);
        $this->registry->template->total_ads = $ads['count'];
        $this->registry->template->ads = $ads['ads'];

        $users = Register::get_instance()->load_users();
        $this->registry->template->total_users = $users['count'];
        $this->registry->template->users = $users['users'];

        $this->registry->template->title = 'Home | Pets CP';
        $this->registry->template->show('cp');
    }

    public function load_more() {
        if ($_POST) {
            if ($_POST['type'] == 'users' && is_numeric($_POST['value'])) {
                $page = intval($_POST['value']) + 1;
                $users = ads::load_ads(0, array('page' => $page), 1);
                echo empty($users['users']) ? '' : Temp::users_container_rows($users['users']);
            } else if ($_POST['type'] == 'ads' && is_numeric($_POST['value'])) {
                $page = intval($_POST['value']) + 1;
                $ads = ads::load_ads(0, array('page' => $page), 1);
                echo empty($ads['ads']) ? '' : Temp::ad_container_rows($ads['ads']);
            }
        }
    }

    public function handle() {
        if (is_array($_POST['users']) && is_numeric($_GET['t']) && ($_GET['ty'] == 'users')) {
            if ($_GET['t'] == 1)
                $status = 1;
            else
                $status = 2;

            foreach ($_POST['users']as $id) {
                Operations::get_instance()->init(array('id' => intval($id), 'status' => $status), 'users', 'update');
            }
        } else if (is_array($_POST['ads']) && is_numeric($_GET['t']) && ($_GET['ty'] == 'ads')) {
            if ($_GET['t'] == 1)
                $status = 1;
            else
                $status = 2;

            foreach ($_POST['ads']as $id) {
                Operations::get_instance()->init(array('id' => intval($id), 'status' => $status), 'ads', 'update');
            }
        }
    }

    public function logout() {
        Login::get_instance()->logout();
    }

}

