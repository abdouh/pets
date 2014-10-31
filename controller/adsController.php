<?php

Class adsController Extends baseController {

    public function index() {
        session_start();
        if (Login::get_instance()->check_login() == 'valid') {
            $this->registry->template->title = 'Ads | Add';
            $this->registry->template->button = 'اضافة الاعلان';
            $this->registry->template->show('add_ad');
        } else {
            header("Location: /index");
        }
    }

    public function edit() {
        if (Login::get_instance()->check_login() == 'valid') {
            if ($_GET['id'] && is_numeric($_GET['id'])) {
                $ad = ads::load_ads(5, array('id' => intval($_GET['id'])));
                $user_data = Register::get_instance()->get_current_user();
                if (($user_data['id'] != $ad[0]['user_id']) && $user_data['status'] != 10) {
                    header("Location: /index");
                }
                $this->registry->template->ad = $ad[0];
                $this->registry->template->button = 'تعديل الاعلان';
                $this->registry->template->title = 'Pets | Edit | ' . $ad[0]['title'];
                $this->registry->template->show('add_ad');
            } else {
                header("Location: /ads");
            }
        } else {
            header("Location: /index");
        }
    }

    public function view() {
        if ($_GET['id'] && is_numeric($_GET['id'])) {
            $ad = ads::load_ads(5, array('id' => intval($_GET['id'])));
            $user_data = Register::get_instance()->get_current_user();
            if (($ad[0]['status'] == 1) || ($ad[0]['user_id'] == $user_data['id']) || ($user_data['status'] == 10)) {

                if (($ad[0]['user_id'] == $user_data['id']) || ($user_data['status'] == 10))
                    $this->registry->template->edit = 1;
                else
                    $this->registry->template->edit = 0;

                $this->registry->template->activate = 0;
                $this->registry->template->ad = $ad[0];
                $user = Register::get_instance()->get_user(array('id' => $ad[0]['user_id']));
                $this->registry->template->phone = $user[0]['phone'];
                $this->registry->template->title = 'Pets | ' . $ad[
                        0]['title'];
                $this->registry->template->show('view_ad');
            } else {
                header("Location: /index");
            }
        } else {
            header("Location: /index");
        }
    }

    public function activate() {
        if (Login::get_instance()->check_login() == 'valid') {
            $user_data = Register::get_instance()->get_current_user();
            if ($user_data['status'] != 10) {
                header("Location: /index");
                exit();
            }
            if (is_numeric($_POST['count']) && is_numeric($_POST['type'])) {
                if ($_POST[
                        'type'] == 1)
                    $offset = intval($_POST ['count']) + 1;
                else if ($_POST['type'] == 2)
                    $offset = intval($_POST['count']) - 1;

                if ($offset < 0)
                    $offset = 0;

                $ad = ads::load_ads(5, array('limit' => 1, 'offset' => $offset, 'status' => 0));
                $counter = 0;
                while (empty($ad) && $counter <= 7) {
                    $counter++;
                    $offset = $offset - 1;
                    $ad = ads::load_ads(5, array('limit' => 1, 'offset' => $offset, 'status' => 0));
                }
            } else {
                $offset = 0;
                $ad = ads::load_ads(5, array('limit' => 1, 'status' => 0));
            }

            if (empty($ad)) {
                $this->registry->template->ad = array();
                $this->registry->template->activate = 0;
            } else {
                $this->registry->template->ad = $ad[0];
                $this->registry->template->activate = 1;
            }
            $this->registry->template->offset = $offset;
            $this->registry->template->title = 'Pets | activate | ' . $ad [0]['title'];
            $this->registry->template->show('view_ad');
        } else {
            header("Location: /index");
        }
    }

    public function activate_ad() {
        if (Login::get_instance()->check_login() == 'valid') {
            $user_data = Register::get_instance()->get_current_user();

            if ($user_data['status'] != 10) {
                exit();
            }
            if (is_numeric($_POST['ad_id']) && is_numeric($_POST['activate'])) {
                if (intval($_POST['activate'] == 1))
                    $status = 1;
                else
                    $status = 2;

                Operations::get_instance()->init(array(
                    'id' => intval($_POST['ad_id']),
                    'status' => $status
                        ), 'ads', 'update');
            }
        }
    }

    public function ad_phone() {
        if (is_numeric($_POST['ad_id'])) {
            $ad = ads::load_ads(1, array('id' => intval($_POST['ad_id'])));
            $user_data = Register::get_instance()->get_current_user();
            if (($ad[0]['status'] == 1) || ($ad[0]['user_id'] == $user_data['id']) || ($user_data['status'] == 10)) {
                $user = Register::get_instance()->get_user(array('id' => $ad[0]['user_id']));
                echo $user[0]['phone'];
            }
        }
    }

    public function jsload() {
        $type = intval($_POST['type']);
        $data = intval($_POST['data']);
        $ad_type = intval($_POST['ad_type']);
        switch ($type) {
            case 1:
                echo '<option value="">اختار المدينة</option>';
                echo Temp:: load_list_options('ads_cities', 0, array($data));
                break;
            case 2:
                echo '<option value="">اختار المنطقة</option>';
                echo Temp::load_list_options('ads_regions', 0, array($data));
                break;

            case 3:
                echo '<option value="351">الكل</option>';
                echo Temp::load_list_options('ads_pets', 0, array($data, $ad_type));
                break;
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
                    echo $targetName;
                    $foo->Clean();
                }
            }
        }
    }

    public function del() {
        if (Login::get_instance()->check_login() == 'valid') {
            $ds = DIRECTORY_SEPARATOR;
            $user_data = Register::get_instance()->get_current_user();
            $storeFolder = '..' . $ds . 'views' . $ds . 'temp_img';
            $targetPath = dirname(__FILE__) . $ds .
                    $storeFolder . $ds;
            $pattern = "/^(" . $user_data['id'] . "_)(.)*/";
            if (preg_match($pattern, $_POST['f'])) {
                unlink($targetPath . $_POST['f'] . '.jpeg');
            }
        }
    }

    public function processad() {
        if (Login::get_instance()->check_login() == 'valid' && $_POST) {
            $errors['rt'] = array();
            $errors['md'] = array()
            ;
            $errors['lt'] = array();

            $ad_data = array();
            $user_data = Register::get_instance()->get_current_user();

            if (!empty($_POST['type']) && is_numeric($_POST[
                            'type']))
                $ad_data['type'] = intval($_POST['type']);
            else
                $errors['rt'][] = 'يجب اختيار نوع الاعلان';

            if (!empty($_POST['pet']) && is_numeric($_POST['type'
                    ]))
                $ad_data['pet_id'] = intval($_POST['pet']);
            else
                $errors['rt'][] = 'يجب اختيار نوع الحيوان';

            if (!empty($_POST ['title']) && trim($_POST ['title']) != '')
                $ad_data['title'] = addslashes($_POST['title']);
            else
                $errors['rt'][] = 'يجب ادخال عنوان للاعلان';

            if (!empty($_POST ['desc']) && trim($_POST['desc']) != '')
                $ad_data['desc'] = addslashes($_POST['desc']);
            else
                $errors['md'][] = 'يجب ادخال معلومات الاعلان';

            if (!empty($_POST['price']) && is_numeric(
                            $_POST['price']))
                $ad_data['price'] = $_POST['price'];
            else
                $errors['md'][] = 'يجب كتابة سعر';

            if (!empty($_POST['currency']) &&
                    is_numeric($_POST['currency']))
                $ad_data['currency'] = intval($_POST['currency']);
            else
                $errors['md'][] = 'يجب اختيار العملة';

            if (!empty($_POST['country']))
                $ad_data['country'] = intval($_POST['country']);
            else {
                $errors['lt'][] = 'يجب اختيار الدولة';
                goto a;
            }
            if (!empty($_POST['city']))
                $ad_data['city'] = intval($_POST['city']);
            else {
                $errors['lt'][] = 'يجب اختيار المدينة';
                goto a;
            }

            if (!empty($_POST['region']))
                $ad_data['region'] = intval($_POST['region']);
            else
                $errors['lt'] = 'يجب اختيار المنطقة';

            $ad_data['cat_id'] = intval($_POST ['cat']);
            $ad_data['user_id'] = $user_data ['id'];
            $ad_data['time_added'] = time();
            $ad_data['date_added'] = TimeTools::get_time_id(date('Y-m-d'));

            a:


            if ($_POST['id'] != 'null') {
                if ($user_data['status'
                        ] != 10)
                    $ad_data['status'] = 0;
                $op = 'update';
                if (is_numeric($_POST['id']))
                    $ad_data['id'] = intval($_POST['id']);
                else
                    $errors['rt'][] = 'خطأ فى اضافة الاعلان';
                $img_check = $this->check_img($ad_data['user_id'], $ad_data['id']);
                $type = 'edit';
            }else {


                $op = 'insert';
                $img_check = $this->check_img($ad_data['user_id'], 'null');
                $type = 'add';
            }
            if ((
                    $img_check !== true) && empty($errors['rt']))
                $errors['rt'][] = $img_check;


            if (empty($errors['rt']) && empty($errors['md']) && empty($errors['lt'])) {
                if ($op == 'insert')
                    $ad_id = Operations::get_instance()->init($ad_data, 'ads');
                else {
                    $ad_id = $ad_data['id'];
                    Operations::get_instance()->init($ad_data, 'ads', 'update');
                }

                $this->procces_img($ad_data[
                        'user_id'], $ad_id);
                echo json_encode(array('operation' => 1, 'type' => $type));
            } else {
                echo json_encode(array('operation' => 2, 'errors' => $errors));
            }
        }
    }

    private function check_img($user_id, $ad_id) {
        if (Login::get_instance()->check_login() == 'valid') {
            $ds = DIRECTORY_SEPARATOR;
            $storeFolder = '..' . $ds . 'views' . $ds . 'temp_img';
            $newFolder = '..' . $ds . 'views' . $ds . 'ads_img';
            $targetPath = dirname(__FILE__) . $ds . $storeFolder .
                    $ds;
            $newPath = dirname(__FILE__) . $ds
                    . $newFolder . $ds;
            $images = glob($targetPath . $user_id . "_*.jpeg");
            if ($ad_id == 'null') {
                if (!empty($images))
                    return true;
                else
                    return 'يجب وضع صورة واحدة على الأقل';
            }else {
                $images2 = glob($newPath .
                        $ad_id . "_*.jpeg");
                $count = count($images) + count($images2);

                if ($count == 0)
                    return 'يجب وضع صورة واحدة على الأقل';
                else if ($count > 5)
                    return 'لا يمكن اختيار أكثر من 5 صور';
                else
                    return true;
            }
        }
    }

    private function procces_img($user_id, $ad_id) { //
        if (Login::get_instance()->check_login() == 'valid') {
            $ds = DIRECTORY_SEPARATOR;
            $storeFolder = '..' . $ds . 'views' . $ds . 'temp_img';
            $newFolder = '..' . $ds . 'views' . $ds . 'ads_img';
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

}
