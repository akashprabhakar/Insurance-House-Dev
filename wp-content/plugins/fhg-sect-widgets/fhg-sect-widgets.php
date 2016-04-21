<?php

/*
  Plugin Name: FHG Widgets Plugin
  Plugin URI: http://www.annet.com/
  Description: Widgets
  Author: Annet #1620
  Version: 1.0
  Author URI: http://www.annet.com/
 */
define("WYWI_PLUGIN_DIR", plugin_dir_path(__FILE__));

function ant_register_widget() {
  require_once WYWI_PLUGIN_DIR . 'class-widget.php';
  register_widget('ANT_FHG_Widget');
}

add_action('widgets_init', 'ant_register_widget');

function register_custom_post_type_ant_fhg_widgets() {
  $labels = array(
      'name' => __('Widget Blocks', 'ant-fhg-widgets'),
      'singular_name' => __('Widget Block', 'ant-fhg-widget'),
      'add_new' => __('New Widget Block', 'ant-fhg-widget'),
      'add_new_item' => __('Add New Widget Block', 'ant-fhg-widget'),
      'edit_item' => __('Edit Widget Block', 'ant-fhg-widget'),
      'new_item' => __('New Widget Block', 'ant-fhg-widget'),
      'all_items' => __('FHG Widget Blocks', 'ant-fhg-widget'),
      'view_item' => __('View Widget Block', 'ant-fhg-widget'),
      'search_items' => __('Search Widget Blocks', 'ant-fhg-widget'),
      'not_found' => __('No widget blocks found', 'ant-fhg-widget'),
      'not_found_in_trash' => __('No widget blocks found in Trash', 'ant-fhg-widget'),
      'menu_name' => __('FHG Widget Blocks', 'ant-fhg-widget')
  );
  $args = array(
      'public' => true,
      'show_ui' => true,
      'labels' => $labels,
      'supports' => array('title', 'editor'),
      'capability_type' => 'post',
     // 'show_in_menu' => 'annet-fhg-capm-all/index.php',
      // 'capabilities' => array('create_posts' => false),
      'map_meta_cap' => true,
       'menu_position' => 101,
     // 'show_in_menu' => 'ret-sect-all/index.php',
  );

  register_post_type('ant-fhg-widget', $args);
}

add_action('init', 'register_custom_post_type_ant_fhg_widgets');
