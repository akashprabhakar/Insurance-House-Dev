<?php

////////////////////////////////////////////////////////////////////
// Theme Information
////////////////////////////////////////////////////////////////////

    $themename = "fhg_theme";
    $developer_uri = "";
    $shortname = "";
    $version = '1.71';
    load_theme_textdomain( 'fhg_theme', get_template_directory() . '/languages' );

  
//PG - 1623
require_once( get_template_directory() . '/php/config_path.php');

if (!function_exists('custom_theme_setup')) :

  /**
   * Sets up theme defaults and registers support for various WordPress features.
   *
   * Note that this function is hooked into the after_setup_theme hook, which
   * runs before the init hook. The init hook is too late for some features, such
   * as indicating support for post thumbnails.
   */
  function custom_theme_setup() {

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'fhg-theme'),
    ));

    if (function_exists('add_theme_support')) {
      add_theme_support('post-thumbnails', array('post', 'page', 'news', 'events', 'capm_events', 'board-of-directors')); // enable feature
      add_image_size('news', 500, 400, true);
      add_image_size('board-of-directors', 140, 184, true);
      add_image_size('news_thumbnail', 50, 50, true);  
  // Add featured image sizes
  add_image_size('featured-large', 609, 452, true); // width, height, crop
  add_image_size('featured-small', 320, 147, true);
  add_image_size('featured-extra-small', 320, 147, true);

  add_image_size('medium-something', 470, 335, array('center', 'top'));
    }

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));

    /*
     * Enable support for Post Formats.
     * See https://developer.wordpress.org/themes/functionality/post-formats/
     */
    add_theme_support('post-formats', array(
        'aside',
        'image',
        'video',
        'quote',
        'link',
    ));

  }

endif; // custom_theme_setup
add_action('after_setup_theme', 'custom_theme_setup');  
  
  
////////////////////////////////////////////////////////////////////
// include Theme-options.php for Admin Theme settings
////////////////////////////////////////////////////////////////////

   include 'theme-options.php';


////////////////////////////////////////////////////////////////////
// Enqueue Styles (normal style.css and bootstrap.css)
////////////////////////////////////////////////////////////////////

function fhg_theme_stylesheets() {
  if (check_arabic()) {
    wp_enqueue_style('bootstrap.min_ar', get_template_directory_uri() . '/css/bootstrap.min_ar.css', array(), '1', 'all' );
    wp_enqueue_style('style_ar', get_template_directory_uri() . '/css/style_ar.css', array(), '1', 'all');
    wp_enqueue_style('responsive_ar', get_template_directory_uri() . '/css/responsive_ar.css', array(), '1', 'all' );
     wp_enqueue_style('owl.carousel_ar', get_template_directory_uri() . '/css/owl.carousel_ar.css', array(), '1', 'all');
    
  }else{
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '1', 'all' );
    wp_enqueue_style('style', get_template_directory_uri() . '/css/style.css', array(), '1', 'all' );
    wp_enqueue_style('style_dummy', get_template_directory_uri() . '/css/style_dummy.css', array(), '1', 'all' );
    wp_enqueue_style('responsive', get_template_directory_uri() . '/css/responsive.css', array(), '1', 'all' );
    wp_enqueue_style('owl.carousel', get_template_directory_uri() . '/css/owl.carousel.css', array(), '1', 'all');
  }
  wp_enqueue_style('fhg-theme-lity-css', get_template_directory_uri() . '/css/lity.min.css', array(), '1', 'all');
  wp_enqueue_style('fhg-theme-fontawesome', INC_URL_CSS . DS . "font-awesome/css/font-awesome.min.css");
  
 
          
}
add_action('wp_enqueue_scripts', 'fhg_theme_stylesheets');

//Editor Style
add_editor_style('css/editor-style.css');

////////////////////////////////////////////////////////////////////
// Register Bootstrap JS with jquery
////////////////////////////////////////////////////////////////////
function fhg_theme_theme_js(){
  global $version;
  wp_enqueue_script('theme-js', get_template_directory_uri() . '/js/bootstrap.js',array( 'jquery' ),$version,false );
  wp_enqueue_script('fhg-capm-theme-owlcarousel', get_template_directory_uri() . '/js/owl.carousel.js', array(), '', true);
  wp_enqueue_script('fhg-theme-jqtransform', get_template_directory_uri() . '/js/jquery.jqtransform.js', array(), '', true);
  wp_enqueue_script('path.js', get_template_directory_uri() . '/js/path.js', array(), '', false);
  // wp_enqueue_script('fhg-theme-scrolltofixed', get_template_directory_uri() . '/js/jquery-scrolltofixed.js', array(), '', false);
  
  //wp_enqueue_script('fhg-mobile-js', 'http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js', array(), '', true);
  wp_enqueue_script('fhg-mobile-js',get_template_directory_uri() . '/js/jquery.mobile.custom.min.js', array('jquery'), '', true);
  wp_enqueue_script('fhg-theme-custom', get_template_directory_uri() . '/js/custom.js', array('jquery'), '', true);
  
  
  wp_enqueue_script('fhg-theme-google-map-api', 'http://maps.googleapis.com/maps/api/js?language=en', array(), '', false);
  wp_enqueue_script('fhg-theme-common', get_template_directory_uri() . '/js/commons.js', array(), '', false);
   wp_enqueue_script('fhg-theme-lightslider', get_template_directory_uri() . '/js/lightslider.js#async', array(), '', false);
  wp_enqueue_script('fhg-theme-lity', get_template_directory_uri() . '/js/lity.min.js', array(), '', false);
  wp_enqueue_script('fhg-theme-slideout', get_template_directory_uri() . '/js/jquery.tabSlideOut.v1.3.js', array(), '20120206', true);
  wp_enqueue_script('fhg-theme-social-feeds', get_template_directory_uri() . '/js/social_feedss.js', array(), '', false);
  wp_enqueue_script('fhg-theme-analyticstracking', get_template_directory_uri() . '/js/analyticstracking.js', array(), '', false);
   wp_enqueue_script('fhg-theme-jquery-ui', get_template_directory_uri() . '/js/jquery-ui.min.js', array(), '', false);
  wp_enqueue_script('fhg-theme-touch-punch', get_template_directory_uri() . '/js/jquery.ui.touch-punch.min.js', array(), '', false);
 wp_enqueue_script('fhg-theme-selectivizr-min', get_template_directory_uri() . '/js/selectivizr-min.js', array(), '', false);
  wp_localize_script( 'fhg-theme-custom','site', array('theme_path' => get_template_directory_uri(),'ajaxurl'=> admin_url('admin-ajax.php') ) );


// wp_enqueue_script('jscustom'); // I assume you registered it somewhere else
// wp_localize_script('jscustom', 'ajax_custom', array(
   // 'ajaxurl' => admin_url('admin-ajax.php')
// ));
}
    add_action('wp_enqueue_scripts', 'fhg_theme_theme_js');

////////////////////////////////////////////////////////////////////
// Add Title Tag Support with Regular Title Tag injection Fall back.
////////////////////////////////////////////////////////////////////

function fhg_theme_title_tag() {
    add_theme_support( 'title-tag' );
}

add_action( 'after_setup_theme', 'fhg_theme_title_tag' );

if(!function_exists( '_wp_render_title_tag')) {

    function fhg_theme_render_title() {
        ?>
        <title><?php wp_title( '|', true, 'right' ); ?></title>
    <?php
    }
    add_action( 'wp_head', 'fhg_theme_render_title' );

}

////////////////////////////////////////////////////////////////////
// Register Custom Navigation Walker include custom menu widget to use walkerclass
////////////////////////////////////////////////////////////////////

    require_once('lib/wp_bootstrap_navwalker.php');
    //require_once('lib/bootstrap-custom-menu-widget.php');

////////////////////////////////////////////////////////////////////
// Register Menus
////////////////////////////////////////////////////////////////////

        register_nav_menus(
            array(
                'main_menu' => 'Main Menu',
                'footer_menu' => 'Footer Menu',
        'header_top_menu' => 'Header Top Menu',
        'about_us_investor' => 'About Us Investor Relation'
            )
        );

////////////////////////////////////////////////////////////////////
// Register the Sidebar(s)
////////////////////////////////////////////////////////////////////

        register_sidebar(
            array(
            'name' => 'Right Sidebar',
            'id' => 'right-sidebar',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h3>',
            'after_title' => '</h3>',
        ));

        register_sidebar(
            array(
            'name' => 'Left Sidebar',
            'id' => 'left-sidebar',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h3>',
            'after_title' => '</h3>',
        ));

////////////////////////////////////////////////////////////////////
// Register hook and action to set Main content area col-md- width based on sidebar declarations
////////////////////////////////////////////////////////////////////

add_action( 'fhg_theme_main_content_width_hook', 'fhg_theme_main_content_width_columns');

function fhg_theme_main_content_width_columns () {

    global $dm_settings;

    $columns = '12';

    if ($dm_settings['right_sidebar'] != 0) {
        $columns = $columns - $dm_settings['right_sidebar_width'];
    }

    if ($dm_settings['left_sidebar'] != 0) {
        $columns = $columns - $dm_settings['left_sidebar_width'];
    }

    echo $columns;
}

function fhg_theme_main_content_width() {
    do_action('fhg_theme_main_content_width_hook');
}

////////////////////////////////////////////////////////////////////
// Adds RSS feed links to for posts and comments.
////////////////////////////////////////////////////////////////////

    add_theme_support( 'automatic-feed-links' );


////////////////////////////////////////////////////////////////////
// Set Content Width
////////////////////////////////////////////////////////////////////

if ( ! isset( $content_width ) ) $content_width = 800;

 function wpb_imagelink_setup() {
  $image_set = get_option('image_default_link_type');

  if ($image_set !== 'none') {
    update_option('image_default_link_type', 'none');
  }
}

add_action('admin_init', 'wpb_imagelink_setup', 10);


/* PG - 1623 - Add Custom Tinymce button*/
// Hooks your functions into the correct filters
function my_add_mce_button() {
  // check user permissions
  if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
    return;
  }
  // check if WYSIWYG is enabled
  if ( 'true' == get_user_option( 'rich_editing' ) ) {
    add_filter( 'mce_external_plugins', 'my_add_tinymce_plugin' );
    add_filter( 'mce_buttons', 'my_register_mce_button' );
  }
}
add_action('admin_head', 'my_add_mce_button');

// Declare script for new button
function my_add_tinymce_plugin( $plugin_array ) {
  $plugin_array['my_mce_button'] = get_template_directory_uri() .'/js/mce-button.js';
  return $plugin_array;
}

// Register new button in the editor
function my_register_mce_button( $buttons ) {
  array_push( $buttons, 'my_mce_button' );
  return $buttons;
}

function my_shortcodes_mce_css() {
   wp_enqueue_style('fontawesome', 'http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css', '', '', 'all');
  wp_enqueue_style('symple_shortcodes-tc', get_template_directory_uri() . '/css/my-mce-style.css' );
   
}
add_action( 'admin_enqueue_scripts', 'my_shortcodes_mce_css' );

/* PG - 1623 - Add Custom Tinymce button*/

function my_format_TinyMCE($in) {
  $in['remove_linebreaks'] = true;
  $in['gecko_spellcheck'] = false;
  $in['keep_styles'] = true;
  $in['accessibility_focus'] = true;
  $in['tabfocus_elements'] = 'major-publishing-actions';
  $in['media_strict'] = false;
  $in['paste_remove_styles'] = false;
  $in['paste_remove_spans'] = false;
  $in['paste_strip_class_attributes'] = 'none';
  $in['paste_text_use_dialog'] = true;
  $in['wpeditimage_disable_captions'] = true;
  $in['content_css'] = INC_URL_CSS . DS . "style.css";
  $in['wpautop'] = true;
  $in['block_formats'] = 'Main Header=h1;Sub Header=h2; Small Header=h3; Extra Small Header=h4; Paragraph =p;';
  $in['apply_source_formatting'] = false;
  $in['toolbar1'] = 'bold,italic,strikethrough,bullist,numlist,hr,alignleft,aligncenter,mailto, alignright,link,unlink,spellchecker,wp_fullscreen,wp_adv,my_mce_button ';
  $in['toolbar2'] = 'formatselect,underline,alignjustify,forecolor,pastetext,outdent,indent,undo,redo,wp_help ';
  $in['toolbar3'] = '';
  $in['toolbar4'] = '';
  return $in;
}

