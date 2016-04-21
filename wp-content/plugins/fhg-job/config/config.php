<?php

global $wpdb;
$tablename = "fhg_fh_fhg_job";
$apptablename = "fhg_fh_fhg_jobapplicants";
$settingstablename ="fhg_fh_fhg_job_settings";
$upload_dir = wp_upload_dir();
define('JS_TABLENAME', $tablename);
define('APP_TABLENAME', $apptablename);
define('SETTINGS_TABLENAME', $settingstablename);
define('LIMIT', 30);
define('DS', '/');
define('JS_INCLUDES', WP_PLUGIN_URL . DS . 'fhg-job' . DS . 'includes');
define('JS_INCLUDES_DIR', WP_PLUGIN_DIR . DS . 'fhg-job' . DS . 'includes');
define('JS_INCLUDES_JS', WP_PLUGIN_URL . DS . 'fhg-job' . DS . 'includes' . DS . 'js');
define('JS_INCLUDES_JS_DIR', WP_PLUGIN_DIR . DS . 'fhg-job' . DS . 'includes' . DS . 'js');
define('JS_INCLUDES_CSS', WP_PLUGIN_URL . DS . 'fhg-job' . DS . 'includes' . DS . 'css');
define('JS_INCLUDES_CSS_DIR', WP_PLUGIN_DIR . DS . 'fhg-job' . DS . 'includes' . DS . 'css');
define('JS_INCLUDES_CSS_IMAGES', WP_PLUGIN_URL . DS . 'fhg-job' . DS . 'includes' . DS . 'css' . DS . 'images');
define('JS_INCLUDES_CSS_IMAGES_DIR', WP_PLUGIN_DIR . DS . 'fhg-job' . DS . 'includes' . DS . 'css' . DS . 'images');
define('JS_INCLUDES_ADMIN', WP_PLUGIN_URL . DS . 'fhg-job' . DS . 'includes' . DS . 'admin');
define('JS_INCLUDES_ADMIN_DIR', WP_PLUGIN_DIR . DS . 'fhg-job' . DS . 'includes' . DS . 'admin');
define('JS_INCLUDES_ADMIN_IMAGES', WP_PLUGIN_URL . DS . 'fhg-job' . DS . 'includes' . DS . 'admin' . DS . 'images');
define('JS_INCLUDES_ADMIN_IMAGES_DIR', WP_PLUGIN_DIR . DS . 'fhg-job' . DS . 'includes' . DS . 'admin' . DS . 'images');
define('JS_INCLUDES_ADMIN_CLASS_DIR', WP_PLUGIN_DIR . DS . 'fhg-job' . DS . 'includes' . DS . 'admin' . DS . 'class');
define('DOCUMENT_UPLOADS', WP_PLUGIN_DIR . DS . 'fhg-job' . DS . 'includes' . DS . uploads);
define('DOCUMENT_UPLOADS_URL', $upload_dir['url']);

?>