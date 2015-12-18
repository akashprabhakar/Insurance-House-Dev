<?php
/*
  Plugin Name: Publications
  Plugin URI: http://www.annet.com
  Description: Creates a custom post type for Publications with associated metaboxes.
  Version: 0.1
  Author: Annet - 1623
  Author URI: http://www.annet.com
  License: GPLv2 or later
 */

// 0. Base


add_action('admin_init', 'publications_css');

function publications_css() {
  wp_enqueue_style('publications-css', get_bloginfo('template_directory') . '/includes/css/tf-functions.css');
}

// 1. Custom Post Type Registration (Events)

add_action('init', 'create_publications_postype');

function create_publications_postype() {

  $labels = array(
      'name' => _x('Publications', 'post type general name'),
      'singular_name' => _x('Publications', 'post type singular name'),
      'add_new' => _x('Add New ', 'publication'),
      'add_new_item' => __('Add New publication'),
      'edit_item' => __('Edit Publication'),
      'new_item' => __('New Publication'),
      'view_item' => __('View Publication'),
      'search_items' => __('Search Publication'),
      'not_found' => __('No Publications found'),
      'not_found_in_trash' => __('No Publications found in Trash'),
      'parent_item_colon' => '',
  );

  $args = array(
      'label' => __('Publications'),
      'labels' => $labels,
      'public' => true,
      'can_export' => true,
      'show_ui' => true,
      '_builtin' => false,
      '_edit_link' => 'post.php?post=%d', // ?
      'capability_type' => 'post',
      'menu_icon' => 'dashicons-calendar',
      'hierarchical' => false,
      'rewrite' => array("slug" => "publications"),
      'supports' => array('title', 'thumbnail', 'excerpt', 'editor'),
      'show_in_nav_menus' => true,
      'taxonomies' => array('publication_category', 'post_tag')
      //'show_in_menu' => 'annet-fhg-capm-all/index.php'
  );

  register_post_type('fhg_publications', $args);
}

// 2. Custom Taxonomy Registration (Publications Types)

function create_publication_category_taxonomy() {

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

  register_taxonomy('publication_category', 'fhg_publications', array(
      'label' => __('Publication Category'),
      'labels' => $labels,
      'hierarchical' => true,
      'show_ui' => true,
      'query_var' => true,
      'rewrite' => array('slug' => 'event-category'),
  ));
}

add_action('init', 'create_publication_category_taxonomy', 0);



// 4. Show Meta-Box

add_action('admin_init', 'fhg_publications_create');

function fhg_publications_create() {
  add_meta_box('fhg_publications_meta', 'Publications', 'fhg_publications_meta', 'fhg_publications');
}

function fhg_publications_meta() {

  // - grab data -

  global $post;
  $custom = get_post_custom($post->ID);
  $meta_sd = $custom["fhg_publications_startdate"][0];
  $meta_st = $meta_sd;
  $date_format = get_option('date_format');
  $time_format = get_option('time_format');
  if ($meta_sd == null) {
    $meta_sd = time();
    $meta_ed = $meta_sd;
    $meta_st = 0;
    $meta_et = 0;
  }

  $clean_sd = date("D, M d, Y", $meta_sd);
  $clean_st = date($time_format, $meta_st);


  // - security -

  echo '<input type="hidden" name="fhg_publications-nonce" id="fhg_publications-nonce" value="' .
  wp_create_nonce('fhg_publications-nonce') . '" />';

  // - output -
  ?>
  <div class="tf-meta">
    <ul>
      <li><label>Publication Date</label><input name="fhg_publications_startdate" class="tfdate" value="<?php echo $clean_sd; ?>" /></li>

    </ul>
  </div>
  <?php
}

// 5. Save Data

add_action('save_post', 'save_fhg_publications');

