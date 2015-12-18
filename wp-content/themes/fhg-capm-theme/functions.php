<?php
/**
 * FHG CAPM Theme functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package FHG CAPM Theme
 */
//PG - 1623
require_once( get_template_directory() . '/includes/php/config_path.php');



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
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on FHG CAPM Theme, use a find and replace
     * to change 'fhg-capm-theme' to the name of your theme in all the template files
     */
    load_theme_textdomain('fhg-capm-theme', get_template_directory() . '/languages');

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');


    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'fhg-capm-theme'),
    ));

    if (function_exists('add_theme_support')) {
      add_theme_support('post-thumbnails', array('post', 'page', 'news', 'events', 'capm_events', 'board-of-directors')); // enable feature
      add_image_size('news', 500, 400, true);
      add_image_size('board-of-directors', 140, 184, true);
      add_image_size( 'news_thumbnail', 50, 50, true );

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

    // Set up the WordPress core custom background feature.
    add_theme_support('custom-background', apply_filters('custom_theme_custom_background_args', array(
        'default-color' => 'ffffff',
        'default-image' => '',
    )));
  }

endif; // custom_theme_setup
add_action('after_setup_theme', 'custom_theme_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function custom_theme_content_width() {
  $GLOBALS['content_width'] = apply_filters('custom_theme_content_width', 640);
}

add_action('after_setup_theme', 'custom_theme_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function custom_theme_widgets_init() {
  register_sidebar(array(
      'name' => esc_html__('Sidebar', 'fhg-capm-theme'),
      'id' => 'sidebar-1',
      'description' => '',
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget' => '</aside>',
      'before_title' => '<h2 class="widget-title">',
      'after_title' => '</h2>',
  ));
}

add_action('widgets_init', 'custom_theme_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function custom_theme_scripts() {
  //    wp_enqueue_style( 'style.css', INC_URL_CSS . DS . "style.css" );
  wp_enqueue_style('fhg-capm-theme-bxslider', INC_URL_CSS . DS . "jquery.bxslider.css");
  //wp_enqueue_style( 'fhg-capm-theme-bootstrapar', INC_URL_CSS . DS . "bootstrap_ar.css" );
  //wp_enqueue_style( 'fhg-capm-theme-lightbox', INC_URL_CSS . DS . "lightbox.css" );
  wp_enqueue_style('fhg-capm-theme-colorbox', INC_URL_CSS . DS . "colorbox.css");
  wp_enqueue_style('fhg-capm-theme-fontawesome', INC_URL_CSS . DS . "font-awesome/css/font-awesome.css");
  //wp_enqueue_style( 'fhg-capm-theme-booststrap', INC_URL_CSS . DS . "bootstrap.min.css" );
  wp_enqueue_script('fhg-capm-theme-bxslider', get_template_directory_uri() . '/includes/js/jquery.bxslider.js', array(), '', true);

  wp_enqueue_script('fhg-capm-theme-owlcarousel', get_template_directory_uri() . '/includes/js/owl.carousel.js', array(), '', true);

  wp_enqueue_script('fhg-capm-theme-fitvids', get_template_directory_uri() . '/includes/js/jquery.fitvids.js', array(), '', true);
  wp_enqueue_script('fhg-capm-theme-lightbox', get_template_directory_uri() . '/includes/js/lightbox.js', array(), '', true);
  wp_enqueue_script('fhg-capm-theme-jqtransform', get_template_directory_uri() . '/includes/js/jquery.jqtransform.js', array(), '', true);
  wp_enqueue_script('fhg-capm-theme-colorbox', get_template_directory_uri() . '/includes/js/jquery.colorbox.js', array(), '', true);
  wp_enqueue_script('fhg-capm-theme-hovergrid', get_template_directory_uri() . '/includes/js/jquery.hoverGrid.js', array(), '', true);
  wp_enqueue_script('path.js', get_template_directory_uri() . '/includes/js/path.js', array(), '', true);
  wp_enqueue_script('fhg-capm-theme-scrolltofixed', get_template_directory_uri() . '/includes/js/jquery-scrolltofixed.js', array(), '', false);
  wp_enqueue_script('fhg-capm-theme-common', get_template_directory_uri() . '/includes/js/commons.js', array(), '', false);
  wp_enqueue_script('fhg-capm-theme-slideout', get_template_directory_uri() . '/includes/js/jquery.tabSlideOut.v1.3.js', array(), '20120206', true);
  wp_enqueue_script('fhg-capm-theme-social-feeds', get_template_directory_uri() . '/includes/js/social_feedss.js', array(), '', false);
  wp_enqueue_script('fhg-capm-theme-bootstrapjs', get_template_directory_uri() . '/includes/js/bootstrap.min.js', array(), '', true);

  if (is_singular() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }
}

add_action('wp_enqueue_scripts', 'custom_theme_scripts');

function register_my_menu() {
  register_nav_menu('header-top-menu', __('Header Top Menu'));
}

add_action('init', 'register_my_menu');

function wpb_imagelink_setup() {
  $image_set = get_option('image_default_link_type');

  if ($image_set !== 'none') {
    update_option('image_default_link_type', 'none');
  }
}

add_action('admin_init', 'wpb_imagelink_setup', 10);

function my_format_TinyMCE($in) {
  $in['remove_linebreaks'] = false;
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
  $in['block_formats'] = 'Main Header=h1;Sub Header=h2; Small Header=h3;Paragraph =p;';
  $in['apply_source_formatting'] = false;
  $in['toolbar1'] = 'bold,italic,strikethrough,bullist,numlist,hr,alignleft,aligncenter,mailto, alignright,link,unlink,spellchecker,wp_fullscreen,wp_adv ';
  $in['toolbar2'] = 'formatselect,underline,alignjustify,forecolor,pastetext,outdent,indent,undo,redo,wp_help ';
  $in['toolbar3'] = '';
  $in['toolbar4'] = '';
  return $in;
}

add_filter('tiny_mce_before_init', 'my_format_TinyMCE');

//Disable plugin updates in wordpress
remove_action('load-update-core.php', 'wp_update_plugins');
add_filter('pre_site_transient_update_plugins', '__return_null');

