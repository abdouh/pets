<?php

Class ownersController Extends baseController {

    public function index() {
        $this->registry->template->title = 'ريحانة | المالكين';
        $this->registry->template->show('owners_control');
    }

    function owners_edit() {
        if ($_POST['owner_id'] == 'null') {
            unset($_POST['owner_id']);
            $op_type = 'insert';
        } else {
            $op_type = 'update';
        }

        $check = Operations::get_instance()->init($_POST, 'owners', $op_type);
        if (is_array($check)) {
            echo 'failure!';
        } else {
            echo "success!";
        }
    }

    function owners_del() {
        $check = Operations::get_instance()->init($_POST, 'owners', 'delete');
        if (is_array($check)) {
            echo 'failure!';
        } else {
            echo "success!";
        }
    }

}

?>
