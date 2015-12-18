<?php
/* Constant variable for all paths required */
define('DS', '/');

define('SITE_URL',get_site_url());
define('DIR_SITE_ROOT', ABSPATH);

define('SITE_BASE_URL',get_bloginfo('url'));

define('DIR_THEME_ROOT', get_template_directory());
define('THEME_URL', get_template_directory_uri());


define("INC_PATH_IMG", DIR_THEME_ROOT . DS . "includes" . DS . "images");
define("INC_URL_IMG", THEME_URL . DS . "includes" . DS . "images");

define("INC_PATH_JS", DIR_THEME_ROOT . DS . "includes" . DS . "js");
define("INC_URL_JS", THEME_URL . DS . "includes" . DS . "js");

define("INC_PATH_PHP", DIR_THEME_ROOT . DS . "includes" . DS . "php");
define("INC_URL_PHP", THEME_URL . DS . "includes" . DS . "php");

define("INC_PATH_CSS", DIR_THEME_ROOT . DS . "includes" . DS . "css");
define("INC_URL_CSS", THEME_URL . DS . "includes" . DS . "css");

/* Constant variable for all paths required */

define("INC_URL_ATTACH", THEME_URL . DS . "includes" . DS . "attachments");

define("HR_ADMINISTRATOR_EMAIL", "babulraheen@gmail.com");
define("GOOGLE_SITE_KEY","6LfA1w0TAAAAAIrHYoGsZ0Nty-pnYcT3EcMZwsIo");
?>