<?php
/*
  Plugin Name: Events
  Plugin URI: http://www.annet.com
  Description: Creates a custom post type for News with associated metaboxes.
  Version: 0.1
  Author: Annet - 1623
  Author URI: http://www.annet.com
  License: GPLv2 or later
 */

/* ------------------- THEME FORCE ---------------------- */

/*
 * EVENTS FUNCTION (CUSTOM POST TYPE) - GPL & all that good stuff obviously...
 *
 * If you intend to use this, please:
 * -- Amend your paths (CSS, JS, Images, etc.)
 * -- Rename functions, unless you're down with the force ;)
 *
 * This is not a plug-in on purpose, it's meant to be it's on file within your theme.
 * http://www.noeltock.com/web-design/wordpress/custom-post-types-events-pt1/
 */


// 0. Base

add_action('admin_init', 'capm_functions_css');

function capm_functions_css() {
  wp_enqueue_style('capm_functions_css', get_bloginfo('template_directory') . '/css/tf-functions.css');
}

// 1. Custom Post Type Registration (Events)

add_action('init', 'capm_create_event_postype');

function capm_create_event_postype() {

  $labels = array(
      'name' => _x('Events', 'post type general name'),
      'singular_name' => _x('Event', 'post type singular name'),
      'add_new' => _x('Add New', 'events'),
      'add_new_item' => __('Add New Event'),
      'edit_item' => __('Edit Event'),
      'new_item' => __('New Event'),
      'view_item' => __('View Event'),
      'search_items' => __('Search Events'),
      'not_found' => __('No events found'),
      'not_found_in_trash' => __('No events found in Trash'),
      'parent_item_colon' => '',
  );

  $args = array(
      'label' => __('Events'),
      'labels' => $labels,
      'public' => true,
      'can_export' => true,
      'show_ui' => true,
      '_builtin' => false,
      '_edit_link' => 'post.php?post=%d', // ?
      'capability_type' => 'post',
      'menu_icon' => 'dashicons-calendar',
      'hierarchical' => false,
      'rewrite' => array("slug" => "events"),
      'supports' => array('title', 'thumbnail', 'excerpt', 'editor'),
      'show_in_nav_menus' => true,
      'menu_position' => 12,
      'taxonomies' => array('capm_eventcategory', 'post_tag')
          //'show_in_menu' => 'annet-fhg-capm-all/index.php'
  );

  register_post_type('fhg_events', $args);
}

// 2. Custom Taxonomy Registration (Event Types)

function capm_create_eventcategory_taxonomy() {

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

  register_taxonomy('capm_eventcategory', 'fhg_events', array(
      'label' => __('Event Category'),
      'labels' => $labels,
      'hierarchical' => true,
      'show_ui' => true,
      'query_var' => true,
      'rewrite' => array('slug' => 'event-category'),
  ));
}

add_action('init', 'capm_create_eventcategory_taxonomy', 0);



// 4. Show Meta-Box

add_action('admin_init', 'fhg_events_create');

function fhg_events_create() {
  add_meta_box('fhg_events_meta', 'Events', 'fhg_events_meta', 'fhg_events');
}

function fhg_events_meta() {

  // - grab data -

  global $post;
  $custom = get_post_custom($post->ID);
  $meta_sd = $custom["fhg_events_startdate"][0];
  $meta_st = $meta_sd;

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
      <li><label>Events Date</label><input name="fhg_events_startdate" class="tfdate" value="<?php echo $clean_sd; ?>" /></li>

    </ul>
  </div>
  <?php
}

// 5. Save Data

add_action('save_post', 'save_fhg_events');

function save_fhg_events() {

  global $post;

  // - still require nonce

  if (!wp_verify_nonce($_POST['tf-events-nonce'], 'tf-events-nonce')) {
    return $post->ID;
  }

  if (!current_user_can('edit_post', $post->ID))
    return $post->ID;

  // - convert back to unix & update post

  if (!isset($_POST["fhg_events_startdate"])):
    return $post;
  endif;
  $updatestartd = strtotime($_POST["fhg_events_startdate"] . $_POST["fhg_events_starttime"]);
  update_post_meta($post->ID, "fhg_events_startdate", $updatestartd);
}

