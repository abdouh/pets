<?php

/* * * include the controller class ** */
include __SITE_PATH . '/application/' . 'controller_base.class.php';

/* * * include the registry class ** */
include __SITE_PATH . '/application/' . 'registry.class.php';

/* * * include the router class ** */
include __SITE_PATH . '/application/' . 'router.class.php';

/* * * include the template class ** */
include __SITE_PATH . '/application/' . 'template.class.php';

/* * * auto load model classes ** */

function __autoload($class_name) {
    $filename = strtolower($class_name) . '.class';
    $dir = new RecursiveDirectoryIterator(__SITE_PATH . '/model/');
    $Iterator = new RecursiveIteratorIterator($dir);
    $Regex = new RegexIterator($Iterator, "/^.+($filename)\.php$/i", 1);
    $result = iterator_to_array($Regex);
    include (key($result));
}

/* * * a new registry object ** */
$registry = new registry;
/* * * create the database registry object ** */
$registry->db = db::getInstance();
?>