add_filter('tiny_mce_before_init', 'my_format_TinyMCE');


//Disable plugin updates in wordpress
remove_action('load-update-core.php', 'wp_update_plugins');
add_filter('pre_site_transient_update_plugins', '__return_null');


//Custom Translate
function custom_translate($english, $arabic) {
  $prnt_string = "";
  if (check_arabic()) {
    $prnt_string = $arabic;
  } else {
    $prnt_string = $english;
  }
  return $prnt_string;
}
//Check Arabic
function check_arabic() {
  $url = $_SERVER['REQUEST_URI'];
  return (strstr($url, '/ar/') == true);
}

function sidebarsfunction($widgetname,$widgetid){

  register_sidebar(array(
      'name' => __($widgetname, 'capm'),
      'id' => $widgetid,
      'description' => '',
      'before_widget' => '',
      'after_widget' => '',
      'before_title' => '<h1>',
      'after_title' => '</h1>',
  ));
}


function capm_widgets_init() {
  
    sidebarsfunction('Language Switcher','language-switcher');
  
    sidebarsfunction('Help Center','help-center');
    sidebarsfunction('Help Center - Arabic','help-center_arabic');
  
    sidebarsfunction('Credit Cards Slider','creditcardslider');
    sidebarsfunction('Credit Cards Slider - Arabic','creditcardslider_arabic'); 
  
    sidebarsfunction('Value House','valuehouse');
    sidebarsfunction('Value House - Arabic','valuehouse_arabic');
  
    sidebarsfunction('Social Follow','socialfollow');
  sidebarsfunction('Social Follow - Arabic','socialfollow_arabic');
  
    sidebarsfunction('Welcome Page','capm-welcome');
    sidebarsfunction('Welcome Page - Arabic','capm-welcome_arabic');
  
    sidebarsfunction('Footer','capm-footer');
    sidebarsfunction('Footer - Arabic','capm-footer_arabic');
  
    sidebarsfunction('Contacts','contacts_widget');
    sidebarsfunction('Contacts - Arabic','contacts_arabic_widget');
  
    sidebarsfunction('CAPM','capm_widget');
    sidebarsfunction('CAPM - Arabic','capm_arabic_widget');
  
    sidebarsfunction('Islamic Finance House','islamic_finance_house_widget');
    sidebarsfunction('Islamic Finance House - Arabic','islamic_finance_house_arabic_widget');
  
    sidebarsfunction('Subscribe to Newsletter','email_widget');
    sidebarsfunction('Subscribe to Newsletter - Arabic','email_arabic_widget');
  
    sidebarsfunction('Logos','logos_widget');
    sidebarsfunction('Logos - Arabic','logos_arabic_widget');
  
    sidebarsfunction('Insurance House','insurance_house_widget');
    sidebarsfunction('Insurance House - Arabic','insurance_house_arabic_widget');
  
    sidebarsfunction('Finance House Securties','finance_house_securities_widget');
    sidebarsfunction('Finance House Securties - Arabic','finance_house_securities_arabic_widget');
  
    // sidebarsfunction('Font Resizer','fontresize');
    // sidebarsfunction('Font Resizer - Arabic','fontresize_arabic');
  
    sidebarsfunction('Social Follow','socialfollow');
  
  sidebarsfunction('Executive Finance Bottom','exec_finance_b');
  sidebarsfunction('Executive Finance Bottom - Arabic','exec_finance_b_arabic');
  
  sidebarsfunction('Auto Finance Bottom','auto_finance_b');
  sidebarsfunction('Auto Finance Bottom - Arabic','auto_finance_b_arabic');
  
  sidebarsfunction('Home Finance Bottom','home_finance_b');
  sidebarsfunction('Home Finance Bottom - Arabic','home_finance_b_arabic');
  
  sidebarsfunction('Credit Cards Bottom','credit_cards_b');
  sidebarsfunction('Credit Cards Bottom - Arabic','credit_cards_b_arabic');
  
  sidebarsfunction('Strengths','strengths_child');
  sidebarsfunction('Strengths - Arabic','strengths_child_arabic');
  
  sidebarsfunction('Performance','performance_child');
  sidebarsfunction('Performance - Arabic','performance_child_arabic');
  
  sidebarsfunction('Security','security_child');
  sidebarsfunction('Security - Arabic','security_child_arabic');
  
  sidebarsfunction('Commercial Finance','commercial_finance_child');
  sidebarsfunction('Commercial Finance - Arabic','commercial_finance_child_arabic');
  
  sidebarsfunction('Corporate Finance','corporate_finance_child');
  sidebarsfunction('Corporate Finance - Arabic','corporate_finance_child_arabic');
  
  sidebarsfunction('Smart Guarentee','smart_guarentee_child');
  sidebarsfunction('Smart Guarentee - Arabic','smart_guarentee_child_arabic');
  
  sidebarsfunction('Trade Finance','trade_finance_child');
  sidebarsfunction('Trade Finance - Arabic','trade_finance_child_arabic');
  
  sidebarsfunction('Pay Day','pay_day_child');
  sidebarsfunction('Pay Day - Arabic','pay_day_child_arabic');
  
  sidebarsfunction('Ownership Statistic','ownership_statistic_child');
  sidebarsfunction('Ownership Statistic - Arabic','ownership_statistic_child_arabic');
  
  sidebarsfunction('Unclaimed Dividends','unclaimed_dividends_child');
  sidebarsfunction('Unclaimed Dividends - Arabic','unclaimed_dividends_child_arabic');
  
  sidebarsfunction('Share Price','share_price_child');
   sidebarsfunction('Share Price - Arabic','share_price_child_arabic');
   
  sidebarsfunction('Dividends History','dividends_history_child');
  sidebarsfunction('Dividends History - Arabic','dividends_history_child_arabic');
  
  sidebarsfunction('AGM EGM','agm_egm_child');
  sidebarsfunction('AGM EGM - Arabic','agm_egm_child_arabic');
  
  sidebarsfunction('Calendar','calendar_child');
  sidebarsfunction('Calendar - Arabic','calendar_child_arabic');
  
  sidebarsfunction('Financial Highlights','financial_highlights_child');
  sidebarsfunction('Financial Highlights - Arabic','financial_highlights_child_arabic');
  
  sidebarsfunction('Flexi Deposit','flexi_deposit_child');
  sidebarsfunction('Flexi Deposit - Arabic','flexi_deposit_child_arabic');
  
  sidebarsfunction('Fixed Deposit','fixed_deposit_child');
  sidebarsfunction('Fixed Deposit - Arabic','fixed_deposit_child_arabic');
  
  sidebarsfunction('MYFD','myfd_child');
  sidebarsfunction('MYFD - Arabic','myfd_child_arabic');
  
   sidebarsfunction('Compliance Certificate','compliance_certificate_child');
   sidebarsfunction('Compliance Certificate - Arabic','compliance_certificate_child_arabic');
   
   sidebarsfunction('CSR','csr_child');
   sidebarsfunction('CSR - Arabic','csr_child_arabic');
   
sidebarsfunction('Sponsorships','sponsorships_child');
sidebarsfunction('Sponsorships - Arabic','sponsorships_child_arabic');

sidebarsfunction('Mission Vision','mission_vision_child');
sidebarsfunction('Mission Vision - Arabic','mission_vision_child_arabic');

sidebarsfunction('Corporate Governance','corporate_governance_child');
sidebarsfunction('Corporate Governance - Arabic','corporate_governance_child_arabic');

sidebarsfunction('Talent And Development','talent_development_child');
sidebarsfunction('Talent And Development - Arabic','talent_development_child_arabic');

sidebarsfunction('HR Message','hr_message_child');
sidebarsfunction('HR Message - Arabic','hr_message_child_arabic');

sidebarsfunction('HRD','hrd_child');
sidebarsfunction('HRD - Arabic','hrd_child_arabic');

sidebarsfunction('Blue CC','blue_cc_child');
sidebarsfunction('Blue CC - Arabic','blue_cc_child_arabic');

sidebarsfunction('Gold CC','gold_cc_child');
sidebarsfunction('Gold CC - Arabic','gold_cc_child_arabic');

sidebarsfunction('Platinum CC','platinum_cc_child');
sidebarsfunction('Platinum CC - Arabic','platinum_cc_child_arabic');

sidebarsfunction('Titanium CC','titanium_cc_child');
sidebarsfunction('Titanium CC - Arabic','titanium_cc_child_arabic');

sidebarsfunction('Customer Referral Programme','crp_child');
sidebarsfunction('Customer Referral Programme - Arabic','crp_child_arabic');

}

add_action('widgets_init', 'capm_widgets_init');

    
// Register the three useful image sizes for use in Add Media modal
add_filter('image_size_names_choose', 'wpshout_custom_sizes');

function wpshout_custom_sizes($sizes) {
  return array_merge($sizes, array(
      'medium-something' => __('Medium Something'),
  ));
}

//Title Tag
function theme_name_wp_title($title, $sep) {
  if (is_feed()) {
    return $title;
  }

  global $page, $paged;

  // Add the blog name
  $title .= get_bloginfo('name', 'display');

  // Add the blog description for the home/front page.
  $site_description = get_bloginfo('description', 'display');
  if ($site_description && ( is_home() || is_front_page() )) {
    $title .= " $sep $site_description";
  }

  // Add a page number if necessary:
  if (( $paged >= 2 || $page >= 2 ) && !is_404()) {
    $title .= " $sep " . sprintf(__('Page %s', '_s'), max($paged, $page));
  }

  return $title;
}


add_filter('wp_title', 'theme_name_wp_title', 10, 2);
add_post_type_support('page', 'excerpt');

function new_excerpt_more() {
  return ' <a class="read-more" href="' . get_permalink(get_the_ID()) . '">' . READMORE . '</a>';
}

add_filter('excerpt_more', 'new_excerpt_more');

function oQeyVideo($lang, $start_from, $total_per_page) {
  global $wpdb;
  $results = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'oqey_video WOV LEFt JOIN ' . $wpdb->prefix . 'video_desc WVD ON WOV.id = WVD.video_id WHERE WOV.status !=2 AND WVD.lang = "' . $lang . '" LIMIT ' . $start_from . ', ' . $total_per_page . '', OBJECT);

  return $results;
}

/* Sort Videos  1846 */

function oQeyVideosortmonth($lang, $start_from, $total_per_page, $month) {
    global $wpdb;
    $results = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'oqey_video WOV LEFt JOIN ' . $wpdb->prefix . 'video_desc WVD ON WOV.id = WVD.video_id WHERE DATE_FORMAT((WOV.event_date) ,  "%b" ) = "' . $month . '" AND WOV.status !=2  AND WVD.lang = "' . $lang . '" LIMIT ' . $start_from . ', ' . $total_per_page . '', OBJECT);

    return $results;
}

function oQeyVideosortyear($lang, $start_from, $total_per_page, $year) {
    global $wpdb;
    $results = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'oqey_video WOV LEFt JOIN ' . $wpdb->prefix . 'video_desc WVD ON WOV.id = WVD.video_id WHERE DATE_FORMAT((WOV.event_date) ,  "%Y" ) = "' . $year . '" AND WOV.status !=2  AND WVD.lang = "' . $lang . '" LIMIT ' . $start_from . ', ' . $total_per_page . '', OBJECT);

    return $results;
}

function oQeyVideosortmonthyear($lang, $start_from, $total_per_page, $month, $year) {
    global $wpdb;
    $results = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'oqey_video WOV LEFt JOIN ' . $wpdb->prefix . 'video_desc WVD ON WOV.id = WVD.video_id WHERE DATE_FORMAT((WOV.event_date) ,  "%b" ) = "' . $month . '" AND DATE_FORMAT((WOV.event_date) ,  "%Y" ) = "' . $year . '" AND WOV.status !=2  AND WVD.lang = "' . $lang . '" LIMIT ' . $start_from . ', ' . $total_per_page . '', OBJECT);

    return $results;
}




function oQeyVideoPagiCount($lang) {
  global $wpdb;
  $results = $wpdb->get_results('SELECT *  FROM ' . $wpdb->prefix . 'oqey_video WOV LEFt JOIN ' . $wpdb->prefix . 'video_desc WVD ON WOV.id = WVD.video_id WHERE WOV.status !=2 AND WVD.lang = "' . $lang . '"', OBJECT);
  return $results;
}

