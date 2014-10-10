<?php

session_start();
error_reporting(E_ALL & ~E_NOTICE);
//ini_set('display_errors', false);

/*if ($_SESSION['d'] == 'abdouhabibi2080') {
    
} else if ($_GET['d'] == 'abdouhabibi2080') {
    $_SESSION['d'] = 'abdouhabibi2080';
} else {
    exit();
}*/

/* * * define the site path ** */
$site_path = realpath(dirname(__FILE__));
define('__SITE_PATH', $site_path);
define('READ_ONLY', 'http://localhost/pets');
define('TEMPLATE_URL', 'http://localhost/pets/views');
define('LOGS_URL', $site_path . '/system_logs');
define('WEB', 1);

/* * * include the init.php file ** */
include 'includes/init.php';

/* * * load the router ** */
$registry->router = new router($registry);

/* * * set the controller path ** */
$registry->router->setPath(__SITE_PATH . '/controller');

/* * * load up the template ** */
$registry->template = new template($registry);

/* * * load the controller ** */
$registry->router->loader();

//Logs::get_instance()->dump_logs();
?>