function save_fhg_publications() {

  global $post;

  // - still require nonce

  if (!wp_verify_nonce($_POST['fhg_publications-nonce'], 'fhg_publications-nonce')) {
    return $post->ID;
  }

  if (!current_user_can('edit_post', $post->ID))
    return $post->ID;

  // - convert back to unix & update post

  if (!isset($_POST["fhg_publications_startdate"])):
    return $post;
  endif;
  $updatestartd = strtotime($_POST["fhg_publications_startdate"] . $_POST["fhg_publications_starttime"]);
  update_post_meta($post->ID, "fhg_publications_startdate", $updatestartd);
}

// 6. Customize Update Messages

add_filter('post_updated_messages', 'publications_updated_messages');

function publications_updated_messages($messages) {

  global $post, $post_ID;

  $messages['fhg_publications'] = array(
      0 => '', // Unused. Messages start at index 1.
      1 => sprintf(__('Publication updated. <a href="%s">View item</a>'), esc_url(get_permalink($post_ID))),
      2 => __('Custom field updated.'),
      3 => __('Custom field deleted.'),
      4 => __('Publication updated.'),
      /* translators: %s: date and time of the revision */
      5 => isset($_GET['revision']) ? sprintf(__('Publication restored to revision from %s'), wp_post_revision_title((int) $_GET['revision'], false)) : false,
      6 => sprintf(__('Publication published. <a href="%s">View Publication</a>'), esc_url(get_permalink($post_ID))),
      7 => __('Publication saved.'),
      8 => sprintf(__('Publication submitted. <a target="_blank" href="%s">Preview Publication</a>'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
      9 => sprintf(__('Publication scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Publication</a>'),
              // translators: Publish box date format, see http://php.net/date
              date_i18n(__('M j, Y @ G:i'), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
      10 => sprintf(__('Publication draft updated. <a target="_blank" href="%s">Preview Publication</a>'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
  );

  return $messages;
}

// 7. JS Datepicker UI

function publications_styles() {
  global $post_type;
  if ('fhg_publications' != $post_type)
    return;
  wp_enqueue_style('ui-datepicker', get_bloginfo('template_url') . '/includes/css/jquery-ui-1.8.9.custom.css');
}

function publications_scripts() {
  global $post_type;
  if ('fhg_publications' != $post_type)
    return;
  wp_enqueue_script('jquery-ui', get_bloginfo('template_url') . '/includes/js/jquery-ui-1.8.9.custom.min.js', array('jquery'));
  wp_enqueue_script('ui-datepicker', get_bloginfo('template_url') . '/includes/js/jquery.ui.datepicker.min.js');
  wp_enqueue_script('custom_script', get_bloginfo('template_url') . '/includes/js/pubforce-admin.js', array('jquery'));
}

add_action('admin_print_styles-post.php', 'publications_styles', 1000);
add_action('admin_print_styles-post-new.php', 'publications_styles', 1000);

add_action('admin_print_scripts-post.php', 'publications_scripts', 1000);
add_action('admin_print_scripts-post-new.php', 'publications_scripts', 1000);

/**
 * Coded By 1846
 * Meta Box for assigning the featured tag to the selected posts.
 */
function publications_featured_meta() {
  add_meta_box('prfx_meta', __('Featured Publications', 'prfx-textdomain'), 'publications_meta_callback', 'fhg_publications', 'normal', 'high');
}

add_action('add_meta_boxes', 'publications_featured_meta');

/**
 * Outputs the content of the meta box
 */
function publications_meta_callback($post) {
  wp_nonce_field(basename(__FILE__), 'prfx_nonce');
  $prfx_stored_meta = get_post_meta($post->ID);
  ?>

  <p>
    <span class="prfx-row-title"><?php _e('Check if this is a featured news: ', 'prfx-textdomain') ?></span>
  <div class="prfx-row-content">
    <label for="featured-checkbox-publication">
      <input type="checkbox" name="featured-checkbox-publication" id="featured-checkbox-publication" value="yes" <?php if (isset($prfx_stored_meta['featured-checkbox-publication'])) checked($prfx_stored_meta['featured-checkbox-publication'][0], 'yes'); ?> />
  <?php _e('Featured Publications', 'prfx-textdomain') ?>
    </label>

  </div>
  </p>   

  <?php
}

/**
 * Saves the custom meta input
 */
function publications_meta_save($post_id) {

  // Checks save status - overcome autosave, etc.
  $is_autosave = wp_is_post_autosave($post_id);
  $is_revision = wp_is_post_revision($post_id);
  $is_valid_nonce = ( isset($_POST['prfx_nonce']) && wp_verify_nonce($_POST['prfx_nonce'], basename(__FILE__)) ) ? 'true' : 'false';

  // Exits script depending on save status
  if ($is_autosave || $is_revision || !$is_valid_nonce) {
    return;
  }

// Checks for input and saves - save checked as yes and unchecked at no
  if (isset($_POST['featured-checkbox-publication'])) {
    update_post_meta($post_id, 'featured-checkbox-publication', 'yes');
  } else {
    update_post_meta($post_id, 'featured-checkbox-publication', 'no');
  }
}

add_action('save_post', 'publications_meta_save');
/**
 *  Meta Box Module end
 */
add_action('add_meta_boxes', 'cd_meta_box_add_publication');

function cd_meta_box_add_publication() {
  add_meta_box('location-box', 'Add Event Location(English)', 'location_box_cb_publications', 'fhg_publications', 'normal', 'high');
}

function location_box_cb_publications() {
  // $post is already set, and contains an object: the WordPress post
  global $post;
  $values = get_post_custom($post->ID);

  //print_r($values);
  $english_location = isset($values['my_meta_box_text_publications']) ? $values['my_meta_box_text_publications'] : '';
  $arabic_location = isset($values['my_meta_box_text_publications']) ? $values['my_meta_box_text_publications'] : '';



  // We'll use this nonce field later on when saving.
  wp_nonce_field('my_meta_box_nonce', 'meta_box_nonce');
  ?>
  <p>
    <label for="my_meta_box_text_publications">English</label>
    <input type="text" name="my_meta_box_text_publications" id="my_meta_box_text_publications" value="<?php echo $english_location[0]; ?>" />
  </p>

  <p>
    <label for="my_meta_box_text_publications_ar">Arabic</label>
    <input type="text" name="my_meta_box_text_publications_ar" id="my_meta_box_text_publications_ar" value="<?php echo $arabic_location[0]; ?>" />
  </p>


  <?php
}

add_action('save_post', 'cd_meta_box_publication_save');

function cd_meta_box_publication_save($post_id) {
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
  if (isset($_POST['my_meta_box_text_publications']))
    update_post_meta($post_id, 'my_meta_box_text_publications', wp_kses($_POST['my_meta_box_text_publications'], $allowed));

  if (isset($_POST['my_meta_box_text_publications_ar']))
    update_post_meta($post_id, 'my_meta_box_text_publications_ar', wp_kses($_POST['my_meta_box_text_publications_ar'], $allowed));
}
?>
<?php
/**
 * Meta Box For Adding Title for the specific news in arabic and english ..(1846)
 */
add_action('add_meta_boxes', 'cd_meta_box_publications_title');

function cd_meta_box_publications_title() {
  add_meta_box('title-box', 'Add Publications Title', 'publications_title_cb', 'fhg_publications', 'normal', 'high');
}

function publications_title_cb() {
  // $post is already set, and contains an object: the WordPress post
  global $post;
  $values = get_post_custom($post->ID);


  $newsenglish = isset($values['publications_title_text']) ? $values['publications_title_text'] : '';
  $newsarabic = isset($values['publications_title_text_ar']) ? $values['publications_title_text_ar'] : '';



  // We'll use this nonce field later on when saving.
  wp_nonce_field('my_meta_box_nonce', 'meta_box_nonce');
  ?>
  <p>
    <label for="publications_title_text">English</label>
    <input type="text" name="publications_title_text" id="publications_title_text" value="<?php echo $newsenglish[0]; ?>" />
  </p>
  <p>
    <label for="publications_title_text_ar">Arabic</label>
    <input type="text" name="publications_title_text_ar" id="publications_title_text_ar" value="<?php echo $newsarabic[0]; ?>" />
  </p>


  <?php
}

add_action('save_post', 'publications_title_save');

function publications_title_save($post_id) {
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
  if (isset($_POST['publications_title_text']))
    update_post_meta($post_id, 'publications_title_text', wp_kses($_POST['publications_title_text'], $allowed));

  if (isset($_POST['publications_title_text_ar']))
    update_post_meta($post_id, 'publications_title_text_ar', wp_kses($_POST['publications_title_text_ar'], $allowed));
}
?>
<?php

/**
 * This function includes query to get all the posts related to news.
 */
function getAllPublications($no) {
  global $wpdb;

  $args_post = array(
      'numberposts' => $no,
      'orderby'   => 'meta_value',
      'meta_key'  => 'fhg_publications_startdate',
      'order'     => 'DESC',
      'post_type' => 'fhg_publications',
      'post_status' => 'publish',
      'posts_per_page' => 10, 
      'paged' => get_query_var('paged') ? get_query_var('paged') : 1
  );
  $arg_post_data = get_posts($args_post);

  return $arg_post_data;
}

function displayPublications() {


  $args_post = array(
      'numberposts' => 4,
      'child_of' => 0,
      'orderby'   => 'meta_value',
      'meta_key'  => 'fhg_publications_startdate',
      'order'     => 'DESC',
      'post_type' => 'fhg_publications',
      'post_status' => 'publish',
  );
  $arg_post_data = get_posts($args_post);





  if ($arg_post_data) {
    foreach ($arg_post_data as $post_data) {
      setup_postdata($post_data);
      $each_faq = (array) $post_data;
      $id = $each_faq['ID'];
      $post_title = $each_faq['post_title'];
      $post_content = $each_faq['post_content'];
      $customurl = $each_faq['guid'];
      $custom = get_post_custom($id);

      $featured = $custom['featured-checkbox-publication'][0];

      if ($featured == 'yes') {
        $featuredpost = '<span style="color:#f00;">This is a featured news!</span> ';
      } else {
        $featuredpost = 'This is a not a featured news!';
      }
      $sd = $custom["fhg_publications_startdate"][0];
      $ed = $custom["fhg_publications_enddate"][0];

      // - grab gmt for start -
      // $gmts = date('g:ia \o\n l jS F Y', $sd);
      $length = str_word_count($post_content);



      //$total_words = explode(" ", $post_content);
      //$post_content = implode(" ", array_splice($total_words, 0, 12));
      $post_content1 = wp_trim_words($post_content, 13, '...');

      //$details .= '...<a href="'.$customurl.'">Read More</a>';

      $gmts = date('jS F Y', $sd);


      if (wp_get_attachment_url(get_post_thumbnail_id($id))) {
        $feat_image = wp_get_attachment_url(get_post_thumbnail_id($id));
        $feat_image_url = '<img src="' . $feat_image . '" width="230" height="150" alt=""/>';
      } else {
        $feat_image = INC_URL_IMG . DS . 'transparent.png';
        $feat_image_url = '<img src="' . $feat_image . '" width="1" height="150" alt=""/>';
      }
      $arrowurl = INC_URL_IMG . DS . 'aarrow-brown.png';


      $url = $_SERVER['REQUEST_URI'];
      if (strstr($url, '/ar/') !== false) { //check if '?' is present

        $read = '<div class="link"><a href="' . $customurl . '"><img src="' . $arrowurl . '" width="12" height="12" alt=""/>اقرأ المزيد</a></div></div>';
      } else {
        $read = '<div class="link"><a href="' . $customurl . '"><img src="' . $arrowurl . '" width="12" height="12" alt=""/>Read More</a></div></div>';
      }

      $details .= '<div class="newscontainer1"><li style="list-style:none;"><div class="img">' . $feat_image_url . '</div>';
      $details .= '<div class="detials">  <div class="heading">' . $post_title . '</div>';
      $details .= '<div class="date">' . $gmts . '</div>';
      $details .= '<p>' . $post_content1 . '</p>' . $read . '</li></div>';
    }
    echo $str .= $details;
  } else {
    echo "No data";
  }
}

add_shortcode('latest-publications', 'displayPublications');

function displayFeaturedPublications() {

  $args_post = array(
      'numberposts' => -1,
      'child_of' => 0,
      'orderby'   => 'meta_value',
      'meta_key'  => 'fhg_publications_startdate',
      'order'     => 'DESC',
      'post_type' => 'fhg_publications',
      'post_status' => 'publish',
  );
  $arg_post_data = get_posts($args_post);

  if ($arg_post_data) {
    $counter = 0;
    foreach ($arg_post_data as $post_data) {
      $each_faq = (array) $post_data;
      $id = $each_faq['ID'];
      $custom = get_post_custom($id);
      $featured = $custom['featured-checkbox-publication'][0];

      if ($featured == 'yes') {
        $featuredpost = '<span style="color:#f00;">This is a featured news!</span> ';
        // print_r($each_faq);
        $post_title = $each_faq['post_title'];
        $post_content = $each_faq['post_content'];
        $customurl = $each_faq['guid'];
        //$post_name = $each_faq['post_title'];
        $sd = $custom["fhg_publications_startdate"][0];
        $ed = $custom["fhg_publications_enddate"][0];
        $feat_image = wp_get_attachment_url(get_post_thumbnail_id($id));
        // - grab gmt for start -
        // $gmts = date('g:ia \o\n l jS F Y', $sd);
        $post_content =  substr($post_content, 0, 200);
        $post_content = substr($post_content, 0, strrpos($post_content, ' ') + 1);

        $titlelength = str_word_count($post_title);
        if ($titlelength >= 10) {
           $post_title = wp_trim_words($post_title, 7, '...');
         // $post_content .= '...Read More
        }
        $gmts = date('jS F Y', $sd);    // eng date
        $gmts_ar = trans(transfullmonth(date('d F Y', $sd))); //arabic date

        if($counter == 0){
                    $details .= '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-16 newspageContent">';
                    $details .= '<a href="'.$customurl.'"><div class="pressreleaseLeftcon">';
                    $details .= '<div class="pad_div">';
                    $details .= '<div class="hed">'.$post_title.'</div>';
                    $details .= '<div class="topborder">&nbsp;</div>';
                    $details .= '<div class="date"><span>'. custom_translate($gmts,$gmts_ar).'</span></div>';
                    $details .= '<p>'.$post_content.'</p></div></div><img src='.$feat_image.'></a></div>';
                            
                          
                   $counter = 1;       
                     
                }else if($counter == 1){
                     $details .= '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-16 newspageContent newscontenttop">';
                    $details .= '<a href="'.$customurl.'"><div class="pressreleaseRightconTop">';
                    $details .= '<div class="boxLeft"><div class="topborder">&nbsp;</div>';
                    $details .= '<div class="date1">'. custom_translate($gmts,$gmts_ar).'</div>';
                    $details .= '<p>'.$post_title.'</p></div>';
                    $details .= '<div class="boxRight"><div class="arrowonimgr"><div class="arrow-right"></div></div><img src='.$feat_image.'></div>';
                    $details .= '</div></a></div>';

                    // if($featuredcount != 3){
                    //     $details .= '</div>';
                    // }
                    $counter = 2;
                }else if($counter == 2){
                    $details .= '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-16 newspageContent newscontentbottom"><div class="pressreleaseRightconBottom">';
                    $details .= '<a href="'.$customurl.'"><div class="boxRight"><div class="arrowonimgl"><div class="arrow-right"></div></div><img src="'.$feat_image.'"></div>';
                    $details .= '<div class="boxLeft">';
                    $details .= '<div class="topborder">&nbsp;</div>';
                    $details .= '<div class="date">'. custom_translate($gmts,$gmts_ar).'</div>';
                    $details .= '<p>'.$post_title.'</p></div></a></div></div>';

                    $counter = 3;
                }
      }
    }
    echo $str .= $details;
  } else {
    
  }
}

add_shortcode('featured-publications', 'displayFeaturedPublications');

function displayPublicationsAll() {

  if (isset($_GET['month']) || isset($_GET['yr'])) {

    global $wpdb;
    $db = $wpdb->prefix.'postmeta';
    if (isset($_GET['month']) && !empty($_GET['month'])) {
      $monthval = $_GET['month'];

      global $wpdb;
      $sq = "SELECT * FROM $db WHERE DATE_FORMAT( FROM_UNIXTIME(  `meta_value` ) ,  '%b' ) =  '$monthval' AND meta_key =  'fhg_publications_startdate'";
      $months1 = $wpdb->get_results($sq);


      foreach ($months1 as $month) {
        $monthval1 = $month->post_id;
        $postidarr[] = $month->post_id;
      }




      $args = array(
          'numberposts' => -1,
          'orderby'   => 'meta_value',
          'meta_key'  => 'fhg_publications_startdate',
          'order'     => 'DESC',
          'post_type' => 'fhg_publications',
          'post__in' => $postidarr,
          'post_status' => 'publish',
          'posts_per_page' => 10, 
          'paged' => get_query_var('paged') ? get_query_var('paged') : 1
      );
      $arg_post_data = get_posts($args);
      $totalposts = totalPPosts_mon_yrs($postidarr);            
    }

    if (isset($_GET['yr']) && !empty($_GET['yr'])) {
      $yearval = $_GET['yr'];
      //$sq = "SELECT * FROM `wp_postmeta` WHERE DATE_FORMAT( FROM_UNIXTIME(  `meta_value` ) ,  '%Y' ) =  '$yearval' AND meta_key =  'fhg_publications_startdate'";
      $sq = "SELECT * FROM $db WHERE DATE_FORMAT( FROM_UNIXTIME(  `meta_value` ) ,  '%Y' ) =  '$yearval' AND meta_key =  'fhg_publications_startdate'";
      $years1 = $wpdb->get_results($sq);
      //print_r($years1);
      foreach ($years1 as $year) {
        $yearval1 = $year->post_id;
        $postidarr[] = $year->post_id;
      }

      $args = array(
          'numberposts' => -1,
          'post_type' => 'fhg_publications',
          'post__in' => $postidarr,
          'post_status' => 'publish',
          'orderby'   => 'meta_value',
          'meta_key'  => 'fhg_publications_startdate',
          'order'     => 'DESC',
          'posts_per_page' => 10, 
          'paged' => get_query_var('paged') ? get_query_var('paged') : 1
      );
      $arg_post_data = get_posts($args);
      $totalposts = totalPPosts_mon_yrs($postidarr);  

    }
  } else {
    $arg_post_data = getAllPublications(-1);
    $totalposts =  totalPostsPublications();          
  }

  if ($arg_post_data) {

    $details .= '<div class="col-lg-2 col-md-2 col-sm-2 col-xs-16"></div>';
    $details .= '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-16 ">';
    $details .= '<div class="pastEvtContainer"><ul>';
    $counter = 0;
    foreach ($arg_post_data as $post_data) {
      $each_faq = (array) $post_data;

      $id = $each_faq['ID'];

      $post_title = $each_faq['post_title'];
      $post_content = $each_faq['post_content'];
      $custom = get_post_custom($id);
      // print_r($custom);
      $sd = $custom["fhg_publications_startdate"][0];
      $ed = $custom["fhg_publications_enddate"][0];
      $posturl = $each_faq['guid'];
      $post_name = $each_faq['post_title'];
      $customurl = $each_faq['guid'];

      //$location = custom_translate($custom['my_meta_box_text_publications'][0],$custom['my_meta_box_text_publications_ar'][0]);
      $post_name .= '...<a href="' . $customurl . '">'.custom_translate('Read More','اقرأ المزيد').'</a>';
      $feat_image = wp_get_attachment_url(get_post_thumbnail_id($id));
      $gmts = date('jS F Y', $sd);    // eng date
      $gmts_ar = trans(transfullmonth(date('d F Y', $sd))); //arabic date

      // - grab gmt for end -
      //$gmte = date('j M\/Y', $ed);
      //$gmte = strtotime($gmte);

      if ($counter == 0) {

        $details .= '<li><div class="detailpast"><div class="left">';
        $details .= '<img src='.$feat_image.'></div>';
        $details .= '<div class="right"><div class="topborder">&nbsp;</div>';
        //$details .= '<div class="venueDate"><span>' . $venue . ':</span>  <span>' . $location . '</span> <span>' . $date . ':</span> <span>' . $gmts . '</span></div>';
        $details .= '<div class="venueDate"><span>'.custom_translate('Date','تاريخ').':</span> <span>'. custom_translate($gmts,$gmts_ar).'</span></div>';
        $details .= '<div class="pastEvtxt"><a href="'.$customurl.'">'.$post_name.'</a></div></div></li>';

        $counter = 1;
      } else if ($counter == 1) {


        $details .= '<li><div class="detailpast"><div class="left">';
        $details .= '<img src='.$feat_image.'></div>';
        $details .= '<div class="right"><div class="topborder">&nbsp;</div>';
        //$details .= '<div class="venueDate"><span>' . $venue . ':</span>  <span>' . $location . '</span> <span>' . $date . ':</span> <span>' . $gmts . '</span></div>';
        $details .= '<div class="venueDate"><span>'.custom_translate('Date','تاريخ').':</span> <span>'. custom_translate($gmts,$gmts_ar).'</span></div>';
        $details .= '<div class="pastEvtxt"><a href="'.$customurl.'">'.$post_name.'</a></div></div></li>';

        $counter = 0;
      }


      //$details .= $gmte;
    }
    $details .= '</ul></div>';

            $details .= '</div><div class="col-lg-2 col-md-2 col-sm-2 col-xs-16"></div></div>';
            
            $details .= publicationspagination(totalPostsPublications());
        echo $str .= $details;
        //echo $str = $cat_name;
    //echo $str = $cat_name;
  } else {

    $coming = custom_translate('Coming Soon', 'قريبا');
    $details = '<div class="pastEvtContainer coming">' . $coming . '</div>';
    echo $details;
  }
}

add_shortcode('all-publications', 'displayPublicationsAll');

function totalPostsPublications() {

  global $wpdb;

  $args_post1 = array(
      'numberposts' => -1,
      'post_type' => 'fhg_publications',
      'post_status' => 'publish'
  );
  $arg_post_data1 = get_posts($args_post1);

  return count($arg_post_data1);
}

function totalPPosts_mon_yrs($postidarr){

    global $wpdb;
    $args = array(
        'numberposts' => -1,
        'post_type' => 'fhg_publications',
        'post__in' => $postidarr
    );
    $arg_post_data_mon_yr = get_posts($args);

    return count($arg_post_data_mon_yr);

}

function publicationspagination($totalposts){

  $big = 999999999; // need an unlikely integer
  $details1 .= '<div class="container"><div class="col-lg-2 col-md-2 col-sm-2 col-xs-16"></div><div class="col-lg-12 col-md-12 col-sm-12 col-xs-16 divpagination">';            
  $totalcount  = $totalposts / 10;
  $pages = paginate_links( array(

      'base' => custom_translate(str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),SITE_URL.'/ar/البيانات-الصحفية%_%'),
      'format' => '?paged=%#%',
      'current' => max( 1, get_query_var('paged') ),
      'total' => $totalcount,
      'prev_next' => false,
      'type'  => 'array',
      'prev_next'   => TRUE,
      'prev_text'    => __('previous'),
      'next_text'    => __('next'),
  ) );

  if( is_array( $pages ) ) {
   //   $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
      $details1.= '<ul class="pagination text-center">';
          foreach ( $pages as $page ){
              $details1 .= "<li>$page</li>";
          }                                
     $details1 .= '</ul>';
  }
  $details1 .= '</div><div class="col-lg-2 col-md-2 col-sm-2 col-xs-16"></div></div>';

  return $details1;
}

function fhg_publications_deactivate(){
    remove_shortcode('all-publications');
    remove_shortcode('featured-publications');
}

register_deactivation_hook( __FILE__, 'fhg_publications_deactivate' );
?>