function register_footer_menus() {
  register_nav_menus(
          array(
              'fhcapital' => __('FH Capital'),
              'ourmission' => __('Our Mission'),
              'management' => __('Management'),
              'services' => __('Services'),
              'fhfamily' => __('FH Family')
          )
  );
}

add_action('init', 'register_footer_menus');

function capm_widgets_init() {


  register_sidebar(array(
      'name' => __('Welcome Page', 'capm'),
      'id' => 'capm-welcome',
      'description' => '',
      'before_widget' => '',
      'after_widget' => '',
      'before_title' => '<h1>',
      'after_title' => '</h1>',
  ));
  register_sidebar(array(
      'name' => __('Welcome Page - Arabic', 'capm'),
      'id' => 'capm-welcome_arabic',
      'description' => '',
      'before_widget' => '',
      'after_widget' => '',
      'before_title' => '<h1>',
      'after_title' => '</h1>',
  ));
  register_sidebar(array(
      'name' => __('Footer', 'capm'),
      'id' => 'capm-footer',
      'description' => '',
      'before_widget' => '',
      'after_widget' => '',
      'before_title' => '<h1>',
      'after_title' => '</h1>',
  ));
  register_sidebar(array(
      'name' => __('Footer - Arabic', 'capm'),
      'id' => 'capm-footer_arabic',
      'description' => '',
      'before_widget' => '',
      'after_widget' => '',
      'before_title' => '<h1>',
      'after_title' => '</h1>',
  ));
  register_sidebar(array(
      'name' => __('Fixed Footer Phone', 'capm'),
      'id' => 'fixed_footer_phone_widget',
      'description' => '',
      'before_widget' => '',
      'after_widget' => '',
      'before_title' => '<h1>',
      'after_title' => '</h1>',
  ));
  register_sidebar(array(
      'name' => __('Fixed Footer Phone- Arabic', 'capm'),
      'id' => 'fixed_footer_phone_arabic_widget',
      'description' => '',
      'before_widget' => '',
      'after_widget' => '',
      'before_title' => '<h1>',
      'after_title' => '</h1>',
  ));
  register_sidebar(array(
      'name' => __('Fixed Footer Disablitiies', 'capm'),
      'id' => 'fixed_footer_disabilities_widget',
      'description' => '',
      'before_widget' => '',
      'after_widget' => '',
      'before_title' => '<h1>',
      'after_title' => '</h1>',
  ));
  register_sidebar(array(
      'name' => __('Fixed Footer Disablitiies- Arabic', 'capm'),
      'id' => 'fixed_footer_disabilities_arabic_widget',
      'description' => '',
      'before_widget' => '',
      'after_widget' => '',
      'before_title' => '<h1>',
      'after_title' => '</h1>',
  ));
  register_sidebar(array(
      'name' => __('Fixed Footer Font Zoom', 'capm'),
      'id' => 'fixed_footer_fontzoom_widget',
      'description' => '',
      'before_widget' => '',
      'after_widget' => '',
      'before_title' => '<h1>',
      'after_title' => '</h1>',
  ));
  register_sidebar(array(
      'name' => __('Fixed Footer Font Zoom- Arabic', 'capm'),
      'id' => 'fixed_footer_fontzoom_arabic_widget',
      'description' => '',
      'before_widget' => '',
      'after_widget' => '',
      'before_title' => '<h1>',
      'after_title' => '</h1>',
  ));
  register_sidebar(array(
      'name' => __('Fixed Footer Product', 'capm'),
      'id' => 'fixed_footer_product_widget',
      'description' => '',
      'before_widget' => '',
      'after_widget' => '',
      'before_title' => '<h1>',
      'after_title' => '</h1>',
  ));
  register_sidebar(array(
      'name' => __('Fixed Footer Product - Arabic', 'capm'),
      'id' => 'fixed_footer_product_arabic_widget',
      'description' => '',
      'before_widget' => '',
      'after_widget' => '',
      'before_title' => '<h1>',
      'after_title' => '</h1>',
  ));

  register_sidebar(array(
      'name' => __('Contacts', 'capm'),
      'id' => 'contacts_widget',
      'description' => '',
      'before_widget' => '',
      'after_widget' => '',
      'before_title' => '<h1>',
      'after_title' => '</h1>',
  ));
  register_sidebar(array(
      'name' => __('Contacts - Arabic', 'capm'),
      'id' => 'contacts_arabic_widget',
      'description' => '',
      'before_widget' => '',
      'after_widget' => '',
      'before_title' => '<h1>',
      'after_title' => '</h1>',
  ));
  register_sidebar(array(
      'name' => __('Finance House', 'capm'),
      'id' => 'finance_house_widget',
      'description' => '',
      'before_widget' => '',
      'after_widget' => '',
      'before_title' => '<h1>',
      'after_title' => '</h1>',
  ));
  register_sidebar(array(
      'name' => __('Finance House - Arabic', 'capm'),
      'id' => 'finance_house_arabic_widget',
      'description' => '',
      'before_widget' => '',
      'after_widget' => '',
      'before_title' => '<h1>',
      'after_title' => '</h1>',
  ));
  register_sidebar(array(
      'name' => __('Islamic Finance House', 'capm'),
      'id' => 'islamic_finance_house_widget',
      'description' => '',
      'before_widget' => '',
      'after_widget' => '',
      'before_title' => '<h1>',
      'after_title' => '</h1>',
  ));
  register_sidebar(array(
      'name' => __('Islamic Finance House - Arabic', 'capm'),
      'id' => 'islamic_finance_house_arabic_widget',
      'description' => '',
      'before_widget' => '',
      'after_widget' => '',
      'before_title' => '<h1>',
      'after_title' => '</h1>',
  ));
  register_sidebar(array(
      'name' => __('Subscribe to Newsletter', 'capm'),
      'id' => 'email_widget',
      'description' => '',
      'before_widget' => '',
      'after_widget' => '',
      'before_title' => '<h1>',
      'after_title' => '</h1>',
  ));
  register_sidebar(array(
      'name' => __('Subscribe to Newsletter - Arabic', 'capm'),
      'id' => 'email_arabic_widget',
      'description' => '',
      'before_widget' => '',
      'after_widget' => '',
      'before_title' => '<h1>',
      'after_title' => '</h1>',
  ));
  register_sidebar(array(
      'name' => __('Logos', 'capm'),
      'id' => 'logos_widget',
      'description' => '',
      'before_widget' => '',
      'after_widget' => '',
      'before_title' => '<h1>',
      'after_title' => '</h1>',
  ));
  register_sidebar(array(
      'name' => __('Logos - Arabic', 'capm'),
      'id' => 'logos_arabic_widget',
      'description' => '',
      'before_widget' => '',
      'after_widget' => '',
      'before_title' => '<h1>',
      'after_title' => '</h1>',
  ));
  register_sidebar(array(
      'name' => __('Insurance House', 'capm'),
      'id' => 'insurance_house_widget',
      'description' => '',
      'before_widget' => '',
      'after_widget' => '',
      'before_title' => '<h1>',
      'after_title' => '</h1>',
  ));
  register_sidebar(array(
      'name' => __('Insurance House - Arabic', 'capm'),
      'id' => 'insurance_house_arabic_widget',
      'description' => '',
      'before_widget' => '',
      'after_widget' => '',
      'before_title' => '<h1>',
      'after_title' => '</h1>',
  ));
  register_sidebar(array(
      'name' => __('Finance House Securties', 'capm'),
      'id' => 'finance_house_securities_widget',
      'description' => '',
      'before_widget' => '',
      'after_widget' => '',
      'before_title' => '<h1>',
      'after_title' => '</h1>',
  ));
  register_sidebar(array(
      'name' => __('Finance House Securties - Arabic', 'capm'),
      'id' => 'finance_house_securities_arabic_widget',
      'description' => '',
      'before_widget' => '',
      'after_widget' => '',
      'before_title' => '<h1>',
      'after_title' => '</h1>',
  ));

  register_sidebar(array(
      'name' => __('Font Resizer', 'capm'),
      'id' => 'fontresize',
      'description' => '',
      'before_widget' => '<div id="fontresize">',
      'after_widget' => '</div>',
      'before_title' => '<h1>',
      'after_title' => '</h1>',
  ));

  register_sidebar(array(
      'name' => __('Font Resizer - Arabic', 'capm'),
      'id' => 'fontresize_arabic',
      'description' => '',
      'before_widget' => '<div id="fontresize_arabic">',
      'after_widget' => '</div>',
      'before_title' => '<h1>',
      'after_title' => '</h1>',
  ));

  register_sidebar(array(
      'name' => __('Social Follow ', 'capm'),
      'id' => 'socialfollow',
      'description' => '',
      'before_widget' => '',
      'after_widget' => '',
      'before_title' => '<h1>',
      'after_title' => '</h1>',
  ));
}

