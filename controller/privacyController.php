<?php

Class privacyController Extends baseController {

    public function index() {
        $this->registry->template->title = 'Pets | Privacy';
        $this->registry->template->show('privacy');
    }

}
