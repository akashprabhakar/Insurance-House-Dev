<?php
/*
Plugin Name: FHG E-Cards
Description: To send html5 ecards to users
Version: 1
Author: Annet Technologies
Author URI: http://www.annet.com
*/



//---------1846---------------------------

define('ROOTDIR', plugin_dir_path(__FILE__));

define('ECARDS_TABLENAME', 'fhg_capm_ecards');
require_once(ROOTDIR . 'includes/fhg-ecards-class.php');
require_once(ROOTDIR . 'includes/fhg-ecards-delete.php');
//menu items
function ecards_plugin_activate() {
  global $wpdb;

  $sql = "CREATE TABLE IF NOT EXISTS `fhg_capm_ecards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ecard_title` varchar(255) NOT NULL,
  `ecard_html` text NOT NULL,
  `media_url` text NOT NULL,
  `ecard_currentdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
	) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6;";

  require_once(ABSPATH . "wp-admin/includes/upgrade.php");
  dbDelta($sql);  
}

/* Hook Plugin */
register_activation_hook(__FILE__, 'ecards_plugin_activate');


add_action('admin_menu','fhg_ecards_menu');
function fhg_ecards_menu() {
	
	//this is the main item for the menu
	add_menu_page('FHG E-Cards', //page title
	'E-Cards', //menu title
	'manage_options', //capabilities
	'fhg_ecards', //menu slug
	'fhg_ecards_list', //function
	'',9999);
	
	//this is a submenu
	add_submenu_page('fhg_ecards', //parent slug
	'Add New Ecard', //page title
	'Add New', //menu title
	'manage_options', //capability
	'fhg_ecards_create', //menu slug
	'fhg_ecards_create'); //function
	
	//this submenu is HIDDEN, however, we need to add it anyways
	if(isset($_REQUEST['ecard_id'])){
		add_submenu_page('fhg_ecards', //parent slug
		'Edit Ecard', //page title
		'Edit Ecard', //menu title
		'manage_options', //capability
		'fhg_ecards_update', //menu slug
		'fhg_ecards_update'); //function
	}
}

function ecard_scripts() {
 	// wp_enqueue_script('fhg-capm-theme-ecard', ROOTDIR . '/js/ecard.js', array(), '', true);
}

add_action('wp_enqueue_scripts', 'ecard_scripts');

function ecard_load_scripts() {
  wp_enqueue_media();
  wp_enqueue_script('custom-ecard-js', '/wp-content/plugins/fhg-ecards/js/admin_script.js');
}

add_action('admin_enqueue_scripts', 'ecard_load_scripts');

function fhg_ecards_list () {

	require_once(ROOTDIR . 'includes/fhg-ecards-list.php');

}


function fhg_ecards_create () {

	require_once(ROOTDIR . 'includes/fhg-ecards-create.php');
}


function fhg_ecards_update () {

	require_once(ROOTDIR . 'includes/fhg-ecards-update.php');

}


function frontend_ecards_page() {
	

  require_once(ROOTDIR . 'includes/fhg-ecards-frontend.php');
  
}

add_shortcode('ecards', 'frontend_ecards_page');


function frontend_ecards_description_page() {
	

  require_once(ROOTDIR . 'includes/fhg-ecards-desc-frontend.php');
  
}

add_shortcode('ecards-description', 'frontend_ecards_description_page');


  



?>