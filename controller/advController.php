<?php

Class advController Extends baseController {

    public function index() {
        $this->registry->template->title = 'ريحانة | advanced table';
        $this->registry->template->show('advanced_table');
    }
}

?>
