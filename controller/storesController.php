<?php

Class storesController Extends baseController {

    public function index() {
        $this->registry->template->title = 'ريحانة | المخازن';
        $this->registry->template->show('stores_control');
    }

    function stores_edit() {
        if ($_POST['store_id'] == 'null') {
            unset($_POST['store_id']);
            $op_type = 'insert';
        } else {
            $op_type = 'update';
        }

        $check = Operations::get_instance()->init($_POST, 'stores', $op_type);
        if (is_array($check)) {
            echo 'failure!';
        } else {
            echo "success!";
        }
    }

    function stores_del() {
        $check = Operations::get_instance()->init($_POST, 'stores', 'delete');
        if (is_array($check)) {
            echo 'failure!';
        } else {
            echo "success!";
        }
    }

}

?>