/* 1621 fetch images for pictures section */

function oQeyImage($limit, $query) {
  global $wpdb;
  if (empty($limit)) {
    $limit = '';
  } else {
    $limit = ' LIMIT ' . $limit;
  }

  $results = $wpdb->get_results($query . $limit, OBJECT);

  return $results;
}

/* 1621 fetch gallery for pictures section */

function oQeyGallery($limit, $query) {
  global $wpdb;
  if (empty($limit)) {
    $limit = '';
  } else {
    $limit = ' LIMIT ' . $limit;
  }

  $results = $wpdb->get_results($query . $limit, OBJECT);
  return $results;
}

/* 1621 query for pictures images */

function queryImages($gal_id, $sortvalue, $value) {
  global $wpdb;
  if ($sortvalue == 'nosort') {
    return "SELECT FHOG.title as albumname,FHOG.arabic_title,FHOI.title,FHOI.alt,FHOI.comments,FHOI.arabic_description,FHOI.arabic_comments,FHOI.published_datetime FROM ".$wpdb->prefix."oqey_images FHOI INNER JOIN ".$wpdb->prefix."oqey_gallery FHOG ON FHOI.gal_id = FHOG.id  WHERE FHOI.status = 0 and FHOI.gal_id ='$gal_id'";
  }
  if ($sortvalue == 'month') {
    return "SELECT FHOG.title as albumname,FHOG.arabic_title,FHOI.title,FHOI.alt,FHOI.comments,FHOI.arabic_description,FHOI.arabic_comments,FHOI.published_datetime FROM ".$wpdb->prefix."oqey_images FHOI INNER JOIN ".$wpdb->prefix."oqey_gallery FHOG ON FHOI.gal_id = FHOG.id WHERE DATE_FORMAT((FHOI.`published_datetime` ) ,  '%b' ) =  '$value' AND FHOI.status = 0 and FHOI.gal_id ='$gal_id'";
  }

  if ($sortvalue == 'year') {
    return "SELECT FHOG.title as albumname,FHOG.arabic_title,FHOI.title,FHOI.alt,FHOI.comments,FHOI.arabic_description,FHOI.arabic_comments,FHOI.published_datetime FROM  ".$wpdb->prefix."oqey_images FHOI INNER JOIN ".$wpdb->prefix."oqey_gallery FHOG ON FHOI.gal_id = FHOG.id WHERE DATE_FORMAT((FHOI.`published_datetime` ) ,  '%Y' ) =  '$value' AND FHOI.status = 0 and FHOI.gal_id ='$gal_id' ";
  }
}

function queryImagesNew($gal_id, $sortvalue, $value) {
  global $wpdb;
  if ($sortvalue == 'nosort') {
    $query = "SELECT FHOG.title as albumname,FHOG.arabic_title,FHOI.title,FHOI.alt,FHOI.comments,FHOI.arabic_description,FHOI.arabic_comments,FHOI.published_datetime FROM ".$wpdb->prefix."oqey_images FHOI INNER JOIN ".$wpdb->prefix."oqey_gallery FHOG ON FHOI.gal_id = FHOG.id  WHERE FHOI.status = 0 and FHOI.gal_id ='$gal_id'";
  }
  if ($sortvalue == 'month') {
    $query = "SELECT FHOG.title as albumname,FHOG.arabic_title,FHOI.title,FHOI.alt,FHOI.comments,FHOI.arabic_description,FHOI.arabic_comments,FHOI.published_datetime FROM  ".$wpdb->prefix."oqey_images FHOI INNER JOIN ".$wpdb->prefix."oqey_gallery FHOG ON FHOI.gal_id = FHOG.id WHERE DATE_FORMAT((FHOI.`published_datetime` ) ,  '%b' ) =  '$value' AND FHOI.status = 0 and FHOI.gal_id ='$gal_id'";
  }

  if ($sortvalue == 'year') {
    $query = "SELECT FHOG.title as albumname,FHOG.arabic_title,FHOI.title,FHOI.alt,FHOI.comments,FHOI.arabic_description,FHOI.arabic_comments,FHOI.published_datetime FROM  ".$wpdb->prefix."oqey_images FHOI INNER JOIN ".$wpdb->prefix."oqey_gallery FHOG ON FHOI.gal_id = FHOG.id WHERE DATE_FORMAT((FHOI.`published_datetime` ) ,  '%Y' ) =  '$value' AND FHOI.status = 0 and FHOI.gal_id ='$gal_id' ";
  }
  //global $wpdb;
   $images = $wpdb->get_results($query);

  return $images;
}

/* 1621 query for pictures gallery and (1846)sorting queries based on month and year */
/*1623 - Changes made from FH*/
function queryGallery($sortvalue, $value) {
  
  global $wpdb;  
  $my_key = explode("**",$sortvalue);
  
  $my_value = explode("**",$value);
  
  $sql = '';
  
  $sql .= "SELECT id,title,folder,arabic_title,eng_desc,arab_desc FROM  ".$wpdb->prefix."oqey_gallery ";
  
  $condition = " WHERE ";
  
  if ($my_key[0] == 'month') {
    if(isset($my_value[0])) {
      $sql .= $condition . "  DATE_FORMAT((`event_date` ) ,  '%b' ) =  '$my_value[0]' ";
      $condition = " AND ";
    }
    }
  if ($my_key[1] == 'yr') {
    if(isset($my_value[1])) {
      $sql .= $condition . "  DATE_FORMAT((`event_date` ) ,  '%Y' ) =  '$my_value[1]' ";
      $condition = " AND ";
    }
    }
  
  if ($my_key[0] == 'month' || $my_key[1] == 'yr') {
    $sql .= "  AND id NOT IN (1,2,3,12) ";
  }
  
  
  if ($my_key[0] == 'nosort') {
    $sql .= $condition . " id NOT IN (1,13) ";
  }
  
  $sql .= " AND status = 0 ";
  
  return $sql;
}

function homeboxes() {
  //echo "SELECT * FROM `fhg_fh_oqey_images` WHERE gal_id =13 ORDER BY img_order ASC";
  global $wpdb;
  $qry = "SELECT * FROM `".$wpdb->prefix."oqey_images` WHERE gal_id =13 ORDER BY img_order ASC";
  $images = $wpdb->get_results($qry);

  return $images;
}

/* PLEASE CHECK AND REMOVE THIS FUNCTION IF NOT REQUIRED */

function breadcrumb_menu_custom() {
  echo '<ul class="breadcrumb">';
  $url = $_SERVER['REQUEST_URI'];

  if (strstr($url, '/ar/') == true) {
    ?>
    <li><a href="<?php echo SITE_URL . '/ar/'; ?>" class="homeicon">&nbsp;</a></li>
    <?php
  } else {
    ?>
    <li><a href="<?php echo SITE_URL; ?>" class="homeicon">&nbsp;</a></li>
    <?php
  }
  if (function_exists('menu_breadcrumb')) {
    menu_breadcrumb('main_menu');
  }
  echo'</ul>';
}

function trans($year) {
  $western_arabic = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
  $eastern_arabic = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
  $year = str_replace($western_arabic, $eastern_arabic, $year);

  return $year;
}

function transmonth($month) {
  $western_arabic = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
  $eastern_arabic = array('يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو', 'يوليو', 'أغسطس', 'سبتمبر', 'أكتوبر', 'نوفمبر', 'ديسمبر');
  $month = str_replace($western_arabic, $eastern_arabic, $month);

  return $month;
}

function transfullmonth($month_full) {
  $western_arabic = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
  $eastern_arabic = array('يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو', 'يوليو', 'أغسطس', 'سبتمبر', 'أكتوبر', 'نوفمبر', 'ديسمبر');
  $month_full = str_replace($western_arabic, $eastern_arabic, $month_full);

  return $month_full;
}


function aboutustpl($englishid, $arabicid) {
  $data = array();
  $cid = custom_translate($englishid, $arabicid);
  $singlepost = get_post($cid);
  $data['title'] = $singlepost->post_title;
  $singlepost_content = $singlepost->post_content;
  $singlepostc = wp_trim_words($singlepost_content, 20, '...');
  $data['content'] = $singlepostc;
  $src = wp_get_attachment_image_src(get_post_thumbnail_id($cid));
  $data['src'] = $src[0];
  $data['guid'] = $singlepost->guid;
  return $data;
}

function get_url() {
  if (check_arabic()) {
    $val = SITE_URL . DS . "ar" . DS;
  } else {
    $val = SITE_URL . DS;
  }
  return $val;
}

function check_en_ar() {
  if (check_arabic()) {
    $val = "ar";
  } else {
    $val = "en";
  }
  return $val;
}

function get_slider_images() {
  global $wpdb;
  $galid = custom_translate(1,54);
  $qry1 = "SELECT * FROM `".$wpdb->prefix."oqey_images` WHERE gal_id = '".$galid."' AND status = 0;";

  $images = $wpdb->get_results($qry1);

  return $images;
}

/*1623 - Changes taken from FH*/
function getContactFormProduct() {
  if (check_arabic()) {
    /* 1623-Temporarily Deactivated */
    //echo do_shortcode('[contact-form-7 id="931" title="Apply for product - Arabic"]');
    echo do_shortcode('[contact-form-7 id="931" title="Apply for product"]');
  } else {
    echo do_shortcode('[contact-form-7 id="927" title="Apply for product" html_id="contact-form-apply" html_class="form applyform-eng" ]');
  }
}

/*1623 - Changes taken from FH*/
function getContactFormFeedback() {
  if (check_arabic()) {

    /* 1623-Temporarily Deactivated */
    echo do_shortcode('[contact-form-7 id="930" title="Feedback - Arabic"]');
    // echo do_shortcode('[contact-form-7 id="928" title="Feedback"]');
  } else {
 
    echo do_shortcode('[contact-form-7 id="928" title="Feedback" html_id="contact-form-apply-arb" html_class="form applyform-eng"]');
  }
}

/* pg 1620 */

function get_primary_breadcrumbs() {
  echo " <div class='container-fluid breadcrumsBG'>
    <div class='container'>
      <div class='row'>
        <div class='col-lg-8 col-md-8 col-sm-8 col-xs-12 leftbreadcrumb'>
          <ul class='breadcrumb'>
            <li><a href='" . SITE_URL . custom_translate("", "/ar/") . "' class='homeicon'>&nbsp;</a></li>";
  if (function_exists('menu_breadcrumb')) {
    menu_breadcrumb('main_menu');
  }
  echo "</ul>
        </div>";
  echo get_addthissharelinks();
  echo "</div>
    </div>
  </div>";
}

function get_addthissharelinks() {
  return "<div class='col-lg-4 col-md-4 col-sm-4 col-xs-12 rightbreadcrumb'>
            <div class='sharenetcontainer'> <span>" . custom_translate("Share On", "شارك على") . ":</span>
              <div class='shareNet'>
                <div class='addthis_toolbox addthis_default_style addthis_16x16_style'>
                  <a class='addthis_button_facebook'><span class='facebookicon'><i class='fa fa-facebook-official'></i></span></a>
                  <a class='addthis_button_twitter'><span class='twittericon'><i class='fa fa-twitter-square'></i></span></a>
                  <a class='addthis_button_linkedin'><span class='linkedinicon'><i class='fa fa-linkedin-square'></i></span></a>
                  <a class='addthis_button_email'><span class='mailiconicon'><i class='fa fa-envelope-square'></i></span></a>
                </div>
              </div>
            </div>
          </div>";
}

/* breadcrumb for 404 page not found */

function get_404_breadcrumbs($page_name) {
  echo "<div class='container-fluid breadcrumsBG'>
    <div class='container'>
      <div class='row'>
        <div class='col-lg-8 col-md-8 col-sm-8 col-xs-12 bd'>
          <ul class='breadcrumb'>";
  echo "<li><a href='" . SITE_URL . custom_translate("", "/ar/") . "' class='homeicon'>&nbsp;</a></li>";
  echo "<span class='sep'> / </span>";
  if ($page_name == '404') {
    echo "<li>" . custom_translate('Page not found', 'الص�?حة غير موجودة') . "</li>";
  } if ($page_name == 'search') {
    echo "<li>" . custom_translate('Search Results', 'نتائج البحث') . "</li>";
  }
  echo "</ul>
        </div>";
  echo get_addthissharelinks();
  echo "</div>
    </div>
  </div>";
}

