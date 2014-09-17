<?php

Class tradersController Extends baseController {

    public function index() {
        $this->registry->template->title = 'ريحانة | التجار';
        $this->registry->template->show('traders_control');
    }

    function traders_edit() {
        if ($_POST['trader_id'] == 'null') {
            unset($_POST['trader_id']);
            $op_type = 'insert';
        } else {
            $op_type = 'update';
        }

        $check = Operations::get_instance()->init($_POST, 'traders', $op_type);
        if (is_array($check)) {
            echo 'failure!';
        } else {
            echo "success!";
        }
    }

    function traders_del() {
        $check = Operations::get_instance()->init($_POST, 'traders', 'delete');
        if (is_array($check)) {
            echo 'failure!';
        } else {
            echo "success!";
        }
    }

}

?>
