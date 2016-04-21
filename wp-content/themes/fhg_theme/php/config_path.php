<?php
/* Constant variable for all paths required */
define('DS', '/');

define('SITE_URL',get_site_url());
define('DIR_SITE_ROOT', ABSPATH);

define('SITE_BASE_URL',get_bloginfo('url'));

define('DIR_THEME_ROOT', get_template_directory());
define('THEME_URL', get_template_directory_uri());


define("INC_PATH_IMG", DIR_THEME_ROOT . DS . "images");
define("INC_URL_IMG", THEME_URL . DS . "images");

define("INC_PATH_JS", DIR_THEME_ROOT . DS . "js");
define("INC_URL_JS", THEME_URL . DS . "js");

define("INC_PATH_PHP", DIR_THEME_ROOT . DS . "php");
define("INC_URL_PHP", THEME_URL . DS . "php");

define("INC_PATH_CSS", DIR_THEME_ROOT . DS . "css");
define("INC_URL_CSS", THEME_URL . DS . "css");
define('USEMINI','.min');
/* Constant variable for all paths required */

define("INC_URL_ATTACH", THEME_URL . DS . "attachments");

define("HR_ADMINISTRATOR_EMAIL", "annet.fhg@gmail.com");

// $server = 'Production';
// switch ($server) {
//     case "Live":
//         define("GOOGLE_SITE_KEY","6LfA1w0TAAAAAIrHYoGsZ0Nty-pnYcT3EcMZwsIo");
//         break;
//     case "Production":
//         define("GOOGLE_SITE_KEY","6Lfiyw0TAAAAABAlh3YF-ar8TjfV9z8ESozNwSMI");
//         break;
// }

define("READMORE", custom_translate("Read More", "اقرأ المزيد"));
define ("LEARNMORE", custom_translate('Learn More', 'أعرف أكثر'));
define ("KNOWMORE", custom_translate('Know More', 'تعرف أكثر'));
?>