add_action('widgets_init', 'capm_widgets_init');

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
// Add featured image sizes
add_image_size('featured-large', 640, 294, true); // width, height, crop
add_image_size('featured-small', 320, 147, true);

// Add other useful image sizes for use through Add Media modal

add_image_size('medium-something', 470, 335, array('center', 'top'));

// Register the three useful image sizes for use in Add Media modal
add_filter('image_size_names_choose', 'wpshout_custom_sizes');

function wpshout_custom_sizes($sizes) {
  return array_merge($sizes, array(
      'medium-something' => __('Medium Something'),
  ));
}

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

class Menu_With_Description extends Walker_Nav_Menu {

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
    $item_output .= '';
            if (!empty($item->description)) {
           $item_output .= '<p id="menu-item-' . $item->ID . '" class="menu-item-desc">' . $item->description . '</p> <p class="readMore">';    
      $item_output .= '<a' . $attributes . '>';
      $item_output .= '>>Read More';
      $item_output .= '</a></p>';
    }
    $item_output .= $args->after;

    $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);

   
  }

    function start_lvl(&$output, $depth) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul class=\"children level-".$depth."\">\n";
  }
  
}

/* Read More Link 1742 */

function check_arabic() {
  $url = $_SERVER['REQUEST_URI'];
  return (strstr($url, '/ar/') == true);
}

function new_excerpt_more() {
  return ' <a class="read-more" href="' . get_permalink(get_the_ID()) . '">...ReadMore</a>';
}

add_filter('excerpt_more', 'new_excerpt_more');

/* Read More Link 1742 */

function oQeyVideo($lang, $start_from, $total_per_page) {
  global $wpdb;
  $results = $wpdb->get_results('SELECT * FROM fhg_capm_oqey_video WOV LEFt JOIN fhg_capm_video_desc WVD ON WOV.id = WVD.video_id WHERE WOV.status !=2 AND WVD.lang = "' . $lang . '" LIMIT ' . $start_from . ', ' . $total_per_page . '', OBJECT);

  return $results;
}

/* Sort Videos  1846 */

function oQeyVideosortmonth($lang, $start_from, $total_per_page, $month) {
  global $wpdb;
  $results = $wpdb->get_results('SELECT * FROM fhg_capm_oqey_video WOV LEFt JOIN fhg_capm_video_desc WVD ON WOV.id = WVD.video_id WHERE DATE_FORMAT((WOV.published_datetime) ,  "%b" ) = "' . $month . '" AND WOV.status !=2  AND WVD.lang = "' . $lang . '" LIMIT ' . $start_from . ', ' . $total_per_page . '', OBJECT);

  return $results;
}

function oQeyVideosortyear($lang, $start_from, $total_per_page, $year) {
  global $wpdb;
  $results = $wpdb->get_results('SELECT * FROM fhg_capm_oqey_video WOV LEFt JOIN fhg_capm_video_desc WVD ON WOV.id = WVD.video_id WHERE DATE_FORMAT((WOV.published_datetime) ,  "%Y" ) = "' . $year . '" AND WOV.status !=2  AND WVD.lang = "' . $lang . '" LIMIT ' . $start_from . ', ' . $total_per_page . '', OBJECT);

  return $results;
}

