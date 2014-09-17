<?php

Class indexController Extends baseController {

    public function index() {

        $this->registry->template->welcome = 'Welcome to PHPRO MVC';


        $this->registry->template->show('index');
    }
    
}

