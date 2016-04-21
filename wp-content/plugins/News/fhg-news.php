<?php
/*
  Plugin Name: News
  Plugin URI: http://www.annet.com
  Description: Creates a custom post type for News with associated metaboxes.
  Version: 0.1
  Author: Annet
  Author URI: http://www.annet.com
  License: GPLv2 or later
 */

add_action('admin_init', 'tf_functions_css');

function tf_functions_css() {
  wp_enqueue_style('tf-functions-css', get_bloginfo('template_directory') . '/css/tf-functions.css');
}

// 1. Custom Post Type Registration (Events)

add_action('init', 'create_event_postype');

function create_event_postype() {

  $labels = array(
      'name' => _x('News', 'post type general name'),
      'singular_name' => _x('News', 'post type singular name'),
      'add_new' => _x('Add New', 'news'),
      'add_new_item' => __('Add New News'),
      'edit_item' => __('Edit News'),
      'new_item' => __('New News'),
      'view_item' => __('View News'),
      'search_items' => __('Search News'),
      'not_found' => __('No News found'),
      'not_found_in_trash' => __('No News found in Trash'),
      'parent_item_colon' => '',
  );

  $args = array(
      'label' => __('News'),
      'labels' => $labels,
      'public' => true,
      'can_export' => true,
      'show_ui' => true,
      '_builtin' => false,
      '_edit_link' => 'post.php?post=%d', // ?
      'capability_type' => 'post',
      'menu_icon' => 'dashicons-calendar',
      'hierarchical' => false,
      'rewrite' => array("slug" => "News"),
      'supports' => array('title', 'thumbnail', 'excerpt', 'editor'),
      'show_in_nav_menus' => true,
      'menu_position' => 11,
      'taxonomies' => array('tf_eventcategory', 'post_tag')
          //'show_in_menu' => 'annet-fhg-capm-all/index.php'
  );

  register_post_type('fhg_news', $args);
}

// 2. Custom Taxonomy Registration (Event Types)

function create_eventcategory_taxonomy() {

  $labels = array(
      'name' => _x('Categories', 'taxonomy general name'),
      'singular_name' => _x('Category', 'taxonomy singular name'),
      'search_items' => __('Search Categories'),
      'popular_items' => __('Popular Categories'),
      'all_items' => __('All Categories'),
      'parent_item' => null,
      'parent_item_colon' => null,
      'edit_item' => __('Edit Category'),
      'update_item' => __('Update Category'),
      'add_new_item' => __('Add New Category'),
      'new_item_name' => __('New Category Name'),
      'separate_items_with_commas' => __('Separate categories with commas'),
      'add_or_remove_items' => __('Add or remove categories'),
      'choose_from_most_used' => __('Choose from the most used categories'),
  );

  register_taxonomy('tf_eventcategory', 'fhg_news', array(
      'label' => __('Event Category'),
      'labels' => $labels,
      'hierarchical' => true,
      'show_ui' => true,
      'query_var' => true,
      'rewrite' => array('slug' => 'event-category'),
  ));
}

add_action('init', 'create_eventcategory_taxonomy', 0);


// 4. Show Meta-Box

add_action('admin_init', 'fhg_news_create');

function fhg_news_create() {
  add_meta_box('fhg_news_meta', 'News', 'fhg_news_meta', 'fhg_news');
}

function fhg_news_meta() {

  // - grab data -

  global $post;
  $custom = get_post_custom($post->ID);
  $meta_sd = $custom["fhg_news_startdate"][0];

  $meta_st = $meta_sd;


  // - grab wp time format -

  $date_format = get_option('date_format'); // Not required in my code
  $time_format = get_option('time_format');

  // - populate today if empty, 00:00 for time -

  if ($meta_sd == null) {
    $meta_sd = time();
    $meta_ed = $meta_sd;
    $meta_st = 0;
    $meta_et = 0;
  }

  // - convert to pretty formats -

  $clean_sd = date("D, M d, Y", $meta_sd);
  $clean_st = date($time_format, $meta_st);


  // - security -

  echo '<input type="hidden" name="tf-events-nonce" id="tf-events-nonce" value="' .
  wp_create_nonce('tf-events-nonce') . '" />';

  // - output -
  ?>
  <div class="tf-meta">
    <ul>
      <li><label>News Date</label><input name="fhg_news_startdate" class="tfdate" value="<?php echo $clean_sd; ?>" /></li>

    </ul>
  </div>
  <?php
}