function oQeyVideoPagiCount($lang) {
  global $wpdb;
  $results = $wpdb->get_results('SELECT *  FROM fhg_capm_oqey_video WOV LEFt JOIN fhg_capm_video_desc WVD ON WOV.id = WVD.video_id WHERE WOV.status !=2 AND WVD.lang = "' . $lang . '"', OBJECT);
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

  if ($sortvalue == 'nosort') {
    return "SELECT title,alt,comments,arabic_description,arabic_comments,published_datetime FROM fhg_capm_oqey_images WHERE status = 0 and gal_id ='$gal_id'";
  }
  if ($sortvalue == 'month') {
    return "SELECT title,alt,comments,arabic_description,arabic_comments,published_datetime FROM  fhg_capm_oqey_images WHERE DATE_FORMAT((`published_datetime` ) ,  '%b' ) =  '$value' AND status = 0 and gal_id ='$gal_id'";
  }

  if ($sortvalue == 'year') {
    return "SELECT title,alt,comments,arabic_description,arabic_comments,published_datetime FROM  fhg_capm_oqey_images WHERE DATE_FORMAT((`published_datetime` ) ,  '%Y' ) =  '$value' AND status = 0 and gal_id ='$gal_id' ";
  }
}

/* 1621 query for pictures gallery and (1846)sorting queries based on month and year */

function queryGallery($sortvalue, $value) {
  if ($sortvalue == 'nosort') {
    return "SELECT id,title,folder,arabic_title FROM  fhg_capm_oqey_gallery WHERE status = 0 and id NOT IN (1,2,3,12) ";
  }
  if ($sortvalue == 'month') {
    return "SELECT id,title,folder,arabic_title FROM  oqey_gallery WHERE DATE_FORMAT((`published_datetime` ) ,  '%b' ) =  '$value' AND status = 0 and id NOT IN (1,2,3,12) ";
  }

  if ($sortvalue == 'year') {
    return "SELECT id,title,folder,arabic_title FROM  oqey_gallery WHERE DATE_FORMAT((`published_datetime` ) ,  '%Y' ) =  '$value' AND status = 0 and id NOT IN (1,2,3,12) ";
  }
}

function homeboxes() {
  global $wpdb;
  $qry = "SELECT * FROM `fhg_capm_oqey_images` WHERE gal_id =12 ORDER BY img_order ASC";
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
    menu_breadcrumb('primary');
  }
  echo'</ul>';
}

/* PLEASE CHECK AND REMOVE THIS FUNCTION IF NOT REQUIRED */

/* 1621 Pagination */

function galleryPaginate($query, $method) {
  global $wpdb;

  $customPagHTML = "";
  $total_query = "SELECT COUNT(1) FROM (${query}) AS combined_table";
  $total = $wpdb->get_var($total_query);
  $items_per_page = 6;
  $page = isset($_GET['cpage']) ? abs((int) $_GET['cpage']) : 1;
  $offset = ( $page * $items_per_page ) - $items_per_page;
  $result = $method($offset . " , " . $items_per_page, $query);
  $totalPage = ceil($total / $items_per_page);

  if (isset($_GET['id'])) {
    $querystring = array('cpage' => '%#%', 'id' => $_GET['id']);
  } else {
    $querystring = array('cpage' => '%#%');
  }

  $locale = get_locale();
  if (!empty($locale) && $locale == 'ar') {
    $pageURL = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"];
    $page = trans($page);
    $totalPage1 = trans($totalPage);
  } else {
    $pageURL = SITE_URL . $_SERVER["REQUEST_URI"];
    $totalPage1 = $totalPage;
  }

  if ($totalPage > 1) {
    $customPagHTML = '<div class="picgalleryMainContainer"><ul class="pagination"><li>' . paginate_links(array(
                'base' => add_query_arg($querystring, $pageURL),
                'format' => '',
                'prev_text' => __('previous'),
                'next_text' => __('next'),
                'total' => $totalPage,
                'current' => $page
            )) . '</li></ul></div></div>';
  }
  return json_encode(array('result' => $result, 'paginate' => $customPagHTML));
}

function trans($year) {
  $western_arabic = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
  $eastern_arabic = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
  $year = str_replace($western_arabic, $eastern_arabic, $year);

  return $year;
}

function transmonth($month) {
  $western_arabic = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
  $eastern_arabic = array('يناير', 'فبراير', 'مارس', 'أبريل', 'مايو',  'يونيو', 'يوليو', 'أغسطس', 'سبتمبر', 'أكتوبر', 'نوفمبر', 'ديسمبر');
  $month = str_replace($western_arabic, $eastern_arabic, $month);

  return $month;
}

function transfullmonth($month_full) {
  $western_arabic = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
  $eastern_arabic = array('يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو', 'يوليو', 'أغسطس', 'سبتمبر', 'أكتوبر', 'نوفمبر', 'ديسمبر');
  $month_full = str_replace($western_arabic, $eastern_arabic, $month_full);

  return $month_full;
}

function custom_translate($english, $arabic) {
  $prnt_string = "";
  if (check_arabic()) {
    $prnt_string = $arabic;
  } else {
    $prnt_string = $english;
  }
  return $prnt_string;
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
  $qry1 = "SELECT * FROM `fhg_capm_oqey_images` WHERE gal_id = 1 AND status = 0;";
  $images = $wpdb->get_results($qry1);

  return $images;
}

function getContactFormProduct() {
  if (check_arabic()) {
    echo '<h3>اطلب خدمةً</h3>';
    /* 1623-Temporarily Deactivated */
    //echo do_shortcode('[contact-form-7 id="931" title="Apply for product - Arabic"]');
    echo do_shortcode('[contact-form-7 id="931" title="Apply for product"]');
  } else {
    echo '<h3>Apply for a service</h3>';
    echo do_shortcode('[contact-form-7 id="927" title="Apply for product"]');
  }
}

function getContactFormFeedback() {
  if (check_arabic()) {
    echo '<h3>ملاحظات</h3>';
    /* 1623-Temporarily Deactivated */
    echo do_shortcode('[contact-form-7 id="930" title="Feedback - Arabic"]');
    // echo do_shortcode('[contact-form-7 id="928" title="Feedback"]');
  } else {
    echo '<h3>Feedback</h3>';
    echo do_shortcode('[contact-form-7 id="928" title="Feedback"]');
  }
}

/* pg 1620 */

