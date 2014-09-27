<?php

Class adsController Extends baseController {

    public function index() {
        session_start();
        if (Login::get_instance()->check_login() == 'valid') {
            $this->registry->template->title = 'Ads | Add Ad Here';
            $this->registry->template->show('add_ad');
        } else {
            header("Location: /pets/");
        }
    }

    public function view() {
        if ($_GET['id'] && is_numeric($_GET['id'])) {
            $ad = ads::load_ads(5, array('id' => intval($_GET['id'])));
            print_r($ad);
            $this->registry->template->ad = $ad;
            $this->registry->template->title = 'Pets | ' . $ad[0]['title'];
            $this->registry->template->show('view_ad');
        } else {
            header("Location: /pets/");
        }
    }

    public function jsload() {
        if (Login::get_instance()->check_login() == 'valid' && $_POST) {
            $type = intval($_POST['type']);
            $data = intval($_POST['data']);
            switch ($type) {
                case 1:
                    echo '<option value="">اختار المدينة</option>';
                    echo Temp::load_list_options('ads_cities', array($data));
                    break;
                case 2:
                    echo '<option value="">اختار المنطقة</option>';
                    echo Temp::load_list_options('ads_regions', array($data));
                    break;
                case 3:
                    echo '<option value="">اختار النوع</option>';
                    echo Temp::load_list_options('ads_pets', array($data));
                    break;
            }
        }
    }

    public function file_upload() {
        session_start();
        if (Login::get_instance()->check_login() == 'valid') {
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
        if (Login::get_instance()->check_login() == 'valid' && $_POST) {
            $errors = array();
            $ad_data = array();
            $user_data = Register::get_instance()->get_current_user();

            if (!empty($_POST['type']))
                $ad_data['type'] = intval($_POST['type']);
            else
                $errors[] = 'يجب اختيار نوع الاعلان';

            if (!empty($_POST['pet']))
                $ad_data['pet_id'] = intval($_POST['pet']);
            else
                $errors[] = 'يجب اختيار نوع الحيوان';

            if (!empty($_POST['title']) && trim($_POST['title']) != '')
                $ad_data['title'] = addslashes($_POST['title']);
            else
                $errors[] = 'يجب ادخال عنوان للاعلان';

            if (!empty($_POST['desc']) && trim($_POST['desc']) != '')
                $ad_data['desc'] = addslashes($_POST['desc']);
            else
                $errors[] = 'يجب ادخال معلومات الاعلان';

            if (!empty($_POST['country']))
                $ad_data['country'] = intval($_POST['country']);
            else {
                $errors[] = 'يجب اختيار الدولة';
                goto a;
            }
            if (!empty($_POST['city']))
                $ad_data['city'] = intval($_POST['city']);
            else {
                $errors[] = 'يجب اختيار المدينة';
                goto a;
            }

            if (!empty($_POST['region']))
                $ad_data['region'] = intval($_POST['region']);
            else
                $errors[] = 'يجب اختيار المنطقة';
            $ad_data['cat_id'] = intval($_POST['cat']);
            $ad_data['user_id'] = $user_data['id'];
            $ad_data['time_added'] = time();
            $ad_data['date_added'] = TimeTools::get_time_id(date('Y-m-d'));


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