// 5. Save Data

add_action('save_post', 'save_fhg_news');

function save_fhg_news() {

  global $post;

  // - still require nonce

  if (!wp_verify_nonce($_POST['tf-events-nonce'], 'tf-events-nonce')) {
    return $post->ID;
  }

  if (!current_user_can('edit_post', $post->ID))
    return $post->ID;

  // - convert back to unix & update post

  if (!isset($_POST["fhg_news_startdate"])):
    return $post;
  endif;
  $updatestartd = strtotime($_POST["fhg_news_startdate"] . $_POST["fhg_news_starttime"]);
  update_post_meta($post->ID, "fhg_news_startdate", $updatestartd);
}

// 6. Customize Update Messages

add_filter('post_updated_messages', 'events_updated_messages');

function events_updated_messages($messages) {

  global $post, $post_ID;

  $messages['fhg_news'] = array(
      0 => '', // Unused. Messages start at index 1.
      1 => sprintf(__('Event updated. <a href="%s">View item</a>'), esc_url(get_permalink($post_ID))),
      2 => __('Custom field updated.'),
      3 => __('Custom field deleted.'),
      4 => __('Event updated.'),
      /* translators: %s: date and time of the revision */
      5 => isset($_GET['revision']) ? sprintf(__('Event restored to revision from %s'), wp_post_revision_title((int) $_GET['revision'], false)) : false,
      6 => sprintf(__('Event published. <a href="%s">View event</a>'), esc_url(get_permalink($post_ID))),
      7 => __('Event saved.'),
      8 => sprintf(__('Event submitted. <a target="_blank" href="%s">Preview event</a>'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
      9 => sprintf(__('Event scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview event</a>'),
              // translators: Publish box date format, see http://php.net/date
              date_i18n(__('M j, Y @ G:i'), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
      10 => sprintf(__('Event draft updated. <a target="_blank" href="%s">Preview event</a>'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
  );

  return $messages;
}

// 7. JS Datepicker UI

function events_styles() {
  global $post_type;
  if ('fhg_news' != $post_type)
    return;
  wp_enqueue_style('ui-datepicker', get_bloginfo('template_url') . '/css/jquery-ui-1.8.9.custom.css');
}

function events_scripts() {
  global $post_type;
  if ('fhg_news' != $post_type)
    return;
  wp_enqueue_script('jquery-ui', get_bloginfo('template_url') . '/js/jquery-ui.min.js', array('jquery'));
  wp_enqueue_script('ui-datepicker', get_bloginfo('template_url') . '/js/jquery.ui.datepicker.min.js');
  wp_enqueue_script('custom_script', get_bloginfo('template_url') . '/js/pubforce-admin.js', array('jquery'));
}

add_action('admin_print_styles-post.php', 'events_styles', 1000);
add_action('admin_print_styles-post-new.php', 'events_styles', 1000);

add_action('admin_print_scripts-post.php', 'events_scripts', 1000);
add_action('admin_print_scripts-post-new.php', 'events_scripts', 1000);

/**
 * Coded By Prabhakar Mudliyar(1846) 
 * Meta Box for assigning the featured tag to the selected posts.
 */
function events_featured_meta() {
  add_meta_box('prfx_meta', __('Featured Posts', 'prfx-textdomain'), 'prfx_meta_callback', 'fhg_news', 'normal', 'high');
}

add_action('add_meta_boxes', 'events_featured_meta');

/**
 * Outputs the content of the meta box
 */
function prfx_meta_callback($post) {
  wp_nonce_field(basename(__FILE__), 'prfx_nonce');
  $prfx_stored_meta = get_post_meta($post->ID);
  ?>
  <p>
    <span class="prfx-row-title"><?php _e('Check if this is a featured news: ', 'prfx-textdomain') ?></span>
  <div class="prfx-row-content">
    <label for="featured-checkbox">
      <input type="checkbox" name="featured-checkbox" id="featured-checkbox" value="yes" <?php if (isset($prfx_stored_meta['featured-checkbox'])) checked($prfx_stored_meta['featured-checkbox'][0], 'yes'); ?> />
      <?php _e('Featured News', 'prfx-textdomain') ?>
    </label>

  </div>
  </p>   
  <?php
}

/**
 * Saves the custom meta input
 */
function prfx_meta_save($post_id) {

  // Checks save status - overcome autosave, etc.
  $is_autosave = wp_is_post_autosave($post_id);
  $is_revision = wp_is_post_revision($post_id);
  $is_valid_nonce = ( isset($_POST['prfx_nonce']) && wp_verify_nonce($_POST['prfx_nonce'], basename(__FILE__)) ) ? 'true' : 'false';

  // Exits script depending on save status
  if ($is_autosave || $is_revision || !$is_valid_nonce) {
    return;
  }

// Checks for input and saves - save checked as yes and unchecked at no
  if (isset($_POST['featured-checkbox'])) {
    update_post_meta($post_id, 'featured-checkbox', 'yes');
  } else {
    update_post_meta($post_id, 'featured-checkbox', 'no');
  }
}

add_action('save_post', 'prfx_meta_save');
/**
 *  Meta Box Module end
 */
/**
 * Meta Box For Adding Title for the specific news in arabic and english ..(1846)
 */
add_action('add_meta_boxes', 'cd_meta_box_news_title_ar');

function cd_meta_box_news_title_ar() {
  add_meta_box('title-box', 'Add News Title', 'news_title_cb', 'fhg_news', 'normal', 'high');
}

function news_title_cb() {
  // $post is already set, and contains an object: the WordPress post
  global $post;
  $values = get_post_custom($post->ID);


  $newsenglish = isset($values['news_title_text']) ? $values['news_title_text'] : '';
  $newsarabic = isset($values['news_title_text_ar']) ? $values['news_title_text_ar'] : '';



  // We'll use this nonce field later on when saving.
  wp_nonce_field('my_meta_box_nonce', 'meta_box_nonce');
  ?>
  <p>
    <label for="news_title_text">English</label>
    <input type="text" name="news_title_text" id="news_title_text" value="<?php echo $newsenglish[0]; ?>" />
  </p>
  <p>
    <label for="news_title_text_ar">Arabic</label>
    <input type="text" name="news_title_text_ar" id="news_title_text_ar" value="<?php echo $newsarabic[0]; ?>" />
  </p>
  <?php
}

add_action('save_post', 'news_title_save');

function news_title_save($post_id) {
  // Bail if we're doing an auto save
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
    return;

  // if our nonce isn't there, or we can't verify it, bail
  if (!isset($_POST['meta_box_nonce']) || !wp_verify_nonce($_POST['meta_box_nonce'], 'my_meta_box_nonce'))
    return;

  // if our current user can't edit this post, bail
  if (!current_user_can('edit_post'))
    return;

  // now we can actually save the data
  $allowed = array(
      'a' => array(// on allow a tags
          'href' => array() // and those anchors can only have href attribute
      )
  );

  // Make sure your data is set before trying to save it
  if (isset($_POST['news_title_text']))
    update_post_meta($post_id, 'news_title_text', wp_kses($_POST['news_title_text'], $allowed));

  if (isset($_POST['news_title_text_ar']))
    update_post_meta($post_id, 'news_title_text_ar', wp_kses($_POST['news_title_text_ar'], $allowed));
}
?>
<?php

/**
 * This function includes query to get all the posts related to news.
 */
function getAllNews($no) {
  global $wpdb;

  $args_post = array(
      'numberposts' => $no,
      'child_of' => 0,
      'orderby' => 'meta_value',
      'meta_key' => 'fhg_news_startdate',
      'order' => 'DESC',
      'post_type' => 'fhg_news',
      'post_status' => 'publish',
      'posts_per_page' => 10,
      'paged' => get_query_var('paged') ? get_query_var('paged') : 1
  );
  $arg_post_data = get_posts($args_post);

  return $arg_post_data;
}

function displayNews() {


  $args_post = array(
      'numberposts' => 4,
      'child_of' => 0,
      'orderby' => 'meta_value',
      'meta_key' => 'fhg_news_startdate',
      'order' => 'DESC',
      'post_type' => 'fhg_news',
      'post_status' => 'publish',
  );
  $arg_post_data = get_posts($args_post);

  if ($arg_post_data) {
    foreach ($arg_post_data as $post_data) {
      setup_postdata($post_data);
      $each_faq = (array) $post_data;
      $postvalues = get_values_from_array($each_faq,50,50,6,'fhg_news_startdate');
      //print_r($postvalues);
      ?>
      <!-- NEW -->
      <div class="item">
            <div class="row">
              <div class="col-md-4 leftNewsBox"><a href="<?php echo $postvalues['customurl']; ?>"><?php echo $postvalues['feat_image_url']; ?></a>
                <div class="dateBox"><?php echo $postvalues['day']; ?><br>
                  <span><?php echo $postvalues['month']; ?></span></div>
              </div>
              <div class="col-md-8 rightNewsBox">
                <h2><a href="<?php echo $postvalues['customurl']; ?>"><?php echo $postvalues['title']; ?></a></h2>
                <p><?php echo $postvalues['content']; ?></p>
                <span><?php echo $postvalues['read']; ?></span> </div>
            </div>
          </div>
      <?php
    }
  } else {
    echo "No data";
  }
}

add_shortcode('latest-news', 'displayNews');

function displayFeaturedNews($atts) {

  extract( shortcode_atts( array(
      'newstemplate' => 'news'

  ), $atts ) );
  $args_post = array(
      'numberposts' => -1,
      'child_of' => 0,
      'orderby' => 'meta_value',
      'meta_key' => 'fhg_news_startdate',
      'order' => 'DESC',
      'post_type' => 'fhg_news',
      'post_status' => 'publish',
  );
  $arg_post_data = get_posts($args_post);
  $featuredcount = count($arg_post_data);

  if ($arg_post_data) {
    $counter = 0;
    foreach ($arg_post_data as $post_data) {
      $each_faq = (array) $post_data;
      $id = $each_faq['ID'];
      $custom = get_post_custom($id);
      $featured = $custom['featured-checkbox'][0];

      if ($featured == 'yes') {
        $postvalues = get_values_from_array($each_faq,50,50,7,'fhg_news_startdate');
        if ($counter == 0) {
          $details .= '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 newspageContent">';
          $details .= '<a href="' . $postvalues['customurl'] . '"><div class="pressreleaseLeftcon">';
          $details .= '<div class="pad_div">';
          $details .= '<div class="hed">' . $postvalues['title'] . '</div>';
          $details .= '<div class="topborder">&nbsp;</div>';
          $details .= '<div class="date"><span>' . custom_translate($postvalues['date'], $postvalues['date_ar']) . '</span></div>';
          $details .= '<p>' . $postvalues['content'] . '</p></div></div><img src=' . $postvalues['feat_image'] . ' alt="featured_news_img"></a></div>';
          $counter = 1;
        } else if ($counter == 1) {
          $details .= '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 newspageContent newscontenttop">';
          $details .= '<a href="' . $postvalues['customurl'] . '"><div class="pressreleaseRightconTop">';
          $details .= '<div class="boxLeft"><div class="topborder">&nbsp;</div>';
          $details .= '<div class="date1">' . custom_translate($postvalues['date'], $postvalues['date_ar']) . '</div>';
          $details .= '<p>' . $postvalues['title'] . '</p></div>';
          $details .= '<div class="boxRight"><img src=' . $postvalues['feat_image'] . ' alt="featured_news_img"><img class="newstransparent" src="' . INC_URL_IMG .DS.'blue_transparent.png" alt="featured_news_img1"></div>';
          $details .= '</div></a></div>';
          $counter = 2;
        } else if ($counter == 2) {
          $details .= '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 newspageContent newscontentbottom"><div class="pressreleaseRightconBottom">';
          $details .= '<a href="' . $postvalues['customurl'] . '"><div class="boxRight"><img src="' . $postvalues['feat_image'] . '" alt="featured_news_img"><img class="newstransparent" src="' . INC_URL_IMG .DS.'blue_transparent.png" alt="featured_news_img1"></div>';
          $details .= '<div class="boxLeft">';
          $details .= '<div class="topborder">&nbsp;</div>';
          $details .= '<div class="date">' . custom_translate($postvalues['date'], $postvalues['date_ar']) . '</div>';
          $details .= '<p>' . $postvalues['title'] . '</p></div></a></div></div>';
          $counter = 3;
        }
      }
    }
      if($newstemplate == 'media'){
        $details .= '<div class="loadmore">
                  <a href="'.SITE_URL . '/' . custom_translate('en/section/news-50/pressreleases', 'ar/section/news-50/pressreleases-1').'">'.custom_translate('View all Press Releases', 'عرض جميع البيانات الصحفية').'</a>
                </div>';
      }
    echo $str .= $details;
  } else {
    
  }
}

add_shortcode('featured-news', 'displayFeaturedNews');

// 1742 

function displayNewss() {

  if (isset($_GET['month']) || isset($_GET['yr'])) {
    global $wpdb;
    $db = $wpdb->prefix . 'postmeta';
    if (isset($_GET['month']) && !empty($_GET['month'])) {
      $monthval = $_GET['month'];

      $sq = "SELECT * FROM $db WHERE DATE_FORMAT( FROM_UNIXTIME(  `meta_value` ) ,  '%b' ) =  '$monthval' AND meta_key =  'fhg_news_startdate'";
      $months1 = $wpdb->get_results($sq);
      foreach ($months1 as $month) {
        $monthval1 = $month->post_id;
        $postidarr[] = $month->post_id;
      }
      $args = array(
          'numberposts' => -1,
          'orderby' => 'meta_value',
          'meta_key' => 'fhg_news_startdate',
          'order' => 'DESC',
          'post_type' => 'fhg_news',
          'post__in' => $postidarr,
          'post_status' => 'publish',
          'posts_per_page' => 10,
          'paged' => get_query_var('paged') ? get_query_var('paged') : 1
      );
      $arg_post_data = get_posts($args);
      $totalposts = totalPosts_mon_yrs($postidarr);
    }

    if (isset($_GET['yr']) && !empty($_GET['yr'])) {

      $yearval = $_GET['yr'];


      //$sq = "SELECT * FROM `wp_postmeta` WHERE DATE_FORMAT( FROM_UNIXTIME(  `meta_value` ) ,  '%Y' ) =  '$yearval' AND meta_key =  'fhg_news_startdate'";
      $sq = "SELECT * FROM $db WHERE DATE_FORMAT( FROM_UNIXTIME(  `meta_value` ) ,  '%Y' ) =  '$yearval' AND meta_key =  'fhg_news_startdate'";
      $years1 = $wpdb->get_results($sq);
      foreach ($years1 as $year) {
        $yearval1 = $year->post_id;
        $postidarr[] = $year->post_id;
      }
      $args = array(
          'numberposts' => -1,
          'orderby' => 'meta_value',
          'meta_key' => 'fhg_news_startdate',
          'order' => 'DESC',
          'post_type' => 'fhg_news',
          'post__in' => $postidarr,
          'post_status' => 'publish',
          'posts_per_page' => 10,
          'paged' => get_query_var('paged') ? get_query_var('paged') : 1
      );
      $arg_post_data = get_posts($args);
      $totalposts = totalPosts_mon_yrs($postidarr);
    }
  } else {
    $arg_post_data = getAllNews(-1);
    $totalposts = totalPostsNews();
  }

  if ($arg_post_data) {
    $details .= '<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"></div>';
    $details .= '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 newslistingcontainer">';
    $details .= '<div class="pastEvtContainer"><ul>';

    $counter = 0;
    foreach ($arg_post_data as $post_data) {
      $each_faq = (array) $post_data;
      $postvalues = get_values_from_array($each_faq,10,10,30,'fhg_news_startdate');
      $postvalues_title = $postvalues['title'];
      $postvalues['content'] .= '...</p><a class="newslistinglink" href="' . $postvalues['customurl'] . '">' . custom_translate('Read More', 'اقرأ المزيد') . '</a>';

        $details .= '<li><div class="detailpast"><div class="left">';
        $details .= '<img src=' . $postvalues['feat_image'] . ' alt="'.$postvalues_title.'"></div>';
        $details .= '<div class="right"><div class="topborder">&nbsp;</div>';
        $details .= '<div class="venueDate"><span>' . custom_translate('Date', 'تاريخ') . ':</span> <span>' . custom_translate($postvalues['date'], $postvalues['date_ar']) . '</span></div>';
        $details .= '<div class="pastEvtxt"><a href="' . $postvalues['customurl'] . '">' . $postvalues['title1'] . '</a>';
        $details .= '<p>' . $postvalues['content'] . '</div></div></div></li>';

    }
    $details .= '</ul>';

    $details .= '</div></div><div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"></div></div>';

    $details .= newspagination(totalPostsNews());
    echo $str .= $details;
    //echo $str = $cat_name;
  } else {
    $coming = custom_translate('Coming Soon', 'قريبا');
    $details = '<div class="pastEvtContainer coming">' . $coming . '</div>';
    echo $details;
  }
}

add_shortcode('latest-newss', 'displayNewss');

function totalPostsNews() {

  global $wpdb;

  $args_post1 = array(
      'numberposts' => -1,
      'post_type' => 'fhg_news',
      'post_status' => 'publish'
  );
  $arg_post_data1 = get_posts($args_post1);

  return count($arg_post_data1);
}

function totalPosts_mon_yrs($postidarr) {

  global $wpdb;
  $args = array(
      'numberposts' => -1,
      'post_type' => 'fhg_news',
      'post__in' => $postidarr
  );
  $arg_post_data_mon_yr = get_posts($args);

  return count($arg_post_data_mon_yr);
}


function newspagination($totalposts, $arabicpageurl) {

  $big = 999999999; // need an unlikely integer
  
  $totalcount = $totalposts / 10;
  $pages = paginate_links(array(
      'base' => custom_translate(str_replace($big, '%#%', esc_url(get_pagenum_link($big))), SITE_URL . '/ar/البيانات-الصحفية%_%'),
      'format' => '?page=%#%',
      'current' => max(1, get_query_var('paged')),
      'total' => $totalcount,
      'prev_next' => false,
      'type' => 'array',
      'prev_next' => TRUE,
      'prev_text' => __(custom_translate('', '')),
      'next_text' => __(custom_translate('', '')),
          ));

  if (is_array($pages)) {
    //   $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
    $details1 .= '<div class="container"><div class="col-lg-2 col-md-2 col-sm-2 col-xs-16"></div><div class="col-lg-12 col-md-12 col-sm-12 col-xs-16 divpagination">';
    $details1.= '<ul class="pagination text-center">';
    foreach ($pages as $page) {
      $details1 .= "<li>$page</li>";
    }
    $details1 .= '</ul></div><div class="col-lg-2 col-md-2 col-sm-2 col-xs-16"></div></div>';
  }

 
  return $details1;
}
?>
