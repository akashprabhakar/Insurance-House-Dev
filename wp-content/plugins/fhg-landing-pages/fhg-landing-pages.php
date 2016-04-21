<?php

/*
  Plugin Name: FHG Landing Pages
  Plugin URI: http://www.annet.com/
  Description: Landing pages settings
  Author: Annet #1620
  Version: 1.0
  Author URI: http://www.annet.com/
 */

//avoid direct calls to this file
if (!defined('ABSPATH')) {
  header('Status: 403 Forbidden');
  header('HTTP/1.1 403 Forbidden');
  exit();
}

include( plugin_dir_path(__FILE__) . 'includes/fhg-landing-pages-meta-boxes.php');

add_action('admin_menu', 'fhg_lp_add_admin_menu');
add_action('admin_init', 'fhg_lp_settings_init');

function fhg_lp_add_admin_menu() {
  add_options_page('FHG - Landing Pages', 'FHG - Landing Pages', 'manage_options', 'fhg_landing_pages', 'fhg_lp_options_page');
}

function fhg_lp_settings_init() {
  register_setting('landingPage', 'fhg_lp_settings');
  add_settings_section(
          'fhg_landingPage_section', __('Settings for Landing pages', 'landing_page'), 'fhg_lp_settings_section_callback', 'landingPage'
  );

  add_settings_field(
          'fhg_landing_pages', __('Landing Pages', 'landing_page'), 'fhg_landing_pages_render', 'landingPage', 'fhg_landingPage_section'
  );
}

function fhg_landing_pages_render() {
  $options = get_option('fhg_lp_settings');
  echo "<input type='text' name='fhg_lp_settings[fhg_landing_pages]' value='" . $options['fhg_landing_pages'] . "'> Add comma separated values";
}

// DO NOT REMOVE BELOW FUNCTION
function fhg_lp_settings_section_callback() {
  // echo __( 'This section description', 'landing_page' );
}

function fhg_lp_options_page() {
  echo "<form action='options.php' method='post'>    
    <h2>FHG - Landing Pages Settings</h2>";
  settings_fields('landingPage');
  do_settings_sections('landingPage');
  submit_button();
  echo "</form>";
}

?>