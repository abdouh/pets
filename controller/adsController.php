<?php

Class adsController Extends baseController {

    public function index() {
        session_start();
        $this->registry->template->title = 'Ads | Add Ad Here';
        $this->registry->template->show('add_ad');
    }

    public function file_upload() {
        session_start();
        $foo = new Upload($_FILES['file']);
        if ($foo->uploaded) {
            $ds = DIRECTORY_SEPARATOR;
            $user_data = Register::get_instance()->get_current_user();
            $storeFolder = '..' . $ds . 'views' . $ds . 'temp_img';
            $targetPath = dirname(__FILE__) . $ds . $storeFolder . $ds;
            $targetName = $user_data['id'] . '_' . md5(rand(1, 5000000000));
            while (file_exists($targetName)) {
                $targetName = $user_data['id'] . '_' . md5(rand(1, 5000000000));
            }
            $targetFile = $targetPath . $targetName . '.jpeg';
            $foo->file_new_name_body = $targetName;
            $foo->image_resize = true;
            $foo->image_convert = 'jpeg';
            $foo->image_x = 1024;
            $foo->image_y = 768;
            $foo->image_ratio_crop = true;
            //$foo->image_ratio_y = true;
            $foo->Process($targetPath);
            if ($foo->processed) {
                echo $targetFile;
                $foo->Clean();
            }
        }
    }

    public function del() {
        $ds = DIRECTORY_SEPARATOR;
        $user_data = Register::get_instance()->get_current_user();
        $storeFolder = '..' . $ds . 'views' . $ds . 'temp_img';
        $targetPath = dirname(__FILE__) . $ds . $storeFolder . $ds;
        $targetPath = str_replace($ds, "\\$ds", $targetPath);
        $pattern = "/(" . $targetPath . ")(" . $user_data['id'] . ")(.)*(\.jpeg)$/";
        if (preg_match($pattern, $_POST['path'])) {
            unlink($_POST['path']);
        }
    }

    public function processad() {
        if (login::get_instance()->check_login() == 'valid')
            ;

        $user_data = Register::get_instance()->get_current_user();
        if ($_POST) {
            $errors = array();
            $ad_data['title'] = $_POST['title'];
            $ad_data['desc'] = $_POST['desc'];
            $ad_data['pet_id'] = $_POST['pet_id'];
            $ad_data['user_id'] = $user_data['id'];
            $ad_data['type'] = $_POST['type'];
            $ad_data['country'] = $_POST['country'];
            $ad_data['city'] = $_POST['city'];
            $ad_data['time_added'] = time();
            $ad_data['date_added'] = TimeTools::get_time_id(date('Y-m-d'));


            $username = addslashes($_POST['reg_username']);
            $errors[] = 'تأكيد كلمة المرور غير صحيح';

            a:
            if (empty($errors)) {
                $ad_id = Operations::get_instance()->init($ad_data, 'ads');
                $this->procces_img($ad_data['user_id'], $ad_id);
                echo json_encode(array('operation' => 1));
            } else {
                echo json_encode(array('operation' => 2, 'errors' => $errors));
            }
        }
    }

    private function procces_img($user_id, $ad_id) { //
        $ds = DIRECTORY_SEPARATOR;
        //$user_id = 1;
        //$ad_id = 1;
        $storeFolder = '..' . $ds . 'views' . $ds . 'temp_img';
        $newFolder = '..' . $ds . 'views' . $ds . 'users_img';
        $targetPath = dirname(__FILE__) . $ds . $storeFolder . $ds;
        $newPath = dirname(__FILE__) . $ds . $newFolder . $ds;
        $images = glob($targetPath . $user_id . "_*.jpeg");
        foreach ($images as $img) {
            $new_name = $ad_id . '_' . md5(rand(1, 5000000000)) . '.jpeg';
            while (file_exists($newPath . $new_name)) {
                $new_name = $ad_id . '_' . md5(rand(1, 5000000000)) . '.jpeg';
            }
            rename($img, $newPath . $new_name);
            Operations::get_instance()->init(array('ad_id' => $ad_id, 'img_name' => $new_name,
                'time_added' => time(), 'date_added' => TimeTools::get_time_id(date('Y-m-d'))), 'ads_img');
        }
    }

}