function get_primary_breadcrumbs() {
  echo " <div class='container-fluid breadcrumsBG'>
    <div class='row'>
      <div class='container'>
        <div class='col-lg-10 col-md-10 col-sm-8 col-xs-16 leftbreadcrumb'>
          <ul class='breadcrumb'>
            <li><a href='" . SITE_URL . custom_translate("", "/ar/") . "' class='homeicon'>&nbsp;</a></li>";
  if (function_exists('menu_breadcrumb')) {
    menu_breadcrumb('primary');
  }
  echo "</ul>
        </div>";
  echo get_addthissharelinks();
  echo "</div>
    </div>
  </div>";
}

function get_addthissharelinks() {
  return "<div class='col-lg-6 col-md-6 col-sm-8 col-xs-16 rightbreadcrumb'>
            <div class='sharenetcontainer'> <span>" . custom_translate("Share On", "شارك على") . "</span>
              <div class='shareNet'>
                <div class='addthis_toolbox addthis_default_style addthis_16x16_style'>
                  <a class='addthis_button_facebook'></a>
                  <a class='addthis_button_twitter'></a>
                  <a class='addthis_button_linkedin'></a>
                  <a class='addthis_button_email'></a>
                </div>
              </div>
            </div>
          </div>";
}
/* breadcrumb for 404 page not found */
function get_404_breadcrumbs() {
  echo "<div class='container-fluid breadcrumsBG'>
    <div class='row'>
      <div class='container'>
        <div class='col-lg-8 col-md-8 col-sm-8 col-xs-16 leftbreadcrumb'>
          <ul class='breadcrumb'>";
     echo  "<li><a href='" . SITE_URL . custom_translate("", "/ar/") . "' class='homeicon'>&nbsp;</a></li>";
  echo "<span class='sep'> / </span>
  <li>Page not found</li>";
  echo "</ul>
        </div>";
  echo get_addthissharelinks();
  echo "</div>
    </div>
  </div>";
}

function get_post_breadcrumbs() {
  echo " <div class='container-fluid breadcrumsBG'>
    <div class='row'>
      <div class='container'>
        <div class='col-lg-10 col-md-10 col-sm-8 col-xs-16 leftbreadcrumb'>
          <ul class='breadcrumb'>
            <li><a href='" . SITE_URL . custom_translate("", "/ar/") . "' class='homeicon'>&nbsp;</a></li>
            <span class='sep'> / </span>";
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
    <div class='row'>
      <div class='container'>
        <div class='col-lg-10 col-md-10 col-sm-8 col-xs-16 leftbreadcrumb'>
          <ul class='breadcrumb'>
            <li><a href='" . SITE_URL . custom_translate("", "/ar/") . "' class='homeicon'>&nbsp;</a></li>
            <span class='sep'> / </span>";
  $get_ancestor = $parent_title_id;
  $arr = get_post_ancestors($get_ancestor);
  $get_ancestor = $arr[0];
  get_the_title();
  echo "<li><a href='" . get_page_link($get_ancestor) . "'>" . get_the_title($get_ancestor) . "</a></li>";
  echo "<span class='sep'> / </span><li><a href= '" . get_page_link($parent_title_id) . "'>" . $child_title . "</a></li>";
  echo "<span class='sep'> / </span><li><a href=" . "#>" . get_the_title() . "</a></li>";
  echo "</ul>
        </div>";

  echo get_addthissharelinks();
  echo "</div>
      </div>
    </div>";
}

function custom_wp_nav_menu() {
  $walker = new Menu_With_Description;
  $options = array('theme_location' => 'primary', 'walker' => $walker, // Setting up the location for the main-menu, Main Navigation.
      'container_class' => "",
      'items_wrap' => '<ul id="%1$s" class="%2$s nav navbar-nav pull-right">%3$s</ul>',
      'echo' => false
  );

  $nav = wp_nav_menu($options);
  $nav = str_replace('class=" "', '', $nav);
  echo $nav;
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
      'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul></li>',
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
    $url = custom_translate("events-sponserships/?", "ar/الرعاية-والفعاليات/?");
  }
  if ($tbl == "fhg_news_startdate") {
    $url = custom_translate("news/?", "ar/البيانات-الصحفية/?");
  }

  if ($tbl == "fhg_publications_startdate") {
    $url = custom_translate("publications/?", "ar/المنشورات/?");
  }

  $yr_months = $wpdb->get_col("SELECT DISTINCT meta_value FROM fhg_capm_postmeta AS pm JOIN fhg_capm_posts AS p ON pm.post_id = p.ID WHERE meta_key = '$tbl' AND post_status = 'publish'");

  if ($tbl == "videos") {
    $url = custom_translate("videos/?", "ar/الفيديو/?");
    $yr_months = $wpdb->get_col("SELECT DISTINCT UNIX_TIMESTAMP(published_datetime) FROM fhg_capm_oqey_video WHERE status= 0");
  }

  if ($tbl == "picgallery") {
    $url = custom_translate("pictures/?", "ar/الصور/?");
    $yr_months = $wpdb->get_col("SELECT DISTINCT UNIX_TIMESTAMP(published_datetime) FROM fhg_capm_gallery WHERE status = 0 and id NOT IN (1,2,3,12)");
  }

  if ($tbl == "pictures") {
    $id = $_GET['id'];
    //$qry=  "SELECT DISTINCT UNIX_TIMESTAMP(published_datetime) FROM fhg_capm_oqey_images WHERE status = 0 and gal_id = $id";    
    $url = custom_translate("pictures/?id=" . $id . "&", "ar/الصور/?id=" . $id . "&");
    $yr_months = $wpdb->get_col("SELECT DISTINCT UNIX_TIMESTAMP(published_datetime) FROM fhg_capm_images WHERE status = 0 and gal_id = $id");
  }

  
  foreach ($yr_months as $yr_month) {

    $gmts[] = date('M', $yr_month);
    $gmts_years[] = date('Y', $yr_month);
  }

  $months = array_unique($gmts);
  $years = array_unique($gmts_years);

  if (!empty($yr_months)) {
    $month_li = get_dropdown($url, $months, "month=", custom_translate("by Month", "حسب الشهر"));
    $year_li = get_dropdown($url, $years, "yr=", custom_translate("by Year", "حسب السنة"));
    echo $month_li . $year_li;
  }
}

