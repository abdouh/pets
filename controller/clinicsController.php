<?php

Class clinicsController Extends baseController {

    public function index() {
        
    }

    public function add() {
        session_start();
        if (Login::get_instance()->check_login() == 'valid') {
            $this->registry->template->title = 'Clinics | Add';
            $this->registry->template->button = 'اضافة العيادة';
            $this->registry->template->show('add_clinic');
        } else {
            header("Location: /pets/");
        }
    }

    public function views() {
        session_start();
        if (Login::get_instance()->check_login() == 'valid') {
            $this->registry->template->title = 'Clinics | Add';
            $this->registry->template->button = 'اضافة العيادة';
            $this->registry->template->show('view_clinic');
        } else {
            header("Location: /pets/");
        }
    }

    public function edit() {
        if (Login::get_instance()->check_login() == 'valid') {
            if ($_GET['id'] && is_numeric($_GET['id'])) {
                $ad = ads::load_ads(5, array('id' => intval($_GET['id'])));
                $user_data = Register::get_instance()->get_current_user();
                if (($user_data['id'] != $ad[0]['user_id']) && $user_data['status'] != 10) {
                    header("Location: /pets/");
                }
                $this->registry->template->ad = $ad[0];
                $this->registry->template->button = 'تعديل العيادة';
                $this->registry->template->title = 'Pets | Edit | ' . $ad[0]['title'];
                $this->registry->template->show('add_ad');
            } else {
                header("Location: /pets/ads");
            }
        } else {
            header("Location: /pets/");
        }
    }

    public function view() {
        if ($_GET['id'] && is_numeric($_GET['id'])) {
            $ad = ads::load_ads(5, array('id' => intval($_GET['id'])));
            $this->registry->template->activate = 0;
            $this->registry->template->ad = $ad[0];
            $user = Register::get_instance()->get_user(array('id' => $ad[0]['user_id']));
            $this->registry->template->phone = $user[0]['phone'];
            $this->registry->template->title = 'Pets | ' . $ad[0]['title'];
            $this->registry->template->show('view_ad');
        } else {
            header("Location: /pets/");
        }
    }

    public function processad() {
        if (Login::get_instance()->check_login() == 'valid' && $_POST) {
            $errors['rt'] = array();
            $errors['md'] = array();
            $errors['lt'] = array();

            $ad_data = array();
            $user_data = Register::get_instance()->get_current_user();

            if (!empty($_POST['type']))
                $ad_data['type'] = intval($_POST['type']);
            else
                $errors['rt'][] = 'يجب اختيار نوع الاعلان';

            if (!empty($_POST['pet']))
                $ad_data['pet_id'] = intval($_POST['pet']);
            else
                $errors['rt'][] = 'يجب اختيار نوع الحيوان';

            if (!empty($_POST['title']) && trim($_POST['title']) != '')
                $ad_data['title'] = addslashes($_POST['title']);
            else
                $errors['md'][] = 'يجب ادخال عنوان للاعلان';

            if (!empty($_POST['desc']) && trim($_POST['desc']) != '')
                $ad_data['desc'] = addslashes($_POST['desc']);
            else
                $errors['md'][] = 'يجب ادخال معلومات الاعلان';

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

            $ad_data['cat_id'] = intval($_POST['cat']);
            $ad_data['user_id'] = $user_data['id'];
            $ad_data['time_added'] = time();
            $ad_data['date_added'] = TimeTools::get_time_id(date('Y-m-d'));

            a:
            if ($_POST['id'] != 'null') {
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
            if (($img_check !== true) && empty($errors['rt']))
                $errors['rt'][] = $img_check;


            if (empty($errors['rt']) && empty($errors['md']) && empty($errors['lt'])) {
                if ($op == 'insert')
                    $ad_id = Operations::get_instance()->init($ad_data, 'ads');
                else {
                    $ad_id = $ad_data['id'];
                    Operations::get_instance()->init($ad_data, 'ads', 'update');
                }

                $this->procces_img($ad_data['user_id'], $ad_id);
                echo json_encode(array('operation' => 1, 'type' => $type));
            } else {
                echo json_encode(array('operation' => 2, 'errors' => $errors));
            }
        }
    }

    private function img_upload() {
        if (Login::get_instance()->check_login() == 'valid') {
            $foo = new Upload($_FILES['clinic_img']);
            if ($foo->uploaded) {
                $this->del();
                $ds = DIRECTORY_SEPARATOR;
                $user_data = Register::get_instance()->get_current_user();
                $storeFolder = '..' . $ds . 'views' . $ds . 'clinics_img';
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
        if (Login::get_instance()->check_login() == 'valid') {
            $ds = DIRECTORY_SEPARATOR;
            $user_data = Register::get_instance()->get_current_user();
            $storeFolder = '..' . $ds . 'views' . $ds . 'users_img';
            $targetPath = dirname(__FILE__) . $ds . $storeFolder . $ds;
            $images = glob($targetPath . $user_data['id'] . "_*.jpeg");
            foreach ($images as $image) {
                unlink($image);
            }
        }
    }

}
