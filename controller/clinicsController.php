<?php

Class clinicsController Extends baseController {

    public function index() {
        header("Location: /index");
    }

    public function add() {
        session_start();
        if (Login::get_instance()->check_login() == 'valid') {
            $user_data = Register::get_instance()->get_current_user();
            if ($user_data['status'] != 10) {
                header("Location: /index");
                exit();
            }
            $this->registry->template->title = 'Clinics | Add';
            $this->registry->template->button = 'اضافة العيادة';
            $this->registry->template->show('add_clinic');
        } else {
            header("Location: /index");
        }
    }

    public function edit() {
        if (Login::get_instance()->check_login() == 'valid') {
            if ($_GET['id'] && is_numeric($_GET['id'])) {
                $clinic = ads::load_clinics(array('id' => intval($_GET['id'])));
                $user_data = Register::get_instance()->get_current_user();
                if (($user_data['id'] != $clinic[0]['user_id']) && $user_data['status'] != 10) {
                    header("Location: /index");
                    exit();
                }

                $clinic[0]['phone1'] = substr($clinic[0]['phone1'], 1);
                $clinic[0]['phone2'] = substr($clinic[0]['phone2'], 1);
                $clinic[0]['phone3'] = substr($clinic[0]['phone3'], 1);

                $this->registry->template->clinic = $clinic[0];
                $this->registry->template->button = 'تعديل العيادة';
                $this->registry->template->title = 'Pets | Edit | ' . $clinic[0]['name'];
                $this->registry->template->show('add_clinic');
            } else {
                header("Location: /index");
            }
        } else {
            header("Location: /index");
        }
    }

    public function view() {
        if ($_GET['id'] && is_numeric($_GET['id'])) {
            $clinic = ads::load_clinics(array('id' => intval($_GET['id'])));
            $user_data = Register::get_instance()->get_current_user();
            if (($clinic[0]['status'] == 1) || ($clinic[0]['user_id'] == $user_data['id']) || ($user_data['status'] == 10)) {
                if (($clinic[0]['user_id'] == $user_data['id']) || ($user_data['status'] == 10))
                    $this->registry->template->edit = 1;
                else
                    $this->registry->template->edit = 0;

                $clinic[0]['phone1'] = substr($clinic[0]['phone1'], 1);
                $clinic[0]['phone2'] = substr($clinic[0]['phone2'], 1);
                $clinic[0]['phone3'] = substr($clinic[0]['phone3'], 1);
                $this->registry->template->clinic = $clinic[0];
                $this->registry->template->title = 'Pets | ' . $clinic[0]['name'];
                $this->registry->template->show('view_clinic');
            } else {
                header("Location: /index");
            }
        } else {
            header("Location: /index");
        }
    }

    public function processclinic() {
        if (Login::get_instance()->check_login() == 'valid' && $_POST) {
            $user_data = Register::get_instance()->get_current_user();
            if ($user_data['status'] != 10) {
                exit();
            }
            $errors['rt'] = array();
            $errors['md'] = array();
            $errors['lt'] = array();

            $clinic_data = array();
            $user_data = Register::get_instance()->get_current_user();

            if (!empty($_POST['doc_name']) && trim($_POST['doc_name']) != '')
                $clinic_data['doc_name'] = addslashes($_POST['doc_name']);
            else
                $errors['rt'][] = 'يجب ادخال اسم الدكتور';

            if (!empty($_POST['phone1']) && is_numeric($_POST['phone1']))
                $clinic_data['phone1'] = '1' . $_POST['phone1'];
            else
                $errors['rt'][] = 'يجب ادخال رقم التليفون  1بشكل صحيح';

            if (!empty($_POST['phone2'])) {
                if (!is_numeric($_POST['phone2']))
                    $errors['rt'][] = 'يجب ادخال رقم التليفون 2 بشكل صحيح';
                else
                    $clinic_data['phone2'] = '1' . $_POST['phone2'];
            }

            if (!empty($_POST['phone3'])) {
                if (!is_numeric($_POST['phone3']))
                    $errors['rt'][] = 'يجب ادخال رقم التليفون 3 بشكل صحيح';
                else
                    $clinic_data['phone3'] = '1' . $_POST['phone3'];
            }

            if (!empty($_POST['name']) && trim($_POST['name']) != '')
                $clinic_data['name'] = addslashes($_POST['name']);
            else
                $errors['md'][] = 'يجب ادخال اسم العيادة';



            if (!empty($_POST['desc']) && trim($_POST['desc']) != '')
                $clinic_data['desc'] = addslashes($_POST['desc']);
            else
                $errors['md'][] = 'يجب ادخال مواعيد عمل العيادة';

            if (!empty($_POST['address']) && trim($_POST['address']) != '')
                $clinic_data['address'] = addslashes($_POST['address']);
            else
                $errors['lt'][] = 'يجب ادخال عنوان العيادة';

            if (!empty($_POST['country']))
                $clinic_data['country'] = intval($_POST['country']);
            else {
                $errors['lt'][] = 'يجب اختيار الدولة';
                goto a;
            }
            if (!empty($_POST['city']))
                $clinic_data['city'] = intval($_POST['city']);
            else {
                $errors['lt'][] = 'يجب اختيار المدينة';
                goto a;
            }

            if (!empty($_POST['region']))
                $clinic_data['region'] = intval($_POST['region']);
            else
                $errors['lt'] = 'يجب اختيار المنطقة';

            $clinic_data['user_id'] = $user_data['id'];
            $clinic_data['time_added'] = time();
            $clinic_data['date_added'] = TimeTools::get_time_id(date('Y-m-d'));
            $clinic_data['status'] = 1;
            a:
            if ($_POST['id'] != 'null') {
                $op = 'update';
                if (is_numeric($_POST['id']))
                    $clinic_data['id'] = intval($_POST['id']);
                else
                    $errors['rt'][] = 'خطأ فى اضافة العيادة';
                $type = 'edit';
            } else {
                $op = 'insert';
                $type = 'add';
            }

            if (empty($errors['rt']) && empty($errors['md']) && empty($errors['lt'])) {
                if ($op == 'insert') {
                    $clinic_id = Operations::get_instance()->init($clinic_data, 'clinics');
                    Operations::get_instance()->init(
                            array(
                        'clinic_id' => $clinic_id,
                        'time_added' => time(),
                        'date_added' => TimeTools::get_time_id(date('Y-m-d')),
                            ), 'clinics_img');
                } else {
                    $clinic_id = $clinic_data['id'];
                    Operations::get_instance()->init($clinic_data, 'clinics', 'update');
                }

                $this->img_upload($clinic_id);
                echo json_encode(array('operation' => 1, 'type' => $type, 'id' => $clinic_id));
            } else {
                echo json_encode(array('operation' => 2, 'errors' => $errors));
            }
        }
    }

    private function img_upload($clinic_id) {
        if (Login::get_instance()->check_login() == 'valid') {
            $user_data = Register::get_instance()->get_current_user();
            if ($user_data['status'] != 10) {
                exit();
            }
            $foo = new Upload($_FILES['clinic_img']);
            if ($foo->uploaded) {
                $this->del($clinic_id);
                $ds = DIRECTORY_SEPARATOR;
                $storeFolder = '..' . $ds . 'views' . $ds . 'clinics_img';
                $targetPath = dirname(__FILE__) . $ds . $storeFolder . $ds;
                $targetName = $clinic_id . '_' . md5(rand(1, 5000000000));
                while (file_exists($targetName)) {
                    $targetName = $clinic_id . '_' . md5(rand(1, 5000000000));
                }
                $targetFile = $targetPath . $targetName . '.jpeg';
                $foo->file_new_name_body = $targetName;
                $foo->image_resize = true;
                $foo->image_convert = 'jpeg';
                $foo->image_x = 1024;
                $foo->image_y = 768;
                $foo->image_ratio_crop = false;
                //$foo->image_ratio_y = true;
                $foo->Process($targetPath);
                if ($foo->processed) {
                    $foo->Clean();
                    Operations::get_instance()->init(
                            array(
                        'img_name' => $targetName . '.jpeg',
                        'clinic_id' => $clinic_id,
                        'time_added' => time(),
                        'date_added' => TimeTools::get_time_id(date('Y-m-d')),
                            ), 'clinics_img', 'update');
                }
            }
        }
    }

    public function del($clinic_id) {
        if (Login::get_instance()->check_login() == 'valid') {
            $user_data = Register::get_instance()->get_current_user();
            if ($user_data['status'] != 10) {
                exit();
            }
            $ds = DIRECTORY_SEPARATOR;
            $storeFolder = '..' . $ds . 'views' . $ds . 'clinics_img';
            $targetPath = dirname(__FILE__) . $ds . $storeFolder . $ds;
            $images = glob($targetPath . $clinic_id . "_*.jpeg");
            foreach ($images as $image) {
                unlink($image);
            }
        }
    }

}
