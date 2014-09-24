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
        if (!$foo->uploaded) {
            $ds = DIRECTORY_SEPARATOR;
            $user_data = Register::get_instance()->get_current_user();
            $storeFolder = '..' . $ds . 'views' . $ds . 'temp_img';

            $targetPath = dirname(__FILE__) . $ds . $storeFolder . $ds;
            $targetName = $user_data['id'] . '_' . md5(rand(1, 500));
            $targetFile = $targetPath . $targetName . '.jpeg';

            $foo->file_new_name_body = $targetName;
            $foo->image_resize = true;
            $foo->image_convert = 'jpeg';
            $foo->image_x = 1024;
            $foo->image_y = 698;
            //$foo->image_ratio_y = true;
            $foo->Process($targetPath);
            if ($foo->processed) {
                echo $targetFile;
                $foo->Clean();
            }
        }
    }

    public function del() {
        $file = $_POST['path'];
        unlink($file);
    }

    public function processad() {
        if (login::get_instance()->check_login() == 'valid')
            ;

        if ($_POST) {
            $errors = array();



            $username = addslashes($_POST['reg_username']);
            $errors[] = 'تأكيد كلمة المرور غير صحيح';

            a:
            if (empty($errors)) {

                echo json_encode(array('operation' => 1));
            } else {
                echo json_encode(array('operation' => 2, 'errors' => $errors));
            }
        }
    }

}

