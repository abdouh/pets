<?php

Class contactusController Extends baseController {

    public function index() {
        $this->registry->template->title = 'Pets | Contact Us';
        $this->registry->template->show('contact');
    }

}