function get_post_breadcrumbs() {
  echo " <div class='container-fluid breadcrumsBG'>
    <div class='container'>
      <div class='row'>
        <div class='col-lg-8 col-md-8 col-sm-8 col-xs-12 leftbreadcrumb'>
          <ul class='breadcrumb'>
            <li><a href='" . SITE_URL . custom_translate("", "/ar/") . "' class='homeicon'>&nbsp;</a></li>";
  if (function_exists('bcn_display')) {
    wp_reset_query();
    bcn_display();
  }
  echo "</ul>
        </div>";
  echo get_addthissharelinks();
  echo "</div>
      </div>
    </div>";
}

function get_breadcrumb_wtout_parent($parent_title_id, $child_title) {
  echo " <div class='container-fluid breadcrumsBG'>
    <div class='container'>
      <div class='row'>
        <div class='col-lg-8 col-md-8 col-sm-8 col-xs-12 leftbreadcrumb'>
         <ul class='breadcrumb'>
     <li><a href='" . SITE_URL . custom_translate("", "/ar/") . "' class='homeicon'>&nbsp;</a></li>";
  $get_ancestor = $parent_title_id;
  $arr = get_post_ancestors($get_ancestor);
  $get_ancestor = $arr[0];
  get_the_title();
  echo "<li><a href='" . get_page_link($get_ancestor) . "'>" . get_the_title($get_ancestor) . "</a></li>";
  echo "<li><a href= '" . get_page_link($parent_title_id) . "'>" . $child_title . "</a></li>";
  echo "<li><a href=" . "#>" . get_the_title() . "</a></li>";
  echo "</ul>
        </div>";

  echo get_addthissharelinks();
  echo "</div>
      </div>
    </div>";
}

function get_blog_breadcrumbs($title) {
  echo " <div class='container-fluid breadcrumsBG'>
    <div class='container'>
      <div class='row'>
        <div class='col-lg-8 col-md-8 col-sm-8 col-xs-12 leftbreadcrumb'>
         <ul class='breadcrumb'>
     <li><a href='" . SITE_URL . custom_translate("", "/ar/") . "' class='homeicon'>&nbsp;</a></li>
     <li><a href='" . SITE_URL . custom_translate("/en/blog", "/ar/blog") . "'>Blog </a></li>";
  echo "<li><a href=" . "#>" . $title . "</a></li>";
  echo "</ul>
        </div>";

  echo get_addthissharelinks();
  echo "</div>
      </div>
    </div>";
}


class Site_Map extends Walker_Nav_Menu {

  function start_el(&$output, $item, $depth, $args) {
    global $wp_query;
    $indent = ( $depth ) ? str_repeat("\t", $depth) : '';

    $class_names = $value = '';

    $classes = empty($item->classes) ? array() : (array) $item->classes;

    $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item));
    $class_names = ' class="' . esc_attr($class_names) . '"';

    $output .= $indent . '<li id="menu-item-' . $item->ID . '"' . $value . $class_names . '>';

    $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
    $attributes .=!empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
    $attributes .=!empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
    $attributes .=!empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

    $item_output = $args->before;

    $item_output .= '<a' . $attributes . '>';
    $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
    $item_output .= '</a>';

    $item_output .= $args->after;
    $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
  }

}

function custom_wp_nav_menu_sitemap() {
  $sitemap = new Site_Map;
  $options = array('theme_location' => 'primary', 'walker' => $sitemap, // Setting up the location for the main-menu, Main Navigation.
      'container_class' => "",
      'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
      'echo' => false
  );
  $nav = wp_nav_menu($options);
  $nav = str_replace('class=" "', '', $nav);
  echo $nav;
}


/* 1620/ 1846 */
/* Query to get the unique months and years */

function get_sort_dropdowns($tbl) {
  global $wpdb;
  if ($tbl == "fhg_events_startdate") {
    $url = custom_translate("events-sponserships/?", "ar/الرعاية-وال�?عاليات/?");
  }
  if ($tbl == "fhg_news_startdate") {
    $url = custom_translate("en/section/news-50/pressreleases?", "ar/section/news-50/pressreleases-1/?");
  }

  if ($tbl == "fhg_publications_startdate") {
    $url = custom_translate("publications/?", "ar/المنشورات/?");
  }

  if ($tbl == "fh_emirates_review_startdate") {
    $url = custom_translate("en/section/about-us/emirates-review/?", "ar/section/about-us/emirates-review-1/?");
  }


  $yr_months = $wpdb->get_col("SELECT DISTINCT meta_value FROM ".$wpdb->prefix."postmeta AS pm JOIN ' .$wpdb->prefix. 'posts AS p ON pm.post_id = p.ID WHERE meta_key = '$tbl' AND post_status = 'publish' ORDER BY pm.meta_value");

  if ($tbl == "videos") {
    $url = custom_translate("videos/?", "ar/media/videos/?");
    $yr_months = $wpdb->get_col("SELECT DISTINCT UNIX_TIMESTAMP(event_date) FROM ".$wpdb->prefix."oqey_video WHERE status= 0 ORDER BY event_date");
  }

    if ($tbl == "picgallery") {
        $url = custom_translate("pictures/?", "ar/الصور/?");
        $yr_months = $wpdb->get_col("SELECT DISTINCT UNIX_TIMESTAMP(event_date) FROM ".$wpdb->prefix."oqey_gallery WHERE status = 0 and id NOT IN (1,13) ORDER BY event_date");
    }

    if ($tbl == "pictures") {
        $id = $_GET['id'];
        //$qry=  "SELECT DISTINCT UNIX_TIMESTAMP(published_datetime) FROM fhg_fhoqey_images WHERE status = 0 and gal_id = $id";
        $url = custom_translate("pictures/?id=" . $id . "&", "ar/الصور/?id=" . $id . "&");
        $yr_months = $wpdb->get_col("SELECT DISTINCT UNIX_TIMESTAMP(event_date) FROM ".$wpdb->prefix."oqey_images WHERE status = 0 and gal_id = $id ORDER BY event_date");
    }
  
  foreach ($yr_months as $yr_month) {

    $gmts[] = date('M', $yr_month);
    $gmts_years[] = date('Y', $yr_month);
  }

  $months1 = array_unique($gmts);
  $months = array();
  foreach ($months1 as $month) {
    $m = date_parse($month);
    $months[$m['month']] = $month;
  }

  ksort($months);
  $years = array_unique($gmts_years);
  
  /*Start Add by navin patel*/
  if(isset($_REQUEST['month'])) {
     $check_arabic = check_arabic();  
     if ($check_arabic) {
      $val_m = transmonth($_REQUEST['month']);    
      } else {
      $val_m = $_REQUEST['month'];    
      }
  } else {
    $val_m = custom_translate("by Month", "حسب الشهر");
  }
  
  if(isset($_REQUEST['yr'])) {
    $val_y = $_REQUEST['yr'];   
  } else {
    $val_y = custom_translate("by Year", "حسب السنة");
  }
 /*End by navin patel */  

  if (!empty($yr_months)) {
    $month_li = get_dropdown($url, $months, "month=", $val_m);
    $year_li = get_dropdown($url, $years, "yr=", $val_y);
    echo '<div class="emiratesupper">
            <div class="emirates-dropdown">
              '.$month_li . $year_li.'
            </div>
          </div>';
  }
}

// function get_dropdown($url, $ary, $type, $default_val) {
//   $li = "<div class='dropdown'>
//     <button class='btn dropdown-toggle' type='button' data-toggle='dropdown'>"
//           . $default_val .
//           "<span class='caret1'></span>
//     </button>
//     <ul class='dropdown-menu'> ";
//   $check_arabic = check_arabic();
//   foreach ($ary as $item) {
//     $li .= "<li><a href='" . SITE_URL . DS . $url . $type . $item . "'> ";
//     if ($check_arabic) {
//       $li .= transmonth($item);
//     } else {
//       $li .= $item;
//     }
//     $li .= "</a>
//       </li>";
//   }
//   $li .= " </ul>
//   </div>";
//   return $li;
// }

function get_dropdown($url, $ary, $type, $default_val) {

  $li .= '<div class="btn-group">
            <button type="button" class="btn btn-default"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.$default_val.'</button>
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="caret"></span>
              <span class="sr-only">Toggle Dropdown</span>
            </button>

            <ul class="dropdown-menu">';
              $check_arabic = check_arabic();
        $val_url = "";
        if(isset($_REQUEST['yr']) && $type !== "yr=") {
          $val_url .= "&yr=".$_REQUEST['yr'];   
        } 
        
        if(isset($_REQUEST['month']) && $type !== "month=") {
          $val_url .= "&month=".$_REQUEST['month'];   
        } 
         $string_title = str_replace(' ', '', get_the_title());
              foreach ($ary as $item) {
        
                  $li .= "<li>
                            <a href='" . SITE_URL . DS . $url . $type . $item . $val_url .'#'.$string_title."'> ";
                              if ($check_arabic) {
                                $li .= transmonth($item);
                              } else {
                                $li .= $item;
                              }
                  $li .= "  </a>
                          </li>";
              }
              
  $li .= " </ul>
          </div>";

  return $li;
}
function get_header_banner_image($pageId, $title) {
  $src = wp_get_attachment_image_src(get_post_thumbnail_id($pageId), false, '');
  if (!empty($src[0])) {
    $header_banner = "<div class='banner'>";
    if (!empty($title)) {
      $header_banner .= "<div class='headingBG'><h1>" . $title . "</h1></div>";
    }
    $header_banner .= '<img src="'.$src[0].'" width="1600" height="400" alt="' . $title . '"/>';
    $header_banner .= '</div>';
    echo $header_banner;
  }

}

/* banner title for 404 page */

function get_404_banner_image($pageId, $title) {
  $src = wp_get_attachment_image_src(get_post_thumbnail_id($pageId), false, '');
  if (!empty($src[0])) {
    $header_banner = "<div class='banner'>";
    if (!empty($title)) {
      $header_banner .= "<div class='headingBG'><h1>" . custom_translate('Page not found', 'الص�?حة غير موجودة') . "</h1></div>";
    }
    $header_banner .= '<img src="'.$src[0].'" width="1600" height="400" alt=""/>';
    //  $header_banner .= "<img src='" . $src[0] . "' alt='" . $title . "' id='banner' />
    $header_banner .= '</div>';
    echo $header_banner;
  }
}

function get_header_banner_image_with_custom_title($pageId, $meta_text) {
  $src = wp_get_attachment_image_src(get_post_thumbnail_id($pageId), false, '');
  if (!empty($src[0])) {
    $custom_title = custom_translate(get_post_meta(get_the_ID(), $meta_text, true), get_post_meta(get_the_ID(), $meta_text . "_ar", true));
    if (empty($custom_title)) {
      $title = get_the_title();
    } else {
      $title = $custom_title;
    }

    $header_banner = "<div class='banner'>";
    if (!empty($title)) {
      $header_banner .= "<div class='headingBG'><h1> " . $title . "</h1></div>";
    }
    // $header_banner .= "<img src='" . $src[0] . "' alt='' id='banner' />
    $header_banner .= '<img src="'.$src[0].'" width="1600" height="400" alt=""/>';
    $header_banner .= "</div>";
    echo $header_banner;
  }
}

function get_header_banner_image_with_fixed_title($pageId, $title) {
  $src = wp_get_attachment_image_src(get_post_thumbnail_id($pageId), false, '');
  $header_banner = "<div class='banner'>";
    if (!empty($title)) {
      $header_banner .= "<div class='headingBG'><h1> " . $title . "</h1></div>";
    }
    // $header_banner .= "<img src='" . $src[0] . "' alt='' id='banner' />
    $header_banner .= '<img src="'.$src[0].'" width="1600" height="400" alt=""/>';
    $header_banner .= "</div>";
    echo $header_banner;
}