// 6. Customize Update Messages

add_filter('post_updated_messages', 'fhg_events_updated_messages');

function fhg_events_updated_messages($messages) {

  global $post, $post_ID;

  $messages['fhg_events'] = array(
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

function fhg_events_styles() {
  global $post_type;
  if ('fhg_events' != $post_type)
    return;
  wp_enqueue_style('ui-datepicker', get_bloginfo('template_url') . '/css/jquery-ui-1.8.9.custom.css');
}

function fhg_events_scripts() {
  global $post_type;
  if ('fhg_events' != $post_type)
    return;
  wp_enqueue_script('jquery-ui-events', get_bloginfo('template_url') . '/js/jquery-ui.min.js', array('jquery'));
  wp_enqueue_script('ui-datepicker', get_bloginfo('template_url') . '/js/jquery.ui.datepicker.min.js');
  wp_enqueue_script('custom_script', get_bloginfo('template_url') . '/js/pubforce-admin.js', array('jquery'));
}

add_action('admin_print_styles-post.php', 'fhg_events_styles', 1000);
add_action('admin_print_styles-post-new.php', 'fhg_events_styles', 1000);

add_action('admin_print_scripts-post.php', 'fhg_events_scripts', 1000);
add_action('admin_print_scripts-post-new.php', 'fhg_events_scripts', 1000);

add_action('add_meta_boxes', 'cd_meta_box_add');

function cd_meta_box_add() {
  add_meta_box('location-box', 'Add Event Location', 'location_box_cb', 'fhg_events', 'normal', 'high');
}

function location_box_cb() {
  // $post is already set, and contains an object: the WordPress post
  global $post;
  $values = get_post_custom($post->ID);

  $text = isset($values['my_meta_box_text']) ? $values['my_meta_box_text'] : '';
  $text_ar = isset($values['my_meta_box_text_ar']) ? $values['my_meta_box_text_ar'] : '';


  // We'll use this nonce field later on when saving.
  wp_nonce_field('my_meta_box_nonce', 'meta_box_nonce');
  ?>
  <p>
    <label for="my_meta_box_text">English</label>
    <input type="text" name="my_meta_box_text" id="my_meta_box_text" value="<?php echo $text[0]; ?>" />
  </p>
  <p>
    <label for="my_meta_box_text_ar">Arabic</label>
    <input type="text" name="my_meta_box_text_ar" id="my_meta_box_text_ar" value="<?php echo $text_ar[0]; ?>" />
  </p>


  <?php
}

add_action('save_post', 'cd_meta_box_save');

function cd_meta_box_save($post_id) {
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
  if (isset($_POST['my_meta_box_text']))
    update_post_meta($post_id, 'my_meta_box_text', wp_kses($_POST['my_meta_box_text'], $allowed));
  if (isset($_POST['my_meta_box_text_ar']))
    update_post_meta($post_id, 'my_meta_box_text_ar', wp_kses($_POST['my_meta_box_text_ar'], $allowed));
}
?>
<?php
/**
 * Meta Box For Adding Location for the news in arabic ..(1846)
 */
add_action('add_meta_boxes', 'cd_meta_box_events_title_ar');

function cd_meta_box_events_title_ar() {
  add_meta_box('title-box', 'Add Events Title', 'events_title_cb', 'fhg_events', 'normal', 'high');
}

function events_title_cb() {
  // $post is already set, and contains an object: the WordPress post
  global $post;
  $values = get_post_custom($post->ID);


  $newsenglish = isset($values['events_title_text']) ? $values['events_title_text'] : '';
  $newsarabic = isset($values['events_title_text_ar']) ? $values['events_title_text_ar'] : '';



  // We'll use this nonce field later on when saving.
  wp_nonce_field('my_meta_box_nonce', 'meta_box_nonce');
  ?>
  <p>
    <label for="events_title_text">English</label>
    <input type="text" name="events_title_text" id="events_title_text" value="<?php echo $newsenglish[0]; ?>" />
  </p>
  <p>
    <label for="events_title_text_ar">Arabic</label>
    <input type="text" name="events_title_text_ar" id="events_title_text_ar" value="<?php echo $newsarabic[0]; ?>" />
  </p>


  <?php
}

add_action('save_post', 'events_title_save');

function events_title_save($post_id) {
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
  if (isset($_POST['events_title_text']))
    update_post_meta($post_id, 'events_title_text', wp_kses($_POST['events_title_text'], $allowed));

  if (isset($_POST['events_title_text_ar']))
    update_post_meta($post_id, 'events_title_text_ar', wp_kses($_POST['events_title_text_ar'], $allowed));
}
?>
<?php

function getAllEvents($no) {
  global $wpdb;

  $args_post = array(
    'numberposts' => -1,
    'orderby'   => 'meta_value',
    'meta_key'  => 'fhg_events_startdate',
    'order'     => 'DESC',
    'post_type' => 'fhg_events',
    'post__in' => $postidarr,
    'post_status' => 'publish',
    'posts_per_page' => 10,
    'paged' => get_query_var('paged') ? get_query_var('paged') : 1
  );
  $arg_post_data = get_posts($args_post);

  return $arg_post_data;
}

/**
 * Code to display all events based on the category(year) ..
 * Done by (1846)
 */
function displayEventsAll($atts) {
  extract( shortcode_atts( array(
      'eventscount' => -1

  ), $atts ) );

  if (isset($_GET['month']) || isset($_GET['yr'])) {
    global $wpdb;
    $db = $wpdb->prefix . 'postmeta';
    if (isset($_GET['month']) && !empty($_GET['month'])) {
      $monthval = $_GET['month'];


      $sq = "SELECT * FROM $db WHERE DATE_FORMAT( FROM_UNIXTIME(  `meta_value` ) ,  '%b' ) =  '$monthval' AND meta_key =  'fhg_events_startdate'";
      $months1 = $wpdb->get_results($sq);


      foreach ($months1 as $month) {
        $monthval1 = $month->post_id;
        $postidarr[] = $month->post_id;
      }




      $args = array(
          'numberposts' => -1,
          'orderby'   => 'meta_value',
          'meta_key'  => 'fhg_events_startdate',
          'order'     => 'DESC',
          'post_type' => 'fhg_events',
          'post__in' => $postidarr,
          'post_status' => 'publish',
          'posts_per_page' => 10,
          'paged' => get_query_var('paged') ? get_query_var('paged') : 1
      );
      $arg_post_data = get_posts($args);
      $totalposts = totalEPosts_mon_yrs($postidarr);
    }

    if (isset($_GET['yr']) && !empty($_GET['yr'])) {


      $yearval = $_GET['yr'];


      //$sq = "SELECT * FROM `wp_postmeta` WHERE DATE_FORMAT( FROM_UNIXTIME(  `meta_value` ) ,  '%Y' ) =  '$yearval' AND meta_key =  'fhg_publications_startdate'";
      $sq = "SELECT * FROM $db WHERE DATE_FORMAT( FROM_UNIXTIME(  `meta_value` ) ,  '%Y' ) =  '$yearval' AND meta_key =  'fhg_events_startdate'";


      $years1 = $wpdb->get_results($sq);

      foreach ($years1 as $year) {
        $yearval1 = $year->post_id;
        $postidarr[] = $year->post_id;
      }


      $args = array(
          'numberposts' => -1,
          'orderby'   => 'meta_value',
          'meta_key'  => 'fhg_events_startdate',
          'order'     => 'DESC',
          'post_type' => 'fhg_events',
          'post__in' => $postidarr,
          'post_status' => 'publish',
          'posts_per_page' => 10,
          'paged' => get_query_var('paged') ? get_query_var('paged') : 1
      );
      $arg_post_data = get_posts($args);
      $totalposts = totalEPosts_mon_yrs($postidarr);
    }
  } else {
    $arg_post_data = getAllEvents(-1);
    $totalposts = totalPostsEvents();
  }

if ($arg_post_data) {
    $details .= ' <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"></div>
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 newslistingcontainer">
                    <div class="pastEvtContainer">
                      <ul>';
    $no = 1;
    $counter = 0;
    foreach ($arg_post_data as $post_data) {
      $each_faq = (array) $post_data;
      $postvalues = get_values_from_array($each_faq,10,10,30,'fhg_events_startdate');
      $postvalues_title = $postvalues['title'];
      $readmore_content = '<a class="newslistinglink" href="' . $postvalues['customurl'] . '">' . custom_translate('Read More', 'اقرأ المزيد') . '</a>';

        $details .= '<li>
                      <div class="detailpast">
                        <div class="left">
                          <img src=' . $postvalues['feat_image'] . ' alt="'.$postvalues_title.'" />
                        </div>
                        <div class="right">
                          <div class="topborder">&nbsp;</div>
                          <div class="venueDate">
                            <span>' . custom_translate('Date', 'تاريخ') . ':</span> 
                            <span>' . custom_translate($postvalues['date'], $postvalues['date_ar']) . '</span>
                          </div>
                          <div class="pastEvtxt">
                            <a href="' . $postvalues['customurl'] . '">' . $postvalues['title1'] . '</a>
                            <p>' . $postvalues['content'] . '...</p>'.$readmore_content.'
                          </div>
                        </div>
                      </div>
                    </li>';

        if($no == 6 && ($eventscount != -1)){
          break;
        }

        $no++;
    }
    
    $details .= ' </ul>
                </div>';
    if($eventscount != -1){
      $details .= '<div class="loadmore">
                <a href="'.SITE_URL . '/' . custom_translate('en/section/news-50/eventssponsorships', 'ar/section/news-50/eventssponsorships-1').'">'.custom_translate('View all Events & Sponsorships', 'عرض جميع الأحداث والرعاية').'</a></div>';
    }
    $details.='</div><div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"></div>';

    if($eventscount == -1){

      $details .= eventspagination(totalPostsNews());
    }
    echo $str .= $details;
    //echo $str = $cat_name;
  } else {
    $coming = custom_translate('Coming Soon', 'قريبا');
    $details = '<div class="pastEvtContainer coming">' . $coming . '</div>';
    echo $details;
  }

}

add_shortcode('events', 'displayEventsAll');

function totalPostsEvents() {

  global $wpdb;

  $args_post1 = array(
      'numberposts' => -1,
      'post_type' => 'fhg_events',
      'post_status' => 'publish'
  );
  $arg_post_data1 = get_posts($args_post1);

  return count($arg_post_data1);
}

function totalEPosts_mon_yrs($postidarr) {

  global $wpdb;
  $args = array(
      'numberposts' => -1,
      'post_type' => 'fhg_events',
      'post__in' => $postidarr
  );
  $arg_post_data_mon_yr = get_posts($args);

  return count($arg_post_data_mon_yr);
}

function eventspagination($totalposts) {

  $big = 999999999; // need an unlikely integer
  $details1 .= '<div class="container"><div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"></div><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 divpagination">';
  $totalcount = $totalposts / 10;
  $pages = paginate_links(array(
      'base' => custom_translate(str_replace($big, '%#%', esc_url(get_pagenum_link($big))), SITE_URL . '/ar/البيانات-الصحفية%_%'),
      'format' => '?paged=%#%',
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
    $details1.= '<ul class="pagination text-center">';
    foreach ($pages as $page) {
      $details1 .= "<li>$page</li>";
    }
    $details1 .= '</ul>';
  }
  $details1 .= '</div><div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"></div></div>';

  return $details1;
}

function fhg_events_deactivate() {
  remove_shortcode('events');
}

register_deactivation_hook(__FILE__, 'fhg_events_deactivate');
?>
