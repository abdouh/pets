<?php

Class aboutusController Extends baseController {

    public function index() {
        $this->registry->template->title = 'Pets | About Us';
        $this->registry->template->show('about');
    }

}
