<?php

/*
  Plugin Name: Social Feeds
  Plugin URI: http://www.annet.com
  Description:plugin for display the social feeds on website
  Version: 1.0
  Author URI: http://www.annet.com
 */
require_once('class-social-feeds.php');



$linkedin = null;
$twiter = null;

function jal_install() {
  global $wpdb;
  global $jal_db_version;


  $table_name = $wpdb->prefix . 'social_feeds';

  $charset_collate = $wpdb->get_charset_collate();

  $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
       facebook_usr_id varchar(255) NOT NULL,
        facebook_access_tkn varchar(255) NOT NULL,
        instagram_usr_id varchar(255) NOT NULL,
        instagram_access_tkn varchar(255) NOT NULL,
        linked_in_code text NOT NULL,
        twiter_code text NOT NULL,
        twiter_screen_name text NOT NULL,
        twiter_widget_id text NOT NULL,
        youtube_url text NOT NULL,
        UNIQUE KEY id (id)
      ) $charset_collate;";

  require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
  dbDelta($sql);

  add_option('jal_db_version', $jal_db_version);
}

register_activation_hook(__FILE__, 'jal_install');
/* =============================================================================== */
/* Deactivation table */
/* =============================================================================== */
add_action('init', 'social_feeds_css');

function social_feeds_css() {
  wp_enqueue_style('social_feeds_css', get_bloginfo('template_directory') . '/includes/css/font-awesome/css/font-awesome.css');
  wp_enqueue_script('social_feeds_js', plugin_dir_url(__FILE__) . '/js/social_feedss.js');
  
}





function social_media_feeds() {
  //$result = slect_data();
  $socialobj = new SocialFeeds;
  $result = $socialobj->getData();
  if (!empty($result)) {
        $facebook_id = $result->facebook_usr_id;
        $fb_access_tkn = $result->facebook_access_tkn;
        /* Instagram */
        $insta_usr_id = $result->instagram_usr_id;
        $insta_tkn = $result->instagram_access_tkn;
        $twiter = $result->twiter_code;
        $twiter_widget = $result->twiter_widget_id;
        $youtube = $result->youtube_url;
      } else {

        $id = "";
        $facebook_id = "";
        $fb_access_tkn = "";
        $insta_usr_id = "";
        $insta_tkn = "";
        $twiter = "";
        $twiter_widget = "";
        $youtube = "";
      }

  /* limked in */
  /* ================================================== */
  //$linkedin = stripslashes($result->linked_in_code);
  /* =================================================== */
  

  $socialobj->socialicons($result);
//  $socialobj->social_facebook($facebook_id, $fb_access_tkn);
//  $socialobj->linked_in($linkedin);
//  $socialobj->twiter($twiter, $twiter_widget);
//  $socialobj->youtube($youtube);
//  $socialobj->instagram($insta_usr_id, $insta_tkn);
}

add_shortcode('social_feeds', 'social_media_feeds');

/* ========================================================================= */

/* Social Feeds form */
/* =========================================================================== */

