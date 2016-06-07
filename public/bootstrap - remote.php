<?php
/* bootstrap.php */

ini_set('display_errors', 'Off');

define('INC_ROOT', dirname(__DIR__));

/* Doctrine ClassLoader */
require_once INC_ROOT . '/private/vendor/Doctrine/Common/ClassLoader.php';

use Doctrine\Common\ClassLoader;

$classLoader = new ClassLoader("Project", "private");
$classLoader->register();

/* TWIG */
require_once INC_ROOT . '/private/vendor/Twig/Autoloader.php';

Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem(INC_ROOT . '/private/Project/Presentation');
$twig = new Twig_Environment($loader);

/* PHPMailer */
require_once INC_ROOT . '/private/vendor/PHPMailer/PHPMailerAutoload.php';

session_start();