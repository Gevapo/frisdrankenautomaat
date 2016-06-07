<?php
/* bootstrap.php */

ini_set('display_errors', 'On');

define('INC_ROOT', dirname(__DIR__));

/* Doctrine ClassLoader */
require_once INC_ROOT . '/private/vendor/Doctrine/Common/ClassLoader.php';

use Doctrine\Common\ClassLoader;

$classLoader = new ClassLoader('Frisdrank', "private");
$classLoader->register();

/* TWIG */
require_once INC_ROOT . '/private/vendor/Twig/Autoloader.php';

Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem(INC_ROOT . '/private/Frisdrank/Presentation');
$twig = new Twig_Environment($loader);

/* PHPMailer */
require_once INC_ROOT . '/private/vendor/PHPMailer/PHPMailerAutoload.php';

session_start();