function get_dropdown($url, $ary, $type, $default_val) {
  $li = "<div class='dropdown'>
    <button class='btn dropdown-toggle' type='button' data-toggle='dropdown'>"
          . $default_val .
          "<span class='caret1'></span>
    </button>
    <ul class='dropdown-menu'> ";
  $check_arabic = check_arabic();
  foreach ($ary as $item) {
    $li .= "<li><a href='" . SITE_URL . DS . $url . $type . $item . "'> ";
    if ($check_arabic) {
      $li .= transmonth($item);
    } else {
      $li .= $item;
    }
    $li .= "</a>
      </li>";
  }
  $li .= " </ul>
  </div>";
  return $li;
}

function get_header_banner_image($pageId, $title) {
  $src = wp_get_attachment_image_src(get_post_thumbnail_id($pageId), false, '');
  if (!empty($src[0])) {    
    $header_banner = "<div class='headerbanner'>
    <div class='innerBanner'>";
    if (!empty($title)) {
      $header_banner .= "<div class='bannerLable'> " . $title . "</div>";
    }
	 $header_banner .= '<div id="banner" class="inner_banner_background about" style="background-image: url(' . $src[0] .')">';  
	 //  $header_banner .= "<img src='" . $src[0] . "' alt='" . $title . "' id='banner' />
    $header_banner .=  '</div>
     </div>
     </div>';
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

    $header_banner = "<div class='headerbanner'>
    <div class='innerBanner'>";
    if (!empty($title)) {
      $header_banner .= "<div class='bannerLable'> " . $title . "</div>";
    }
    $header_banner .= "<img src='" . $src[0] . "' alt='' id='banner' />
      </div>
    </div>";
    echo $header_banner;
  }
}

function get_header_banner_image_with_fixed_title($pageId, $title) {
  $src = wp_get_attachment_image_src(get_post_thumbnail_id($pageId), false, '');
  $header_banner = "<div class='headerbanner'>
    <div class='innerBanner'>";
  if (!empty($title)) {
    $header_banner .= "<div class='bannerLable'> " . $title . "</div>";
  }
  $header_banner .= "<img src='" . $src[0] . "' alt='' id='banner' />
      </div>
    </div>";
  echo $header_banner;
}

function get_prev_next_link($posttype) {
  if ($posttype == '') {
    previous_post_link('<div class="eventDetprebtnLeft">%link</div>', "<img src='" . get_template_directory_uri() . "/includes/images/blogpreBtn" . custom_translate("", "_ar") . ".jpg" . "'/>", false);
    next_post_link('<div class="eventDetprebtnRight">%link</div>', "<img src='" . get_template_directory_uri() . "/includes/images/blognextBtn" . custom_translate("", "_ar") . ".jpg" . "'/>", false);
  }
  if ($posttype == 'news') {
    previous_post_link('<div class="eventDetprebtnLeft">%link</div>', "<img src='" . get_template_directory_uri() . "/includes/images/newsDetailpreBtn" . custom_translate("", "_ar") . ".jpg" . "'/>", false);
    next_post_link('<div class="eventDetprebtnRight">%link</div>', "<img src='" . get_template_directory_uri() . "/includes/images/newsDetailnxtBtn" . custom_translate("", "_ar") . ".jpg" . "'/>", false);
  }
  if ($posttype == 'events') {
    previous_post_link('<div class="eventDetprebtnLeft">%link</div>', "<img src='" . get_template_directory_uri() . "/includes/images/eventDetailpreBtn" . custom_translate("", "_ar") . ".jpg" . "'/>", false);
    next_post_link('<div class="eventDetprebtnRight">%link</div>', "<img src='" . get_template_directory_uri() . "/includes/images/eventDetailnxtBtn" . custom_translate("", "_ar") . ".jpg" . "'/>", false);
  }
  if ($posttype == 'publications') {
    previous_post_link('<div class="eventDetprebtnLeft">%link</div>', "<img src='" . get_template_directory_uri() . "/includes/images/publicprebtn" . custom_translate("", "_ar") . ".jpg" . "'/>", false);
    next_post_link('<div class="eventDetprebtnRight">%link</div>', "<img src='" . get_template_directory_uri() . "/includes/images/publicnxtbtn" . custom_translate("", "_ar") . ".jpg" . "'/>", false);
  }
}

function get_featured_posts($shrt_code, $template=NULL, $link=NULL) {
  // $feat_content = do_shortcode($shrt_code, true);
  // if(!empty($feat_content)){
  echo "<div class='container'>
       <div class='col-lg-16 col-md-16 col-sm-16 col-xs-16 newsPageheading'>
        <h1>";  
          if($template == 'media-center'){
            if($shrt_code == '[featured-news]'){
              echo custom_translate('PRESS RELEASES', 'الأبرز');
            }else if($shrt_code == '[featured-publications]'){
              echo custom_translate('PUBLICATIONS', 'الأبرز');
            }
          } else{
            echo custom_translate('FEATURED', 'الأبرز');
          }   
    echo "</h1>
        </div>
      </div>
      <div class='container'>
        <div class='col-lg-2 col-md-2 col-sm-2 col-xs-16'></div>";
      echo do_shortcode($shrt_code);
        // echo '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-16 newspageContent"></div>';
        // echo '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-16 newspageContent"></div>';
      echo "<div class='col-lg-2 col-md-2 col-sm-2 col-xs-16'></div>
      </div>";

 if($template == 'media-center'){
  echo "<div class='container'>
      <div class='col-lg-2 col-md-2 col-sm-2 col-xs-16'></div>
      <div class='col-lg-12 col-md-12 col-sm-12 col-xs-16 medialoadmore medialoadmorepad'>
        <div class='loadmore'>"; 
          if($shrt_code == '[featured-news]'){
            echo '<a href="'.$link.'">'.custom_translate(' View all Press Releases','عرض جميع البيانات الصحفية').'</a>';
          }else if($shrt_code == '[featured-publications]'){
            echo '<a href="'.$link.'">'.custom_translate('View all Publications','عرض جميع المنشورات').'</a>';
          } 
      echo "</div>
    </div>
    <div class='col-lg-2 col-md-2 col-sm-2 col-xs-16'></div>
  </div>";
  } 
  // }  
}