function get_prev_next_link($posttype) {
   if ($posttype == '') {
        previous_post_link('<div class="eventDetprebtnLeft">%link</div>', '<span>'.custom_translate('Previous Blog','مقالات سابقة').'</span>', false);
        next_post_link('<div class="eventDetprebtnRight">%link</div>', '<span>'.custom_translate('Next Blog','المدونة التالية').'</span>', false);
    }
    if ($posttype == 'news') {
        previous_post_link('<div class="eventDetprebtnLeft">%link</div>','<span>'.custom_translate('Previous News','أخبار السابق').'</span>', false);
        next_post_link('<div class="eventDetprebtnRight">%link</div>', '<span>'.custom_translate('Next News','أخبار المقبل').'</span>', false);
    }
    if ($posttype == 'events') {
        previous_post_link('<div class="eventDetprebtnLeft">%link</div>','<span>'.custom_translate('Previous Events','الأحداث السابقة').'</span>', false);
        next_post_link('<div class="eventDetprebtnRight">%link</div>', '<span>'.custom_translate('Next Events','الأحداث القادمة').'</span>', false);
    }
}

function get_featured_posts($shrt_code, $template = NULL, $link = NULL) {
  // $feat_content = do_shortcode($shrt_code, true);
  // if(!empty($feat_content)){
  echo "<div class='container'>
       <div class='col-lg-16 col-md-16 col-sm-16 col-xs-16 newsPageheading'>
        <h1>";
  if ($template == 'media-center') {
    if ($shrt_code == '[featured-news]') {
      echo custom_translate('PRESS RELEASES', 'البيانات الصح�?ية');
    } else if ($shrt_code == '[featured-publications]') {
      echo custom_translate('PUBLICATIONS', 'المنشورات');
    }
  } else {
    echo custom_translate('FEATURED', 'الأبرز');
  }
  echo "</h1>
        </div>
      </div>
      <div class='container'>
        <div class='col-lg-2 col-md-2 col-sm-2 col-xs-16'></div>";
  echo do_shortcode($shrt_code);
  // echo '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 newspageContent"></div>';
  // echo '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 newspageContent"></div>';
  echo "<div class='col-lg-2 col-md-2 col-sm-2 col-xs-16'></div>
      </div>";

  if ($template == 'media-center') {
    echo "<div class='container'>
      <div class='col-lg-2 col-md-2 col-sm-2 col-xs-16'></div>
      <div class='col-lg-12 col-md-12 col-sm-12 col-xs-16 medialoadmore medialoadmorepad'>
        <div class='loadmore'>";
    if ($shrt_code == '[featured-news]') {
      echo '<a href="' . $link . '">' . custom_translate(' View all Press Releases', 'عرض جميع البيانات الصح�?ية') . '</a>';
    } else if ($shrt_code == '[featured-publications]') {
      echo '<a href="' . $link . '">' . custom_translate('View all Publications', 'عرض جميع المنشورات') . '</a>';
    }
    echo "</div>
    </div>
    <div class='col-lg-2 col-md-2 col-sm-2 col-xs-16'></div>
  </div>";
  }
  // }  
}

// function get_media_content_sections($featured_content, $custom_pg_title, $tbl, $main_content_short_code) {
//   echo "<div class='container-fluid'>";
//   if (!empty($featured_content)) {
//     get_featured_posts($featured_content);
//   }
//   echo "<div class='container'>
//             <div class='col-lg-6 col-md-6 col-sm-8 col-xs-12'></div>
//               <div class='col-lg-6 col-md-6 col-sm-8 col-xs-12 dropdownpastevent'><h1>";
//   echo $custom_pg_title;
//   echo "     </h1> </div>
//             <div class='col-lg-4 col-md-4 col-sm-4 col-xs-16 dropdownpastevent'>
//             <div class='dropdownContainer'>";
//   echo get_sort_dropdowns($tbl);

//   echo "</div>
//         </div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-16'></div>
//       </div>
//       <div class='container prbottom'>";
//   echo do_shortcode($main_content_short_code);
//   echo '<div class="container"><div class="col-lg-16 col-md-16 col-sm-16 col-xs-16 innerpage_divider"><img src="' . INC_URL_IMG . DS . 'innerPagedivider.jpg" alt="news_divider_img"></div>
//   ';
// }

function get_media_content_sections($featured_content, $custom_pg_title, $tbl, $main_content_short_code,$title,$null,$content, $class='emirates-review', $prev_class = 'emirates-previous') {

  $html ='';
  if($class != '') {
    $html .= 'id="'.$class.'" ';
  }else{
    $html .= '';
  }

  echo '<div '.$html.'>';
        echo '<div class="container helpCentreBox">';
            if($title != '') {
              echo '<h1 class="content_header">'.$title.'</h1>';
            }
            echo '<div class="center wow">'.$content.'</div>';
            echo '<div class="row emiSlider_container">';
                    echo do_shortcode($featured_content);
            echo '</div>';
          echo '</div>';
  echo '</div>';
   
  $string_title = str_replace(' ', '', get_the_title());
  echo '<div id="'.$prev_class.'">
          <div class="container helpCentreBox">
            <div class="row">
      <a id='.$string_title.'></a>
              <h1 class="content_header">'.$custom_pg_title.'</h1>';

                if($tbl == 'fh_financial_reports_startdate'){
                  //echo get_financialyrs_cat().'</div>';
                   echo get_financialyrs_cat();
                }else{
                  //echo get_sort_dropdowns($tbl).'</div>';
                  echo get_sort_dropdowns($tbl);
                }
              //echo '<div class="row">';
                echo do_shortcode($main_content_short_code);
              //echo '</div>
            echo '</div>
          </div>
        </div>';
}

    


function get_media_center_sections($featured, $link) {
  if (!empty($featured)) {
    get_featured_posts($featured, 'media-center', $link);
  }
}

function capm_custom_admin_css() {
  //wp_enqueue_style('admin_styles', get_template_directory_uri() . '/css/admin_section.css');
}

add_action('admin_head', 'capm_custom_admin_css');
/* 1620 */

// function get_videos(){
//   // return get_videos_page_sorting();
// }

function get_videos_page_sorting() {
  echo "<div class='col-lg-16 col-md-16 col-sm-16 col-xs-16 aboutcampHed'>
      <h1>" . custom_translate('Video Gallery', 'معرض ال�?يديو') . "</h1>
    </div>
    <div class='galleryMainContainer dropdownvideo'>
    <div class='gallerypadContainer'>
      <div class='dropdownpastevent'>
        <div class='dropdownContainer'>";
  get_sort_dropdowns('videos');
  echo "</div>   
      </div>
    </div>
  </div>";
}

function get_video_thumbs($results) {
    $site_url = site_url();
    $imageURL = $site_url . '/wp-content/plugins/oqey-gallery/images/no-2-photo.jpg';
    $closeImagePath = $site_url . "/wp-content/themes/fhg-fhg-theme/includes/images/close.png";

    $data_div = "";

    foreach ($results as $val) {
  
  
  
        $videoURL = $site_url . '/' . $val->video_link;

        $imageURL = "";
        if (!empty($val->video_image)) {
            $imageURL = $site_url . '/' . trim($val->video_image);
        }

        $style = "";
        if ($val->type == "oqey") {
            $link = "<a onclick=\"data_popup('" . $closeImagePath . "', '" . $videoURL . " ');\" id=\"wopenColorbox\"> ";
        } else {
            $link = "<a class='youtube' href='" . $val->video_link . "' data-lity> ";
        }

        $data_div .= "<li>" . $link . "<img src='$imageURL' alt='my image' title='gallery_img1'>";
        $data_div .= "<div class='mediaInformation'>";
        $data_div .= "<div class='innerContainer'>";
        
        if( $val->wp_title != '') {
          $data_div .= "<h2 class='helo'>" . custom_translate($val->wp_title, $val->wp_title) . "</h2>";
        }
        if( $val->wp_desc != ''){
          $data_div .= "<p>" . custom_translate($val->wp_desc, $val->wp_desc) . "</p>";
        }

//        $data_div .= "<h2>" . custom_translate($image_gal->title, $image_gal->arabic_title) . "</h2>";
//        $data_div .= "<p>" . custom_translate($image_gal->eng_desc, $image_gal->arab_desc) . "</p>";
        $data_div .= "</div></div></a></li>";
    }
    echo $data_div;
}

function paginationoQvideo($lang) {
  $page = get_query_var('page', 1);
  $total_per_page = 6;

  if (empty($page)) {
    $page = 1;
  } else {
    $page;
  }

  $start_from = ($page - 1) * $total_per_page;

  $total_Record = count(oQeyVideoPagiCount($lang));
  $total_pages = ceil($total_Record / $total_per_page);

  $next = $page + 1;
  if ($next > $total_pages) {
    $class1 = 'class="disabled"';
    $next = "#";
  } else {
    $class1 = '';
    $next;
  }

  $previous = $page - 1;

  if ($previous == 0) {
    $classpr = 'class="disabled"';
    $previous = "#";
  } else {
    $classpr = '';
    $previous;
  }

  if ($total_pages > 1) {
    $html = '<ul class="pagination setactive">';
    $html .='<li ' . $classpr . '>';
    $html .='<a href="' . get_permalink($post->ID) . '/?page=' . $previous . '" aria-label="Previous">
                  <span aria-hidden="true">previous</span>
                </a>
              </li>';

    for ($i = 1; $i <= $total_pages; $i++) {
      if ($i == $page) {
        $class = "current";
      } else {
        $class = "";
      }

      $html .='<li><a class="' . $class . '" href="' . get_permalink($post->ID) . '/?page=' . $i . '">' . $i . '</a></li>';
    }
    $html .='<li ' . $class1 . '>';
    $html .='<a href="' . get_permalink($post->ID) . '/?page=' . $next . '" aria-label="Next">
                  <span aria-hidden="true">next</span>
                </a>
              </li>
            </ul>';
  }
  echo $html;
}

function oQvideoList($lang) {
  $page = get_query_var('page', 1);
  $total_per_page = 6;

  if (empty($page)) {
    $page = 1;
  } else {
    $page;
  }

  $start_from = ($page - 1) * $total_per_page;
  $results = oQeyVideo($lang, $start_from, $total_per_page);

  $count = count(explode('&', $_SERVER['QUERY_STRING']));
  if($count == 2){
    $results = oQeyVideosortmonthyear($lang, $start_from, $total_per_page, $_GET['month'],$_GET['yr']);
  }else{
    if (isset($_GET['month']) || isset($_GET['yr'])) {
    if (isset($_GET['month'])) {
      $results = oQeyVideosortmonth($lang, $start_from, $total_per_page, $_GET['month']);
    }

    if (isset($_GET['yr'])) {
      $results = oQeyVideosortyear($lang, $start_from, $total_per_page, $_GET['yr']);
    }
    }
   }
  echo get_video_thumbs($results);
}

if (!current_user_can('manage_options')) {
  show_admin_bar(false);
}

function demo($mimes) {
  if (function_exists('current_user_can'))
    $unfiltered = $user ? user_can($user, 'unfiltered_html') : current_user_can('unfiltered_html');
  if (!empty($unfiltered)) {
    $mimes['swf'] = 'application/x-shockwave-flash';
  }
  return $mimes;
}

add_filter('upload_mimes', 'demo');

function get_single_ecards($id) {
  
  global $wpdb;
  $sql = "select * from ".$wpdb->prefix."ecards where id = $id";
  $result = $wpdb->get_row($sql);

  return $result;
}

function get_followlinks() {

  if (!dynamic_sidebar(custom_translate('Social Follow', 'Social Follow'))) : else : endif;
}

function get_applynowform() {
  echo "<div id='formsspace'><div id='applynowfrm' class='row' style='display:none;'>";
  echo custom_translate(do_shortcode('[contact-form-7 id="1660" title="Apply Now"]'), do_shortcode('[contact-form-7 id="1666" title="Apply Now - Arabic"]'));
  echo "</div></div>";
}

function get_videos($image) {

    if (isset($image->youtube_url) && !empty($image->youtube_url)) {
      echo '<iframe style="display:block;"id="' . basename($image->youtube_url) . '"width="100%" height="100%" scrolling="auto" src="' . $image->youtube_url . '?version=3&enablejsapi=1" frameborder="0" allowfullscreen autoplay controls></iframe>';
    }

    if (isset($image->upload_video) && !empty($image->upload_video)) {
      echo '<video width="320" height="240" controls>
    <source src="' . $image->upload_video . '" type="video/mp4">
    Your browser does not support the video tag.
  </video>';
  }
}

function get_the_content_with_formatting($truncate = false, $trun_count = 0, $more_link_text = '(more...)', $stripteaser = 0, $more_file = '') {
  $content = get_the_content($more_link_text, $stripteaser, $more_file);
  if ($truncate) {
    $content = explode(" ", $content);
    $content = implode(" ", array_splice($content, 0, $trun_count));
    //$content = wp_trim_words( $content , $trun_count);
  }
  $content = apply_filters('the_content', $content);
  // $content = str_replace(']]>', ']]&gt;', $content);  
  return $content;
}

