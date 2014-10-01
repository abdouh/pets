<?php

Class userController Extends baseController {

    public function index() {
        $user_data = Register::get_instance()->get_current_user(1);
        $this->registry->template->user_info = $user_data;
        $this->registry->template->title = 'User | Info';

        $this->registry->template->ads1 = ads::load_ads(1, array(
                    'user_id' => $user_data['id'],
                    'status' => 1
                ));
        $this->registry->template->ads2 = ads::load_ads(1, array(
                    'user_id' => $user_data['id'],
                    'status' => 0
                ));
        $this->registry->template->ads3 = ads::load_ads(1, array(
                    'user_id' => $user_data['id'],
                    'status' => 3
                ));
        $this->registry->template->ads4 = ads::load_ads(1, array(
                    'user_id' => $user_data['id'],
                    'status' => 2
                ));

        $this->registry->template->show('user_info');
    }

    public function get_ads() {
        if (is_numeric($_POST['status'])) {
            $user_data = Register::get_instance()->get_current_user();
            $ads = ads::load_ads(1, array(
                        'user_id' => $user_data['id'],
                        'status' => intval($_POST['status'])
                    ));
            if (!empty($ads))
                echo Temp::ad_container_list($ads);
            else
                echo 'لا توجد اعلانات للعرض';
        }
    }

    public function edit() {
        $this->registry->template->user_info = Register::get_instance()->get_current_user(1);
        $this->registry->template->title = 'User | Edit';
        $this->registry->template->show('user_edit');
    }

    public function update() {
        if (Login::get_instance()->check_login() == 'valid') {
            if ($_POST) {
                $errors = array();
                $user_info = array();
                $user_data = Register::get_instance()->get_current_user();
                $user_info['id'] = $user_data['id'];
                $user_info['username'] = addslashes($_POST['username']);
                $user_info['email'] = addslashes($_POST['email']);
                $user_info['phone'] = intval($_POST['phone']);
                if (!empty($_POST['new_pass']))
                    $user_info['password'] = md5($_POST['new_pass']);

                if ($user_data['password'] != md5($_POST['old_pass']))
                    $errors[] = 'كلمة المرور خاطئة';
                if (md5($_POST['new_pass']) != md5($_POST['new_pass_confirm']))
                    $errors[] = 'خطأ فى تأكيد كلمة المرور';
                if (!is_numeric($_POST['phone']))
                    $errors[] = 'رقم الهاتف غير صحيح';
                if (!Validation::email($_POST['email']))
                    $errors[] = 'البريد الاكترونى غير صحيح';
                if (!empty($_POST['username']) && is_numeric($_POST['username']))
                    $errors[] = 'اسم المستخدم يتكون من حروف فقط';
                a:
                if (empty($errors)) {
                    Operations::get_instance()->init($user_info, 'users', 'update');
                    $this->img_upload();
                    echo json_encode(array('operation' => 1));
                } else {
                    echo json_encode(array('operation' => 2, 'errors' => $errors));
                }
            }
        }
    }

    private function img_upload() {
        if (Login::get_instance()->check_login() == 'valid') {
            $foo = new Upload($_FILES['user_img']);
            if ($foo->uploaded) {
                $this->del();
                $ds = DIRECTORY_SEPARATOR;
                $user_data = Register::get_instance()->get_current_user();
                $storeFolder = '..' . $ds . 'views' . $ds . 'users_img';
                $targetPath = dirname(__FILE__) . $ds . $storeFolder . $ds;
                $targetName = $user_data['id'] . '_' . md5(rand(1, 5000000000));
                while (file_exists($targetName)) {
                    $targetName = $user_data['id'] . '_' . md5(rand(1, 5000000000));
                }
                $targetFile = $targetPath . $targetName . '.jpeg';
                $foo->file_new_name_body = $targetName;
                $foo->image_resize = true;
                $foo->image_convert = 'jpeg';
                $foo->image_x = 1000;
                $foo->image_y = 1000;
                $foo->image_ratio_crop = false;
                //$foo->image_ratio_y = true;
                $foo->Process($targetPath);
                if ($foo->processed) {
                    $foo->Clean();
                    Operations::get_instance()->init(
                            array(
                        'img_name' => $targetName . '.jpeg',
                        'user_id' => $user_data['id'],
                        'time_added' => time(),
                        'date_added' => TimeTools::get_time_id(date('Y-m-d')),
                            ), 'users_img', 'update');
                }
            }
        }
    }

    public function del() {
        $ds = DIRECTORY_SEPARATOR;
        $user_data = Register::get_instance()->get_current_user();
        $storeFolder = '..' . $ds . 'views' . $ds . 'users_img';
        $targetPath = dirname(__FILE__) . $ds . $storeFolder . $ds;
        $images = glob($targetPath . $user_data['id'] . "_*.jpeg");
        foreach ($images as $image) {
            unlink($image);
        }
    }

    public function logout() {
        Login::get_instance()->logout();
    }

}