function social_feeds_list() {

  //$result = slect_data();
  $socialobj = new SocialFeeds;
  $result = $socialobj->getData();

  if (!empty($result)) {
    $id = $result->id;

    $facebook_id = $result->facebook_usr_id;
    $facebook_access_tkn = $result->facebook_access_tkn;
    $instagram_id = $result->instagram_usr_id;
    $instagram_access_tkn = $result->instagram_access_tkn;
    $twiters = stripslashes($result->twiter_screen_name);
    $widget_id = stripslashes($result->twiter_widget_id);
    $linked_in = stripslashes($result->linked_in_code);
    $youtube = stripcslashes($result->youtube_url);
  } else {

    $id = "";

    $facebook_id = "";
    $facebook_access_tkn = "";
    $instagram_id = "";
    $instagram_access_tkn = "";
    $twiters = "";
    $widget_id = "";
    $linked_in = "";
    $youtube = "";
  }
  if (isset($_POST['submit'])) {
    global $wpdb;

    $table_name = $wpdb->prefix . 'social_feeds';

    $facebook_usr_id = htmlentities($_POST['facebook']);
    $facebook_access_tkn = htmlentities($_POST['fb_access_token']);
    $instagram_usr_id = htmlentities($_POST['instagaram']);
    $instagram_access_tkn = htmlentities($_POST['insta_access_token']);
    $linked_in_code = htmlentities($_POST['linkedin']);
    $twiter_screen_name = htmlentities($_POST['twiter']);
    $twiter_widget_id = htmlentities($_POST['widget']);
    $youtube_url = htmlentities($_POST['youtube']);

    if (empty($_POST['dataid'])) {
      global $wpdb;
      $wpdb->insert($table_name, array(
          'facebook_usr_id' => $facebook_usr_id,
          'facebook_access_tkn' => $facebook_access_tkn,
          'instagram_usr_id' => $instagram_usr_id,
          'instagram_access_tkn' => $instagram_access_tkn,
          'linked_in_code' => $linked_in_code,
          'twiter_screen_name' => $twiter_screen_name,
          'twiter_widget_id' => $twiter_widget_id,
          'youtube_url' => $youtube_url)
              , array('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'));
    } else {
      $wpdb->update($table_name, array('facebook_usr_id' => $facebook_usr_id, 'facebook_access_tkn' => $facebook_access_tkn, 'instagram_usr_id' => $instagram_usr_id, 'instagram_access_tkn' => $instagram_access_tkn, 'linked_in_code' => $linked_in_code, 'twiter_screen_name' => $twiter_screen_name, 'twiter_widget_id' => $twiter_widget_id, 'youtube_url' => $youtube_url), array('ID' => $id), array('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'));
    }
  }
  echo '<div class="wrap"><div class="postbox"><div class="inside">';
  echo '<h1 style="text-align:center;">Social Feeds</h1>';
  echo '<form method="post" action="#" style="text-align:left;padding-top:30px;padding-left:25px;">';
  echo '<table class="form-table" border="0">';
  echo '<tr valign="top">';
  echo '<th scope="row"><label>Facebook Page Id: </label></th>';
  echo '<td><input class="regular-text"type="text" class="form-control" name="facebook" value="' . $facebook_id . '" placeholder="Enter facebook app Id"></td>';
  echo '</tr>';
  echo '<tr>';
  echo '<th scope="row"><label>Facebook Access token: </label></th>';
  echo '<td><textarea class="regular-text" name="fb_access_token" rows="1" cols="50" placeholder="please paste you access token id">' . $facebook_access_tkn . '</textarea></td>';
  echo '</tr>';
  echo '<tr>';
  echo '<th scope="row"><label>Instagram User Id: </label></th>';
  echo '<td><input class="regular-text" type="text" name="instagaram" value="' . $instagram_id . '" placeholder="please enter your APi code here"></td>';
  echo '</tr>';
  echo '<tr>';
  echo '<th scope="row"><label>Instagram Access Token: </label></th>';
  echo '<td><textarea class="regular-text" name="insta_access_token" rows="2" cols="50" placeholder="please enter access token">' . $instagram_access_tkn . '</textarea></td>';
  echo '</tr>';
  echo '<tr>';
  echo '<th scope="row"><label>Twiter Screen Name: </label></th>';
  echo '<td><input class="regular-text" type="text" name="twiter" value="' . $twiters . '"></td>';
  echo '</tr>';
  echo '<tr>';
  echo '<th scope="row"><label>Twiter Widget Id: </label></th>';
  echo '<td><input class="regular-text" type="text" name="widget" value="' . $widget_id . '"></td>';
  echo '</tr>';
  echo '<tr>';
  echo '<th scope="row"><label>Youtube Channel Id: </label></th>';
  echo '<td><input class="regular-text" type="text" name="youtube" value="' . $youtube . '"></td>';
  echo '</tr>';
  echo '<tr>';
  echo '<th scope="row"><label>Linkedin: </label></th>';
  echo '<td><textarea class="regular-text" name="linkedin" rows="2" cols="50">' . $linked_in . '</textarea></td>';
  echo '</tr>';
  echo '<input type="hidden" name="dataid" value="' . $id . '"></td>';
  echo '<tr>';
  echo '<td colspan="2" ><input class="button-primary" type="submit" name="submit" value=" Submit "></td>';
  echo '</tr>';
  echo '</table>';
  echo '</form>';
  echo '</div></div></div>';
}




function socialfeeds() {
  add_menu_page(__('Social-feeds'), 'Social-feeds', 8, 'social-feeds/social-feeds.php', 'social_feeds_list');
}

add_action('admin_menu', 'socialfeeds');
?>