function get_media_center_template() {
  echo '<div class="container-fluid">
    <div class="row">';
  get_media_center_sections('[featured-news]', SITE_URL . DS . custom_translate('news/', 'ar/مركز-الإعلام/البيانات-الصح�?ية/'));
  get_media_center_sections('[featured-publications]', SITE_URL . DS . custom_translate('media-center/publications', 'ar/المنشورات/'));
  echo "<div class='container'>
        <div class='col-lg-2 col-md-2 col-sm-2 col-xs-16'></div>
        <div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 newspageContent emptycontainer'></div>
        <div class='col-lg-2 col-md-2 col-sm-2 col-xs-16'></div>
  </div>";
}

add_filter('admin_footer_text', '__return_empty_string', 11);
add_filter('update_footer', '__return_empty_string', 11);

function wpbeginner_remove_version() {
  return '';
}

add_filter('the_generator', 'wpbeginner_remove_version');

function generate_css_id_for_tabs($post_id) {
  $str = str_replace(' ', '-', strtolower(get_the_title(pll_get_post($post_id, 'en'))));
  $str = str_replace('&', '', $str);
  $str = str_replace('#038;-', '', $str);
  $str = str_replace(',-', '', $str);
  $str = str_replace('#8217;', '', $str);
  $str = str_replace("’", '', $str);
  $str = str_replace("/", '', $str);
  return $str;
}

add_filter('wpcf7_support_html5_fallback', '__return_true');

/*PG - 1623 - Search Custom Query*/
function search_oqeycustom($search_val) {
  global $wpdb;
  $combo_result = "";
  $oqey_table_gal = $wpdb->prefix . "oqey_gallery";
  $search_val = '"%' . $search_val . '%"';
  $mediagal_results = $wpdb->get_results('SELECT title, arabic_title, eng_desc, arab_desc FROM ' . $oqey_table_gal . ' WHERE (`title` LIKE ' . $search_val . ' OR `arabic_title` LIKE ' . $search_val . ' OR `eng_desc` LIKE ' . $search_val . ' OR `arab_desc` LIKE ' . $search_val . ') ORDER BY `id` LIMIT 50');
  $img_gal_link = SITE_URL . DS . 'pictures#content-area';
  if ($mediagal_results) {
    foreach ($mediagal_results as $single_row) {
      $res_title = $single_row->title;
      $result_id = $single_row->id;
      $combo_result .= '<h3 class="page-title searchresult"><a href="' . $img_gal_link . '">' . $res_title . '</a></h3>';
    }
  } else {
    $oqey_table_video = $wpdb->prefix . "oqey_video";
    $mediavid_results = $wpdb->get_results('SELECT title, video_link FROM ' . $oqey_table_video . ' WHERE (`title` LIKE ' . $search_val . ') ORDER BY `id` LIMIT 50');
    $img_video_link = SITE_URL . DS . 'videos#content-area';
    if ($mediavid_results) {
      foreach ($mediavid_results as $single_row) {
        $res_title = $single_row->title;
        $combo_result .= '<h3 class="page-title searchresult"><a href="' . $img_video_link . '">' . $res_title . '</a></h3>';
      }
    }
  }
  return $combo_result;
}

/*PG - 1623 - Search Custom Query*/

function currentyear() {
  return date('Y');
}
add_shortcode('wp-current-year', 'currentyear');

function filter_ptags_on_images($content){
    return  preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

add_filter('the_content', 'filter_ptags_on_images');
add_filter('acf_the_content', 'filter_ptags_on_images');

function get_values_from_array($post_data,$contentcnteng,$contentcntarab,$titlecnt,$content,$custom_pdf=NULL){
      $postdata['id'] = $post_data['ID'];
      $post_title = $post_data['post_title'];
      $post_content = $post_data['post_content'];
      $postdata['customurl'] = $post_data['guid'];
      $custom = get_post_custom($postdata['id']);
      $sd = $custom[$content][0];
      $ed = $custom[$content][0];
      if($custom_pdf){
        $postdata['download_url'] = custom_translate($custom[$custom_pdf][0],$custom[$custom_pdf.'_ar'][0]);
      }
      $post_content1 = substr($post_content, 0, custom_translate($contentcnteng, $contentcntarab));
      $postdata['content1'] = substr($post_content1, 0, strrpos($post_content1, ' ') + 1);
      $postdata['content'] = wp_trim_words($post_content, custom_translate($contentcnteng, $contentcntarab), '...');
      $postdata['title'] = wp_trim_words($post_title, $titlecnt, '...');
      $postdata['title1'] = trimcontent($post_title, $titlecnt);
      $postdata['date'] = date('jS F Y', $sd);    // eng date
      $postdata['date_ar'] = transfullmonth(date('d F Y', $sd)); //arabic date

      $postdata['day'] = custom_translate(date('j', $sd),date('j', $sd));
      $postdata['month'] =  custom_translate(date('M', $sd),transfullmonth(date('F', $sd)));
      $postdata['year'] =  custom_translate(date('Y', $sd),date('Y', $sd));

      if (wp_get_attachment_url(get_post_thumbnail_id($postdata['id']))) {
        $postdata['feat_image'] = wp_get_attachment_url(get_post_thumbnail_id($postdata['id']));
        $postdata['feat_image_url'] = '<img src="' . $postdata['feat_image'] . '" width="150" height="150" class="img-responsive" alt="' . $postdata['title'] . '"/>';
      } else {
        $postdata['feat_image'] = INC_URL_IMG . DS . 'ih_custom_logo.jpg';
        $postdata['feat_image_url'] = '<img src="' . $postdata['feat_image'] . '" alt="' . $postdata['title'] . '"/>';
        $postdata['feat_image'] = INC_URL_IMG . DS . 'ih_custom_logo.jpg';
      }
      $postdata['arrowurl'] = INC_URL_IMG . DS . 'aarrow-brown.png';

      $postdata['read'] = '<a href="' . $postdata['customurl'] . '">' . custom_translate('Read More', 'اقرأ المزيد') . '</a>';
      return $postdata;
}


add_filter( 'style_loader_tag', function( $link, $handle )
{
    
        $link = str_replace( '/>', ' property="" />', $link );
  
    return $link;
}, 10, 2 );



/*CODE EXCLUSIVE TO FH*/
// for replacing --- option with plz select in all contact form 7 //


function my_wpcf7_form_elements($html) {
    $text = custom_translate('Please select...','من �?ضلك اختر ...');
    $html = str_replace('<option value="">---</option>', '<option value="">' . $text . '</option>', $html);
    return $html;
}
add_filter('wpcf7_form_elements', 'my_wpcf7_form_elements');

function imagecount($gal_id) {
    global $wpdb;
   $imgcount = "SELECT id FROM ".$wpdb->prefix."oqey_images WHERE status = 0 and gal_id ='$gal_id'";
    return count($wpdb->get_results($imgcount));
}

function galleryPaginate($query, $method) {
    global $wpdb;
  $customPagHTML = "";
    $total_query = "SELECT COUNT(1) FROM (${query}) AS combined_table";
    $total = $wpdb->get_var($total_query);
  
  
  if($_SESSION['width_window'] > 480){
    $items_per_page = '6';
   }else{
    $items_per_page = '3';
   }
  

    $page = isset($_GET['cpage']) ? abs((int) $_GET['cpage']) : 1;
    $offset = ( $page * $items_per_page ) - $items_per_page;
    $result = $method($offset . " , " . $items_per_page, $query);
    $totalPage = ceil($total / $items_per_page);

    if (isset($_GET['id'])) {
        $querystring = array('cpage' => custom_translate('%#%','%#%'), 'id' => $_GET['id']);
    } else {
        $querystring = array('cpage' => custom_translate('%#%','%#%'));
    }
// custom_translate(str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),SITE_URL.'/ar/البيانات-الصح�?ية%_%')
    $locale = get_locale();
    if (!empty($locale) && $locale == 'ar') {
        $pageURL = SITE_URL.'/ar/media/pictures/';
        //echo $pageURL;
        //$page = trans($page);
        $page = $page;
        $totalPage1 = $totalPage;
        //$totalPage1 = trans($totalPage);
        //echo $totalPage1;
    } else {
        $pageURL = SITE_URL . $_SERVER["REQUEST_URI"];

        $totalPage1 = $totalPage;
    }

    if ($totalPage > 1) {
        $customPagHTML = '<div class="divpagination">';
        $pages = paginate_links(array(
            'base' => add_query_arg($querystring, $pageURL),
            'format' => '',
            'prev_text' => __(custom_translate('', '')),
            'next_text' => __(custom_translate('', '')),
            'total' => $totalPage,
            'type' => 'array',
            'current' => $page
        ));

        if (is_array($pages)) {
            //   $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
            $customPagHTML.= '<ul class = "pagination">';
            foreach ($pages as $page) {
                $customPagHTML .= "<li>$page</li>";
            }
            $customPagHTML .= '</ul>';
        }

       // echo '</div>';
    }
    return json_encode(array('result' => $result, 'paginate' => $customPagHTML));
}

function get_financialyrs_cat() {
    $args = array(
        'taxonomy' => 'financialreports_category',
        'orderby' => 'name',
        'order' => 'DESC'
    );
    $categories = get_categories($args);

    if (isset($_GET['finyr']) && !empty($_GET['finyr'])) {
        $sortyear = "YEAR " . $_GET['finyr'];
    } else {
        $sortyear = "YEAR " . $categories[1]->name;
    }


   $li .= '<div class="emiratesupper financedropdown">
            <div class="emirates-dropdown">
              <div class="btn-group">
                <button type="button" class="btn btn-default" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.$sortyear.'</button>
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="caret"></span>
                  <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu">';
                  $check_arabic = check_arabic();

                  foreach ($categories as $item) {
                    $li .= "<li><a href='" . get_the_permalink() . '?finyr=' . $item->name . "'> ";
                    if ($check_arabic) {
                      $li .= trans($item->name);
                    } else {
                      $li .= $item->name;
                    }
                    $li .= "</a></li>";
                  }
                $li .= " </ul>
              </div>
            </div>
          </div>";

echo $li;

}

function get_featured_posts_news($shrt_code, $template = NULL, $link = NULL) {
    echo '<div class="welcome-text text-center">
       <h1>';
    if ($template == 'media') {
        if ($shrt_code == '[featured-news-fh]') {
            echo custom_translate('PRESS RELEASES', 'البيانات الصح�?ية');
        }
    } else {
        echo custom_translate('FEATURED', 'الأبرز');
    }
    echo "</h1>
          </div>";
    echo "<div class='media-container'>";
    echo do_shortcode($shrt_code);
    if ($shrt_code == '[featured-news-fh]') {
        echo '<div class="loadmore"><a href="' . $link . '">' . custom_translate(' View all Press Releases', 'عرض جميع البيانات الصح�?ية') . '</a></div>';
    }
    echo '</div>';

    // }
}

function get_post_details($title, $content) {

    echo "<div class='welcome-text text-center'><h1>";
    echo $title;
    echo "</h1></div>";
    if (!empty($content)) {
        echo '<div class="emirates_review">';
        echo $content;
        echo '</div>';
    }
}

function get_the_content_with_format($content)
{
      $content = apply_filters('the_content', $content);
    return $content;
}
function get_the_content_with_mytrim($content ,$count = 10) {
      $content = wp_trim_words($content, $count);
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    return $content;
}

function get_the_content_without_mytrim($content ,$count = 10) {
      $content = wp_trim_words($content, 0);
      
        $content = explode(" ", $content);
        $content = implode(" ", array_splice($content, 0, $count));
   
    return $content;
}

function get_the_content_with_formatting_trim($truncate = false, $trun_count = 0, $more_link_text = '(more...)', $stripteaser = 0, $more_file = '',$temp=NULL,$contentorigin=0) {
    $content = get_the_content($more_link_text, $stripteaser, $more_file);

    if ($truncate) {
        $content = explode(" ", $content);
        $content = implode(" ", array_splice($content, $contentorigin, $trun_count));
    }
    $content = my_content_filter($content);
    $content = apply_filters('the_content', $content);
    $content = strip_tags( $content, '<p>,<ul>,<ol>,<li>' );  
    return $content;
}

/*Apply now*/
function get_applynowform_product() {
    echo '<div id="applynowmodal" class="modal fade" role="dialog">';
    echo '<div class="modal-dialog">';
    echo'<div class="modal-content">';
    echo '<div class="modal-body">';
    echo custom_translate(do_shortcode('[contact-form-7 id="1660" title="Apply Now"]'), do_shortcode('[contact-form-7 id="1666" title="Apply Now - Arabic"]'));
    echo'</div>';
    echo'<div class="modal-footer">';
    echo '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
    echo '</div>';
    echo '</div>';
    echo "</div>";
}

add_filter('post_thumbnail_html', 'remove_width_attribute', 10);
add_filter('image_send_to_editor', 'remove_width_attribute', 10);

function remove_width_attribute($html) {
    $html = preg_replace('/(width|height)="\d*"\s/', "", $html);
    return $html;
}

function getPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }

    if ($count == 1) {
        return "1 View";
    }
    return $count . ' Views';
}