function get_media_content_sections($featured_content, $custom_pg_title, $tbl, $main_content_short_code) {
  echo "<div class='container-fluid'>";
  if (!empty($featured_content)) {
    get_featured_posts($featured_content);
  }
  echo "<div class='container'>
            <div class='col-lg-2 col-md-2 col-sm-2 col-xs-16'></div>
              <div class='col-lg-8 col-md-8 col-sm-8 col-xs-16 dropdownpastevent'><h1>";
  echo $custom_pg_title;
  echo "     </h1> </div>
            <div class='col-lg-4 col-md-4 col-sm-4 col-xs-16 dropdownpastevent'>
            <div class='dropdownContainer'>";
  echo get_sort_dropdowns($tbl);

  echo "</div>
        </div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-16'></div>
      </div>
      <div class='container prbottom'>";
  echo do_shortcode($main_content_short_code);
  echo '<div class="container"><div class="col-lg-16 col-md-16 col-sm-16 col-xs-16 innerpage_divider"><img src="'.INC_URL_IMG . DS . 'innerPagedivider.jpg"></div></div>
  </div>';
}

function get_media_center_sections($featured,$link) {
  if (!empty($featured)) {
    get_featured_posts($featured,'media-center',$link);
  }
}


/* 1620 */
/* ADMIN PANEL SETTINGS - CAPM SECTIONS (Add menu item for custom post types) */
add_action('admin_menu', 'register_my_custom_menu_page');

function register_my_custom_menu_page() {
  add_menu_page('CAPMsections', 'CAPM Sections', 'manage_options', 'annet-fhg-capm-all/index.php', '', '', 4);
}

function capm_custom_admin_css() {
  wp_enqueue_style('admin_styles', get_template_directory_uri() . '/includes/css/admin_section.css');
}

add_action('admin_head', 'capm_custom_admin_css');
/* 1620 */

// function get_videos(){
//   // return get_videos_page_sorting();
// }

