<?php

Class marketsController Extends baseController {

    public function index() {
        $this->registry->template->title = 'ريحانة | الأسواق';
        $this->registry->template->show('markets_control');
    }

    function markets_edit() {
        if ($_POST['market_id'] == 'null') {
            unset($_POST['market_id']);
            $op_type = 'insert';
        } else {
            $op_type = 'update';
        }

        $check = Operations::get_instance()->init($_POST, 'markets', $op_type);
        if (is_array($check)) {
            echo 'failure!';
        } else {
            echo "success!";
        }
    }

    function markets_del() {
        $check = Operations::get_instance()->init($_POST, 'markets', 'delete');
        if (is_array($check)) {
            echo 'failure!';
        } else {
            echo "success!";
        }
    }

}

?>