function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    } else {
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}


remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

  function picturessection() {

        $query = queryGallery('nosort', '');
        $image_gallery_array = json_decode(galleryPaginate($query, 'oQeyGallery'));

        $image_gallery = $image_gallery_array->result;
        ?> <!-- Content Area Start -->

    <div class="media-image-gallery">
        <div class="mediaGallery">
            <ul>
    <?php
    $flag = 0;
    foreach ($image_gallery as $key => $image_gal) {

        $query = queryImages($image_gal->id, 'nosort', '');
        $gal_images = oQeyImage(1, $query);
        $mod = $key % 3;
        if ($mod == 0 || $key == 0) {
            $flag = $key - 1;
            ?>

        <?php } ?>

                    <li><a href="<?php echo SITE_URL . custom_translate('/pictures', '/ar/media/pictures/') . "?id=" . $image_gal->id; ?>"><img alt="" src="<?php echo $gal_images[0]->title; ?>">
                            <div class="imgwatermark"></div>
                            <div class="mediaInformation">
                                <div class="innerContainer">
                                    <h2><?php echo custom_translate($image_gal->title, $image_gal->arabic_title); ?></h2>
                                    <p><?php echo custom_translate($image_gal->eng_desc, $image_gal->arab_desc); ?></p>
                                    <div class="totalMedia">
                                        <span>Total Photos - <?php echo imagecount($image_gal->id); ?></span>
                                    </div>
                                </div>
                            </div>
                        </a></li>
                    <?php
                    $mod1 = ($key + 1) % 3;
                    if ($mod1 == 0) {

                    }
                }
                ?>
            
            <li class="loadmore">
                <a href="<?php echo SITE_URL . '/' . custom_translate('pictures', 'ar/media/pictures/') ?>"><?php echo custom_translate('View all Image Gallery', 'معرض الصو رعرض الصور'); ?></a></li>
        </ul>
        </div>
    </div>


<?php
}

  function getnewsdatas() {

        $args = array(
            'numberposts' => 1,
            'child_of' => 0,
            'orderby' => 'meta_value',
            'meta_key' => 'fhg_news_startdate',
            'order' => 'DESC',
            'post_type' => 'fhg_news',
            'post_status' => 'publish',
            'meta_query' => array(
                array(
                    'key' => 'featured-checkbox',
                    'value' => 'yes',
                    'compare' => '=',
                )
            ),
        );

        $arg_post_data = get_posts($args);
        return $arg_post_data;
    }




function videoscode() {
    ?>
  
    <?php if (is_page(193) || is_page(445)) { 
  get_sort_dropdowns('videos'); 
        
 } 
  ?>
    </div>
        <div class="mediaGallery">
            <ul>
    <?php
    if (check_arabic()) {
        $lang = "arabic";
    } else {
        $lang = "english";
    }
    oQvideoList($lang);
    ?>
           
    <?php if (is_page(custom_translate(193,445)) ) { ?>
                <li><div class="paginationContainer text-center">
                  <?php paginationoQvideo($lang); ?> <!--1621 Does not consider sorted data.-->
                </div></li>
    <?php } else { ?>
                <li class="loadmore">
                    <a href="<?php echo SITE_URL . '/' . custom_translate('videos', 'ar/media/videos/') ?>"><?php echo custom_translate('View all Video Gallery', 'عرض جميع معرض الصور') ?></a></li>
    <?php } ?>
      </ul>
        </div>

    <?php
    }

    add_shortcode('videosfunction', 'videoscode');

    function id_only_post_image($id) {

    $postcontent = get_post_field('post_content', $id);
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $postcontent, $matches);
    $first_img = $matches[1][0];
    return $first_img;
}

function my_content_filter($content) {
    $content = preg_replace('#(<[/]?img.*>)#U', '', $content);
    return $content;
}

function geteventsdata() {
    $args_post = array(
        'numberposts' => 4,
        'child_of' => 0,
        'orderby' => 'meta_value',
        'meta_key' => 'fhg_events_startdate',
        'order' => 'DESC',
        'post_type' => 'fhg_events',
        'post_status' => 'publish',
    );
    $events = get_posts($args_post);

    return $events;
}

// Remove issues with prefetching adding extra views
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

function trimcontent($content, $charcnt) {
  $postcontent = substr($content, 0, $charcnt);
  $constrlen = strlen($content);
  if ($constrlen > $charcnt) {
    $postcontent = substr($postcontent, 0, strrpos($postcontent, ' ') + 1);
    $postcontent .= '...';
  }
  return $postcontent;
}

// Get URL of first image in a post
function catch_that_image($featured = null, $custom_img = null) {
  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  $first_img = $matches[1][0];
  if (!empty($custom_img)) {
    $first_img = INC_URL_IMG . DS . $custom_img;
  } else if ($featured == 'featured-small') {
    if (has_post_thumbnail()) {
      $large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'featured-small');
      $first_img = $large_image_url[0];
    }
  }
  if (empty($first_img) || $featured == 'featured-large') {
    if (has_post_thumbnail() || $featured == 'featured-large') {
      $large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'featured-large');
      $first_img = $large_image_url[0];
    } else {
      $first_img = INC_URL_IMG . DS . 'blankImg1.jpg';
    }
  }
  return $first_img;
}

function investor_get_image($id){
  $large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id($id), 'featured-small');
      $first_img = $large_image_url[0];
      return $first_img;
}

function get_the_slug($id = null) {
    if (empty($id)):
        global $post;
        if (empty($post))
            return ''; // No global $post var available.
        $id = $post->ID;
    endif;

    $slug = basename(get_permalink($id));
    return $slug;
}

function the_slug($id = null) {
    echo apply_filters('the_slug', get_the_slug($id));
}

function remove_empty_p($content) {
    $content = force_balance_tags($content);
    $content = preg_replace('#<p>\s*+(<br\s*/*>)?\s*</p>#i', '', $content);
    $content = preg_replace('~\s?<p>(\s|&nbsp;)+</p>\s?~', '', $content);
    return $content;
}

add_filter('the_content', 'remove_empty_p', 20, 1);

function search_form($form_id){
  $form_html = '';
  $form_html .='<div class="search_form">';
  $search_form_action = esc_url(home_url(custom_translate("/", "/ar/")));
  $form_html .='<form id="'.$form_id.'" method="get" class="search-form" action="'.$search_form_action.'" >
  <div class="searchPannel" style="display:none;" >
  <input type="text"  id="'.$form_id.'_div" class="searchtextbox search-field required" value="'.esc_attr(get_search_query()) . '" placeholder="'.custom_translate('search here...', 'ابحث هنا...').'" name="s" required>';
  $form_html .='</div>
  </form>
  </div>';

  return $form_html;
die;
}

function compare_months($a, $b) {
    $monthA = date_parse($a);
    $monthB = date_parse($b);

    return $monthA["month"] - $monthB["month"];
}

function paginationurl(){
    if (check_arabic()){
        $url = str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) );
    }else{
        if(isset($_GET['month']) && strstr($site_url.$_SERVER['REQUEST_URI'], '/page/') == false){
            $urlold = str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) );
            $url = $urlold.'?month='.$_GET['month'];
        }elseif(isset($_GET['yr']) && strstr($site_url.$_SERVER['REQUEST_URI'], '/page/') == false){
            $urlold = str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) );
            $url = $urlold.'?yr='.$_GET['yr'];
        }else{
            $url = str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) );
        }
    }

    return $url;
}

//Top Nav Breadcrumb

function get_topnav_breadcrumbs() {
    echo " <div class='container-fluid breadcrumsBG'>
    <div class='container'>
      <div class='row'>
        <div class='col-lg-8 col-md-8 col-sm-8 col-xs-12 leftbreadcrumb'>
          <ul class='breadcrumb'>
            <li><a href='" . SITE_URL . custom_translate("", "/ar/") . "' class='homeicon'>&nbsp;</a></li>";
    if (function_exists('menu_breadcrumb')) {
        menu_breadcrumb('header_top_menu');
    }
    echo "</ul>
        </div>";
    echo get_addthissharelinks();
    echo "</div>
    </div>
  </div>";
}


class Corporate_Finance_Tabs extends Walker_Nav_Menu {

    function start_el(&$output, $item, $depth, $args) {
        global $wp_query;

        $indent = ( $depth ) ? str_repeat("\t", $depth) : '';
        $class_names = $value = '';
        $classes = empty($item->classes) ? array() : (array) $item->classes;

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item));
        $class_names = ' class="' . esc_attr($class_names);
        if (check_arabic()) {
            if (substr_count($item->url, '/ar') > 1) {
                $modifiedurl = str_replace_once('/ar', '', $item->url);
            } else {
                $modifiedurl = $item->url;
            }
        }



        if (get_permalink(fhg_get_current_post_id()) == esc_attr($item->url)) {

            $class_names .= ' active ';
        }
        $class_names .= '"';

        $output .= $indent . '<li id="menu-item-' . $item->ID . '"' . $value . $class_names . '>';

        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .=!empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .=!empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .=!empty(custom_translate($item->url, $modifiedurl)) ? ' href="' . esc_attr(custom_translate($item->url, $modifiedurl)) . '#content-area"' : '';

        $item_output = $args->before;

        $item_output .= '<a' . $attributes . '>';
        // $item_output .= '<div class="card_icon"><img src="' . INC_URL_IMG . DS . $item->description . '.png"></div>';
        $item_output .= '<span>' . $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after . '</span>';
        $item_output .= '</a>';
        $item_output .= $args->after;
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

}

function get_cf_tabs() {
    $tabs = new Corporate_Finance_Tabs;
    $options = array('theme_location' => 'corporate-finance-tabs-menu', 'walker' => $tabs, // Setting up the location for the main-menu, Main Navigation.
        'container_class' => "",
        'items_wrap' => '<ul id="%1$s" class="nav nav-tabs corporatefinancetabs">%3$s</ul>',
        'echo' => false
    );
    $nav = wp_nav_menu($options);
    $nav = str_replace('class=" "', '', $nav);
    echo $nav;
}
//Personal Finance Menus


function str_replace_once($str_pattern, $str_replacement, $string) {

    if (strpos($string, $str_pattern) !== false) {
        $occurrence = strpos($string, $str_pattern);
        return substr_replace($string, $str_replacement, strpos($string, $str_pattern), strlen($str_pattern));
    }

    return $string;
}

class Personal_Finance_Tabs extends Walker_Nav_Menu {

    function start_el(&$output, $item, $depth, $args) {
        global $wp_query;

        $indent = ( $depth ) ? str_repeat("\t", $depth) : '';
        $class_names = $value = '';
        $classes = empty($item->classes) ? array() : (array) $item->classes;

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item));
        $class_names = ' class="' . esc_attr($class_names);
        if (check_arabic()) {
            if (substr_count($item->url, '/ar') > 1) {
                $modifiedurl = str_replace_once('/ar', '', $item->url);
            } else {
                $modifiedurl = $item->url;
            }
        }



        if (get_permalink(fhg_get_current_post_id()) == esc_attr($item->url)) {

            $class_names .= ' active ';
        }
        $class_names .= '"';

        $output .= $indent . '<li id="menu-item-' . $item->ID . '"' . $value . $class_names . '>';

        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .=!empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .=!empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .=!empty(custom_translate($item->url, $modifiedurl)) ? ' href="' . esc_attr(custom_translate($item->url, $modifiedurl)) . '#content-area"' : '';

        $item_output = $args->before;

        $item_output .= '<a' . $attributes . '>';
        // $item_output .= '<div class="card_icon"><img src="' . INC_URL_IMG . DS . $item->description . '.png"></div>';
        $item_output .= '<span>' . $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after . '</span>';
        $item_output .= '</a>';
        $item_output .= $args->after;
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

}