function get_videos_page_sorting() {
  echo "<div class='col-lg-16 col-md-16 col-sm-16 col-xs-16 aboutcampHed'>
      <h1>" . custom_translate('Video Gallery', 'معرض الفيديو') . "</h1>
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
  $closeImagePath = $site_url . "/wp-content/themes/fhg-capm-theme/includes/images/close.png";

  $data_div = "";
  $data_div = "<div class='col-lg-2 col-md-2 col-sm-2 col-xs-16'></div>
        <div class='col-lg-12 col-md-12 col-sm-12 col-xs-16 innerpageContent mediagallery'>";
  
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
      $link = "<a class='youtube' href='" . $val->video_link . "'> ";
    }

    $data_div .= "<div class='gallerypadContainer' >
    <div class='galleryhoverBox hover-grid'>
      <div class='item hover-grid-item'>";
    $data_div .= $link;
    $data_div .= "<img src='$imageURL' alt='my image' title='gallery_img1'>
          <div class='caption' style='display: none;'>
            <h2> " . $val->wp_title . "</h2>
            <p> " . $val->wpeditimage_disable_captions . "</p>
          </div>
        </a>
      </div>
    </div>
  </div>";
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

  if (isset($_GET['month']) || isset($_GET['yr'])) {
    if (isset($_GET['month'])) {
      $results = oQeyVideosortmonth($lang, $start_from, $total_per_page, $_GET['month']);
    }

    if (isset($_GET['yr'])) {
      $results = oQeyVideosortyear($lang, $start_from, $total_per_page, $_GET['yr']);
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
  $sql = "select * from fhg_capm_ecards where id = $id";
  $result = $wpdb->get_row($sql);

  return $result;
}

function get_followlinks() {

  if (!dynamic_sidebar(custom_translate('Social Follow', 'Social Follow'))) : else : endif;
}

function get_applynowform() {
  echo "<div id='applynowfrm' style='display:none;'>";
  echo custom_translate(do_shortcode('[contact-form-7 id="1327" title="Apply Now"]'), do_shortcode('[contact-form-7 id="1326" title="Apply Now - Arabic"]'));
  echo "</div>";
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

function get_the_content_with_formatting ($truncate = false, $trun_count = 0, $more_link_text = '(more...)', $stripteaser = 0, $more_file = '') {
  $content = get_the_content($more_link_text, $stripteaser, $more_file);
  if($truncate){
    $content = explode(" ", $content);
    $content = implode(" ", array_splice($content, 0, $trun_count));
    //$content = wp_trim_words( $content , $trun_count);
  }
  $content = apply_filters('the_content', $content);
 // $content = str_replace(']]>', ']]&gt;', $content);  
  return $content;
}


function get_media_center_template(){
  echo '<div class="container-fluid">
    <div class="row">';
      get_media_center_sections('[featured-news]', SITE_URL .DS. 'news');
      get_media_center_sections('[featured-publications]', SITE_URL . DS. 'media-center/publications');
      echo "<div class='container'>
        <div class='col-lg-2 col-md-2 col-sm-2 col-xs-16'></div>
        <div class='col-lg-6 col-md-6 col-sm-6 col-xs-16 newspageContent emptycontainer'></div>
        <div class='col-lg-2 col-md-2 col-sm-2 col-xs-16'></div>
      </div>
    </div>
  </div>";
}


// add_filter( 'wp_nav_menu_objects', 'my_wp_nav_menu_objects_sub_menu', 10, 2 );
// // filter_hook function to react on sub_menu flag
// function my_wp_nav_menu_objects_sub_menu( $sorted_menu_items, $args ) {
//   if ( isset( $args->sub_menu ) ) {
//     $root_id = 0;
    
//     // find the current menu item
//     foreach ( $sorted_menu_items as $menu_item ) {
//       if ( $menu_item->current ) {
//         // set the root id based on whether the current menu item has a parent or not
//         $root_id = ( $menu_item->menu_item_parent ) ? $menu_item->menu_item_parent : $menu_item->ID;
//         break;
//       }
//     }
    
//     // find the top level parent
//     if ( ! isset( $args->direct_parent ) ) {
//       $prev_root_id = $root_id;
//       while ( $prev_root_id != 0 ) {
//         foreach ( $sorted_menu_items as $menu_item ) {
//           if ( $menu_item->ID == $prev_root_id ) {
//             $prev_root_id = $menu_item->menu_item_parent;
//             // don't set the root_id to 0 if we've reached the top of the menu
//             if ( $prev_root_id != 0 ) $root_id = $menu_item->menu_item_parent;
//             break;
//           } 
//         }
//       }
//     }
//     $menu_item_parents = array();
//     foreach ( $sorted_menu_items as $key => $item ) {
//       // init menu_item_parents
//       if ( $item->ID == $root_id ) $menu_item_parents[] = $item->ID;
//       if ( in_array( $item->menu_item_parent, $menu_item_parents ) ) {
//         // part of sub-tree: keep!
//         $menu_item_parents[] = $item->ID;
//       } else if ( ! ( isset( $args->show_parent ) && in_array( $item->ID, $menu_item_parents ) ) ) {
//         // not part of sub-tree: away with it!
//         unset( $sorted_menu_items[$key] );
//       }
//     }
    
//     return $sorted_menu_items;
//   } else {
//     return $sorted_menu_items;
//   }
// }

/* PG - 1623 REMOVE WORDPRESS VERSION */

add_filter( 'admin_footer_text', '__return_empty_string', 11 );
add_filter( 'update_footer',     '__return_empty_string', 11 );

function wpbeginner_remove_version() {
return '';
}
add_filter('the_generator', 'wpbeginner_remove_version');

/* PG - 1623 REMOVE WORDPRESS VERSION */

function custom_menus() {

  global $post;
  $menu_name = 'primary';
  $locations = get_nav_menu_locations();
  $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
  $menu_items = wp_get_nav_menu_items($menu->term_id);
  
  $current_menu_id = 0;
  $count =0;
  // get current top level menu item id
  // foreach ( $menu_items as $item ) {
  //   if ( $item->object_id == $post->ID ) {
  //     // if it's a top level page, set the current id as this page. if it's a subpage, set the current id as the parent
  //     $current_menu_id = ( $item->menu_item_parent ) ? $item->menu_item_parent : $item->ID;
  //     break;
  //   }
  // }


  
  // display the submenu
  echo '<div class="navbar-collapse collapse collapseMini mobilemenu">
    <ul class="nav navbar-nav pull-right">
      <div class="menu-main-menu-container">';
  echo '<ul id="menu-main-menu" class="menu nav navbar-nav pull-right">';
  
  foreach ( $menu_items as $item ) {

    if ( $item->menu_item_parent == $current_menu_id ) {
       $class = ( $item->object_id == $post->ID ) ? "active" : "";
     
      echo '<li id="'.$item->url.'" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children currentactive"><a id="myid" class="'.$class.'" href="'.$item->url.'">'.$item->title.'</a>';
      $sub_menu_items = [];
      foreach ( $menu_items as $sub_item ) {
        if ( $sub_item->menu_item_parent == $item->ID )
          $sub_menu_items[] = $sub_item;
      }
      if ( $sub_menu_items ) {
        echo '<span class="arrow_box1"></span><ul class="sub-menu arrow_box1">';
         $sub_class = ( $sub_item->object_id == $post->ID ) ? "childli active" : "";
          echo '<li id="menu-item-1353" class="menu-item menu-item-type-post_type menu-item-object-page parentli">';
          if($item->description){
           echo '<a class="'.$sub_class.'" href="'.$item->url.'">'.$item->title.'</a><p>'.$item->description.'</p> <p class="readMore"><a class="'.$sub_class.'" href="'.$item->url.'"><!--&gt;&gt;-->'.custom_translate('Read More','اقرأ المزيد'). '</a></p>';
          }
          echo '</li>';
          echo '<li id="menu-item-132" class="menu-item menu-item-type-post_type menu-item-object-page parentli">';
          echo '<ul class="sub-menu1">';
        foreach ( $sub_menu_items as $sub_item ) {
          $sub1_class = ( $sub_item->object_id == $post->ID ) ? "childli active" : "";
          
          echo '<li id="menu-item-1353" class="menu-item menu-item-type-post_type menu-item-object-page parentli"><a id="myid2" class="'.$sub1_class.'" href="'.$sub_item->url.'">'.$sub_item->title.'</a>';
          $sub_sub_menu_items = [];
          foreach ( $menu_items as $sub_sub_item ) {
          if ( $sub_sub_item->menu_item_parent == $sub_item->ID )
            $sub_sub_menu_items[] = $sub_sub_item;
          }
         
          if ( $sub_sub_menu_items ) {
            
            echo '<ul class="sub-menu2">';
            foreach ( $sub_sub_menu_items as $sub_sub_item ) {
              $sub_sub_class = ( $sub_sub_item->object_id == $post->ID ) ? "childli active" : "";
               echo '<li id="menu-item-132" class="menu-item menu-item-type-post_type menu-item-object-page parentli"><a id="myid3" class="'.$sub_sub_class.'" href="'.$sub_sub_item->url.'">'.$sub_sub_item->title.'</a>';
               $sub_sub_sub_menu_items = [];
                foreach ( $menu_items as $sub_item ) {
                  if ( $sub_item->menu_item_parent == $sub_sub_item->ID )
                    $sub_sub_sub_menu_items[] = $sub_item;
                }
                if ( $sub_sub_sub_menu_items ) {
                  echo '<ul class="sub-menu2">';
                  foreach ( $sub_sub_sub_menu_items as $sub_sub_sub_item ) {
                    $sub_sub_sub_class = ( $sub_sub_sub_item->object_id == $post->ID ) ? "childli active" : "";
                    echo '<li id="menu-item-132" class="menu-item menu-item-type-post_type menu-item-object-page parentli"><a id="myid4" class="'.$sub_sub_sub_class.'" href="'.$sub_sub_sub_item->url.'">'.$sub_sub_sub_item->title.'</a>';
                    echo "</li>";  
                  }
                 echo "</ul>"; 
                }
              echo "</li>";
            }
            echo "</ul>";
          }
          echo "</li>";
        }
        echo "</ul></li></ul>";
      }
      echo "</li>";
    }
    
  }
  
  echo "</ul></div></ul></div>";
}  
  
?>


