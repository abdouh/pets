<?php
session_start();
/* * * error reporting on ** */
error_reporting(E_ALL & ~E_NOTICE);

/* * * define the site path ** */
$site_path = realpath(dirname(__FILE__));
define('__SITE_PATH', $site_path);
define('READ_ONLY', 'http://localhost/pets');
define('TEMPLATE_URL', 'http://localhost/pets/views');
define('LOGS_URL', $site_path . '/system_logs');

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
