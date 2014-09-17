<?php

Class customersController Extends baseController {

    public function index() {
        $this->registry->template->title = 'ريحانة | العملاء';
        $this->registry->template->show('customers_control');
    }

    function customers_edit() {
        if ($_POST['customer_id'] == 'null') {
            unset($_POST['customer_id']);
            $op_type = 'insert';
        } else {
            $op_type = 'update';
        }

        $check = Operations::get_instance()->init($_POST, 'customers', $op_type);
        if (is_array($check)) {
            echo 'failure!';
        } else {
            echo "success!";
        }
    }

    function customers_del() {
        $check = Operations::get_instance()->init($_POST, 'customers', 'delete');
        if (is_array($check)) {
            echo 'failure!';
        } else {
            echo "success!";
        }
    }

}

?>