function get_pf_tabs() {
    $tabs = new Personal_Finance_Tabs;
    $options = array('theme_location' => 'personal-finance-tabs-menu', 'walker' => $tabs, // Setting up the location for the main-menu, Main Navigation.
        'container_class' => "",
        'items_wrap' => '<ul id="%1$s" class="nav nav-tabs creditcompare">%3$s</ul>',
        'echo' => false
    );
    $nav = wp_nav_menu($options);
    $nav = str_replace('class=" "', '', $nav);
    echo $nav;
}


class PFCredit_Cards extends Walker_Nav_Menu {

    function start_el(&$output, $item, $depth, $args) {
        global $wp_query;

        $indent = ( $depth ) ? str_repeat("\t", $depth) : '';
        $class_names = $value = '';
        $classes = empty($item->classes) ? array() : (array) $item->classes;

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item));
        $class_names = ' class="' . esc_attr($class_names);

        if (get_permalink(fhg_get_current_post_id()) == esc_attr($item->url)) {
            $class_names .= ' active ';
        }
        $class_names .= '"';

        $output .= $indent . '<li id="menu-item-' . $item->ID . '"' . $value . $class_names . '>';

        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .=!empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .=!empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .=!empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

        //$attributes .=!empty($item->url) ? ' href="' . esc_attr($item->url) . '#content-area"' : '';

        $item_output = $args->before;

        $item_output .= '<a' . $attributes . ' >';
        // $item_output .= '<div class="card_icon"><img src="' . INC_URL_IMG . DS . $item->description . '.png"></div>';
        $item_output .= '<span>' . $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after . '</span>';
        $item_output .= '</a>';
        $item_output .= $args->after;
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

}

function get_personal_finance_credit_cards() {
    $tabs = new PFCredit_Cards;
    $options = array('theme_location' => 'personal-finance-credit-cards', 'walker' => $tabs, // Setting up the location for the main-menu, Main Navigation.
        'container_class' => "",
        'items_wrap' => '<ul id="%1$s">%3$s</ul>',
        'echo' => false
    );
    $nav = wp_nav_menu($options);
    $nav = str_replace('class=" "', '', $nav);
    echo $nav;
}

add_shortcode('shrt_personal_finance_credit_cards', 'get_personal_finance_credit_cards');

function register_personal_finance_menu() {
    register_nav_menu('personal-finance-tabs-menu', __('Personal Finance Tabs'));
    register_nav_menu('personal-finance-credit-cards', __('Personal Finance Credit Cards'));
    register_nav_menu('corporate-finance-tabs-menu', __('Corporate Finance Tabs'));
    register_nav_menu('header-top-menu-mobile', __('Header Top Menu Mobile'));
    
}


add_action('init', 'register_personal_finance_menu');

function fhg_get_current_post_id() {
    global $post;
    return $post->ID;
}

function getValueHouse(){
  dynamic_sidebar(custom_translate('Value House', 'Value House - Arabic')); 

}

add_shortcode('valuehousetabs','getValueHouse');

function header_topnav_menu (){
   if ( has_nav_menu( 'header_top_menu' ) ) : 
                wp_nav_menu( array(
                        'theme_location'    => 'header_top_menu',
                        'depth'             => 2,
                        'container'         => 'div',
                        'container_class'   => 'collapse navbar-collapse navbar-1-collapse',
                        'menu_class'        => 'nav navbar-nav',
                        'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                        'walker'            => new wp_bootstrap_navwalker())
                );
              endif;
}

function header_topnav_menu_mobile (){
   if ( has_nav_menu( 'header_top_menu' ) ) : 
                wp_nav_menu( array(
                        'theme_location'    => 'header-top-menu-mobile',
                        'depth'             => 2,
                        'container'         => 'div',
                        'container_class'   => 'collapse navbar-collapse navbar-1-collapse',
                        'menu_class'        => 'nav navbar-nav',
                        'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                        'walker'            => new wp_bootstrap_navwalker())
                );
              endif;
}

function header_primary_menu(){
  if ( has_nav_menu( 'main_menu' ) ) :
    wp_nav_menu( array(
        'theme_location'    => 'main_menu',
        'depth'             => 2,
        'container'         => 'div',
        'container_class'   => 'collapse navbar-collapse navbar-right',
        'menu_class'        => 'nav navbar-nav',
        'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
        'walker'            => new wp_bootstrap_navwalker())
      );
    endif;
}

function get_Month_Years_data($startdate,$posttype){

  $count = count(explode('&', $_SERVER['QUERY_STRING']));
  if($count == 2){
   global $wpdb;
  $monthval = $_GET['month'];
  $yearval = $_GET['yr'];
  $sq = "SELECT * FROM $wpdb->postmeta WHERE DATE_FORMAT( FROM_UNIXTIME(  `meta_value` ) ,  '%b' ) =  '$monthval' AND DATE_FORMAT( FROM_UNIXTIME(  `meta_value` ) ,  '%Y' ) =  '$yearval' AND meta_key = '$startdate'";
      
    $months1 = $wpdb->get_results($sq);
      foreach ($months1 as $month) {
        $monthval1 = $month->post_id;
        $postidarr[] = $month->post_id;
      }
      $args = array(
          'numberposts' => -1,
          'post_type' => $posttype,
          'post__in' => $postidarr,
           'post_status' => 'publish',
           // 'posts_per_page' => 10, 
           // 'paged' => get_query_var('paged') ? get_query_var('paged') : 1
      );
      return get_posts($args);
  
  }else{
    if (isset($_GET['month']) && !empty($_GET['month'])) {
      $monthval = $_GET['month'];
      global $wpdb;
      $sq = "SELECT * FROM $wpdb->postmeta WHERE DATE_FORMAT( FROM_UNIXTIME(  `meta_value` ) ,  '%b' ) =  '$monthval' AND meta_key = '$startdate'";
      $months1 = $wpdb->get_results($sq);
      foreach ($months1 as $month) {
        $monthval1 = $month->post_id;
        $postidarr[] = $month->post_id;
      }
      $args = array(
          'numberposts' => -1,
          'post_type' => $posttype,
          'post__in' => $postidarr,
           'post_status' => 'publish',
           // 'posts_per_page' => 10, 
           // 'paged' => get_query_var('paged') ? get_query_var('paged') : 1
      );
      return get_posts($args);
    }

    if (isset($_GET['yr']) && !empty($_GET['yr'])) {
    $yearval = $_GET['yr'];
    global $wpdb;
     $sq = "SELECT * FROM $wpdb->postmeta WHERE DATE_FORMAT( FROM_UNIXTIME(  `meta_value` ) ,  '%Y' ) =  '$yearval' AND meta_key = '$startdate'";
    $years1 = $wpdb->get_results($sq);
    foreach ($years1 as $year) {
      $yearval1 = $year->post_id;
      $postidarr[] = $year->post_id;
    }
    $args = array(
      'numberposts' => -1,
      'post_type' => $posttype,
      'post__in' => $postidarr,
      'post_status' => 'publish',
      // 'posts_per_page' => 10, 
      // 'paged' => get_query_var('paged') ? get_query_var('paged') : 1
    );
    return get_posts($args);
    }
  }

  
}

//Return the products contact form
function getProductContactForm() {
   echo '<div id="applynowfrm" class="finance_applynowfrm" style="display:none">';
    echo custom_translate(do_shortcode('[contact-form-7 id="1660" title="Apply Now"]'), do_shortcode('[contact-form-7 id="1666" title="Apply Now - Arabic"]')); 
  echo '</div>';
}

// Add custom post types - events and books to main RSS feed.
    function mycustomfeed_cpt_feed( $query ) {
            if ( $query->is_feed() ) {
              $query->set( 'post_type', array( 'page', 'fhg_news', 'fh_annual_reports' ) );
              $query->set( 'post_limits', '__return_empty_string' ); 
              return $query;
            }
    }
    add_filter( 'pre_get_posts', 'mycustomfeed_cpt_feed' );
  
  //PG-1986
/*  
function load_ajax_gathumbs() {
  global $wpdb;
  
  $method = 'oQeyImage';
  $gal_id = $_POST['gal_id'];
  $total_thumbnails = $_POST['total_thumbnails'];
  
  $query = queryImages($gal_id, 'nosort', '');
  
  $total_query = "SELECT COUNT(1) FROM (${query}) AS combined_table";
  $total = $wpdb->get_var($total_query);
  
  if( $total_thumbnails <= $total ) {

    $page = isset($_GET['cpage']) ? abs((int) $_GET['cpage']) : 1;

    $result = $method($total_thumbnails.", 6" , $query);
    foreach ($result as $key) {
      echo '<li><img title="gallery_img4" alt="my image" width="100" height="100" src="'. $key->title.'"></li>';
    }
    exit;
  } else {
    exit;
  }
  
}

add_action ( 'wp_ajax_nopriv_fhg_gal_thumbs', 'load_ajax_gathumbs' );
add_action ( 'wp_ajax_fhg_gal_thumbs', 'load_ajax_gathumbs' );
*/



//PG-1986
/*-------------------- added on 23/03/2016 -------------------*/
function load_ajax_gathumbs() {
  global $wpdb;
  
  $method = 'oQeyImage';
  $gal_id = $_POST['gal_id'];
  $total_thumbnails = $_POST['total_thumbnails'];
  $new_count = $_POST['new_count'];
  $width_window = $_POST['width_window'];
  $limit_per_page = 6;
  if($width_window > 480){
    $limit_per_page = 6;
  }else{
    $limit_per_page = 3;
  }
  
  $query = queryImages($gal_id, 'nosort', '');
  
  $total_query = "SELECT COUNT(1) FROM (${query}) AS combined_table";
  $total = $wpdb->get_var($total_query);
  
  if( $total_thumbnails <= $total ) {

    $page = isset($_GET['cpage']) ? abs((int) $_GET['cpage']) : 1;

    $result = $method($total_thumbnails.",".$limit_per_page , $query);
    $counter = 0;
    foreach ($result as $key) {

      if( count($result) < $limit_per_page ) {
        $t = ($total_thumbnails*185)+(count($result)*185)-($limit_per_page*185);
      } else {
        $t = ($total_thumbnails*185);
      }

      $data_comment = '';
      if( $key->comments != '' ){
        $data_comment .= 'data-comment ="'.$key->comments.'"';
      }
      if( $key->arabic_description != '' ){
        $data_comment .= 'data-arabic-desc ="'.$key->arabic_description.'"';
      }
      if( $key->arabic_comments != '' ){
        $data_comment .= 'data-arabic-comment ="'.$key->arabic_comments.'"';
      }

      $li_list .=  '<li data-count="'.++$new_count.'" data-final="'.$total.'" >
              <img src="'. $key->title.'" class="imgclick" alt="'. $key->alt.'" '.$data_comment.' />
            </li>';
            $counter++;

    }
    echo $counter . '|' . $li_list;
    exit;
  } else {
    exit;
  }
  
}

function fhg_gal_thumbs_windows_width_load(){
  $_SESSION['width_window'] = '';
  $width_window = $_POST['width_window'];
  $_SESSION['width_window'] = $width_window;  
  exit;
}
add_action ( 'wp_ajax_nopriv_fhg_gal_thumbs_windows_width', 'fhg_gal_thumbs_windows_width_load' );
//add_action ( 'wp_ajax_fhg_gal_thumbs_windows_width', 'fhg_gal_thumbs_windows_width_load' );
add_action ( 'wp_ajax_nopriv_fhg_gal_thumbs', 'load_ajax_gathumbs' );
add_action ( 'wp_ajax_fhg_gal_thumbs', 'load_ajax_gathumbs' );


/*-------------------- added on 23/03/2016 -------------------*/

/* PG - 1623 - online banking*/
function online_banking(){
  return '<div class="online-banking"> <a href="#"><img alt="icon-online-banking" src="'. INC_URL_IMG . DS . 'online_bank_icon.png' . '"><span>'. custom_translate("Online Banking", "الخدمات المصرفية عبر الانترنت") . '</span></a> </div>';
}

?>