<?php
/*
Plugin Name: FH Annual Reports
Plugin URI:  http://www.annet.com
Description: To view and download the annual reports for the respective years.
Version:     1.0
Author:      Annet Technologies
License:     GPL2

*/


function fh_annualreports_posttypes() {

  $labels = array(
    'name' => _x('Annual Reports', 'post type general name'),
    'singular_name' => _x('Annual Report', 'post type singular name'),
    'add_new' => _x('Add New', 'Annual Report'),
    'add_new_item' => __('Add New Annual Report'),
    'edit_item' => __('Edit Annual Report'),
    'new_item' => __('New Annual Report'),
    'view_item' => __('View Annual Report'),
    'search_items' => __('Search Annual Report'),
    'not_found' =>  __('No Annual Report found'),
    'not_found_in_trash' => __('No Annual Report found in Trash'),
    'parent_item_colon' => '',
);

$args = array(
    'label' => __('Annual Reports'),
    'labels' => $labels,
    'public' => true,
    'can_export' => true,
    'show_ui' => true,
    '_builtin' => false,
    '_edit_link' => 'post.php?post=%d', // ?
    'capability_type' => 'post',
    'menu_icon' => 'dashicons-format-aside',
    'hierarchical' => false,
    'rewrite' => array( "slug" => "annual-reports" ),
    'supports'=> array('title', 'thumbnail', 'excerpt' ,'editor') ,
    'show_in_nav_menus' => true,
    'taxonomies' => array( 'annualreports_category', 'post_tag')
);

register_post_type( 'fh_annual_reports', $args);

}

add_action('init', 'fh_annualreports_posttypes');

function create_annualreports_category_taxonomy() {

  $labels = array(
      'name' => _x('Annual Report Year', 'taxonomy general name'),
      'singular_name' => _x('Annual Report Year', 'taxonomy singular name'),
      'search_items' => __('Search Annual Report Year'),
      'popular_items' => __('Popular Annual Report Year'),
      'all_items' => __('All Annual Report Years'),
      'parent_item' => null,
      'parent_item_colon' => null,
      'edit_item' => __('Edit Annual Report Year'),
      'update_item' => __('Update Annual Report Year'),
      'add_new_item' => __('Add New Annual Report Year'),
      'new_item_name' => __('New Annual Report Year Name'),
      'separate_items_with_commas' => __('Separate Annual Report Year with commas'),
      'add_or_remove_items' => __('Add or remove Annual Report Year'),
      'choose_from_most_used' => __('Choose from the most used Annual Report Year'),
  );

  register_taxonomy('annualreports_category', 'fh_annual_reports', array(
      'label' => __('Annual Report Year Category'),
      'labels' => $labels,
      'hierarchical' => true,
      'show_ui' => true,
      'query_var' => true,
      'rewrite' => array('slug' => 'annualreports-category'),
  ));
}

add_action('init', 'create_annualreports_category_taxonomy', 0);

// 4. Show Meta-Box

add_action('admin_init', 'fh_annual_reports_create');

function fh_annual_reports_create() {
  add_meta_box('fh_annual_reports_meta', 'Annual Report', 'fh_annual_reports_meta', 'fh_annual_reports');
}

function fh_annual_reports_meta() {

  // - grab data -

  global $post;
  $custom = get_post_custom($post->ID);
  $meta_sd = $custom["fh_annual_reports_startdate"][0];
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

  echo '<input type="hidden" name="fh_annual_reports-nonce" id="fh_annual_reports-nonce" value="' .
  wp_create_nonce('fh_annual_reports-nonce') . '" />';

  // - output -
  ?>
  <table class="form-table">
      <tr valign="top">
          <th scope="row"><label>Annual Report Date</label><span class="error">*</span></th>
            <td>
              <input name="fh_annual_reports_startdate" class="tfdate" value="<?php echo $clean_sd; ?>" />
            </td>
      </tr>  
  </table>
  
  <?php
}

// 5. Save Data

add_action('save_post', 'save_fh_annual_reports');

function save_fh_annual_reports() {

  global $post;

  // - still require nonce

  if (!wp_verify_nonce($_POST['fh_annual_reports-nonce'], 'fh_annual_reports-nonce')) {
    return $post->ID;
  }

  if (!current_user_can('edit_post', $post->ID))
    return $post->ID;

  // - convert back to unix & update post

  if (!isset($_POST["fh_annual_reports_startdate"])):
    return $post;
  endif;
  $updatestartd = strtotime($_POST["fh_annual_reports_startdate"] . $_POST["fh_annual_reports_starttime"]);
  update_post_meta($post->ID, "fh_annual_reports_startdate", $updatestartd);
}

// 6. Customize Update Messages

add_filter('post_updated_messages', 'fh_annual_reports_updated_messages');

function fh_annual_reports_updated_messages($messages) {

  global $post, $post_ID;

  $messages['fh_annual_reports'] = array(
      0 => '', // Unused. Messages start at index 1.
      1 => sprintf(__('Annual Report updated. <a href="%s">View item</a>'), esc_url(get_permalink($post_ID))),
      2 => __('Custom field updated.'),
      3 => __('Custom field deleted.'),
      4 => __('Annual Report updated.'),
      /* translators: %s: date and time of the revision */
      5 => isset($_GET['revision']) ? sprintf(__('Annual Report restored to revision from %s'), wp_post_revision_title((int) $_GET['revision'], false)) : false,
      6 => sprintf(__('Annual Report published. <a href="%s">View Annual Report</a>'), esc_url(get_permalink($post_ID))),
      7 => __('Annual Report saved.'),
      8 => sprintf(__('Annual Report submitted. <a target="_blank" href="%s">Preview Annual Report</a>'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
      9 => sprintf(__('Annual Report scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Annual Report</a>'),
              // translators: Publish box date format, see http://php.net/date
              date_i18n(__('M j, Y @ G:i'), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
      10 => sprintf(__('Annual Report draft updated. <a target="_blank" href="%s">Preview Annual Report</a>'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
  );

  return $messages;
}

// 7. JS Datepicker UI

function annualreports_review_styles() {
  global $post_type;
  if ('fh_annual_reports' != $post_type)
    return;
  wp_enqueue_style('ui-datepicker', get_bloginfo('template_url') . '/css/jquery-ui-1.8.9.custom.css');
}

function annualreports_review_scripts() {
  global $post_type;
  if ('fh_annual_reports' != $post_type)
    return;
  wp_enqueue_script('jquery-ui', get_bloginfo('template_url') . '/js/jquery-ui.min.js', array('jquery'));
  wp_enqueue_script('ui-datepicker', get_bloginfo('template_url') . '/js/jquery.ui.datepicker.min.js');
  wp_enqueue_script('custom_script', get_bloginfo('template_url') . '/js/pubforce-admin.js', array('jquery'));
}

function annualreports_load_scripts() {
  wp_enqueue_media();
  wp_enqueue_script('custom-annualreports-js', '/wp-content/plugins/fh-annual-reports/js/fh_annual_reports.js');
}

add_action('admin_enqueue_scripts', 'annualreports_load_scripts');

add_action('admin_print_styles-post.php', 'annualreports_review_styles', 1000);
add_action('admin_print_styles-post-new.php', 'annualreports_review_styles', 1000);

add_action('admin_print_scripts-post.php', 'annualreports_review_scripts', 1000);
add_action('admin_print_scripts-post-new.php', 'annualreports_review_scripts', 1000);

/**
 * Coded By 1846
 * Meta Box for assigning the featured tag to the selected posts.
 */
function annual_reports_featured_meta() {
  add_meta_box('prfx_meta', __('Featured Annual Report', 'prfx-textdomain'), 'annual_reports_meta_callback', 'fh_annual_reports', 'normal', 'high');
}

add_action('add_meta_boxes', 'annual_reports_featured_meta');

/**
 * Outputs the content of the meta box
 */
function annual_reports_meta_callback($post) {
  wp_nonce_field(basename(__FILE__), 'prfx_nonce');
  $prfx_stored_meta = get_post_meta($post->ID);
  ?>

  <p>
    <span class="prfx-row-title"><?php _e('Check if this is a featured report: ', 'prfx-textdomain') ?></span>
  <div class="prfx-row-content">
    <label for="featured-checkbox-annual-reports">
      <input type="checkbox" name="featured-checkbox-annual-reports" id="featured-checkbox-annual-reports" value="yes" <?php if (isset($prfx_stored_meta['featured-checkbox-annual-reports'])) checked($prfx_stored_meta['featured-checkbox-annual-reports'][0], 'yes'); ?> />
  <?php _e('Featured Annual Report', 'prfx-textdomain') ?>
    </label>

  </div>
  </p>   

  <?php
}

/**
 * Saves the custom meta input
 */
function annual_reports_meta_save($post_id) {

  // Checks save status - overcome autosave, etc.
  $is_autosave = wp_is_post_autosave($post_id);
  $is_revision = wp_is_post_revision($post_id);
  $is_valid_nonce = ( isset($_POST['prfx_nonce']) && wp_verify_nonce($_POST['prfx_nonce'], basename(__FILE__)) ) ? 'true' : 'false';

  // Exits script depending on save status
  if ($is_autosave || $is_revision || !$is_valid_nonce) {
    return;
  }

// Checks for input and saves - save checked as yes and unchecked at no
  if (isset($_POST['featured-checkbox-annual-reports'])) {
    update_post_meta($post_id, 'featured-checkbox-annual-reports', 'yes');
  } else {
    update_post_meta($post_id, 'featured-checkbox-annual-reports', 'no');
  }
}

add_action('save_post', 'annual_reports_meta_save');
/**
 *  Meta Box Module end
 */
add_action('add_meta_boxes', 'cd_meta_box_add_annual_reports');

function cd_meta_box_add_annual_reports() {
  add_meta_box('annual-reports', 'Add Annual Report Magazine', 'annual_reports_pdf_cb', 'fh_annual_reports', 'normal', 'high');
}

function annual_reports_pdf_cb() {
  // $post is already set, and contains an object: the WordPress post
  global $post;
  $values = get_post_custom($post->ID);

  //print_r($values);
  $annualreports_pdf_url = isset($values['annualreports_pdf']) ? $values['annualreports_pdf'] : '';
  $annualreports_pdf_url_ar = isset($values['annualreports_pdf_ar']) ? $values['annualreports_pdf_ar'] : '';
  // We'll use this nonce field later on when saving.
  wp_nonce_field('my_meta_box_nonce', 'meta_box_nonce');
  ?>
<table>
    <tr valign="top">
    <th scope="row"><label>Upload PDF (English):</label> <span class="error">*</span></th>
    <td>
      <input id="annualreports_pdf" type="text" value="<?php echo $annualreports_pdf_url[0]; ?>" name="annualreports_pdf" />
      <button type="button" id="annupload-button-fh" class="button" ><span class="dashicons dashicons-admin-media"></span> Add PDF</button>
    </td>
  </tr>
   <br>
  <tr valign="top">
    <th scope="row"><label>Upload PDF (Arabic):</label> <span class="error">*</span></th>
    <td>
      <input id="annualreports_pdf_ar" type="text" value="<?php echo $annualreports_pdf_url_ar[0]; ?>" name="annualreports_pdf_ar" />
      <button type="button" id="annupload-button-fh-ar" class="button" ><span class="dashicons dashicons-admin-media"></span> Add PDF</button>
    </td>
  </tr>               
</table>

  <?php
}

add_action('save_post', 'cd_meta_box_annual_reports_save');

function cd_meta_box_annual_reports_save($post_id) {
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
  if (isset($_POST['annualreports_pdf']))
    update_post_meta($post_id, 'annualreports_pdf', wp_kses($_POST['annualreports_pdf'], $allowed));

   if (isset($_POST['annualreports_pdf_ar']))
    update_post_meta($post_id, 'annualreports_pdf_ar', wp_kses($_POST['annualreports_pdf_ar'], $allowed));

}


function displayFeaturedReports() { 
  $args_post = array(
    'numberposts' => 1,
    'post_type' => 'fh_annual_reports',
    'orderby'   => 'meta_value',
    'meta_key'  => 'fh_annual_reports_startdate',
    'order'     => 'DESC',
    'post_status' => 'publish',
  );
  $arg_post_data = get_posts($args_post);
  if ($arg_post_data) {
    foreach ($arg_post_data as $post_data) {
      $each_faq = (array) $post_data;
      $postvalues = get_values_from_array($each_faq,50,50,7,'fh_annual_reports_startdate','annualreports_pdf');
      echo '<div class="col-md-5 emiSliderLeft">
              <h1>'.custom_translate('LATEST REPORT','التقرير الأخير').'</h1>
              <p>'.$postvalues['title'].'</p>
            </div>
            <div class="col-md-7 emiSliderRight">
              <div class="sliderimg"><img src="'.INC_URL_IMG.DS.'annual_reports.jpg" alt="annual_reports">  
              <div class="emirates_button"><p><a href="' . $postvalues['download_url'] . '" class="btn btn-primary" role="button" download><span>'.custom_translate('Download','تحميل').'</span></a> <a href="' . $postvalues['download_url'] . '" class="btn btn-default fancybox-pdf" role="button"><span>' . custom_translate('Read','اقرأ') . '</span></a></p></div>
              </div>
            </div>';
      break;
    }
  } 
}

add_shortcode('featured-annualreports', 'displayFeaturedReports');

function getAllReports($no) {
  global $wpdb;

  $args_post = array(
      'numberposts' => $no,
      'child_of' => 0,
      'orderby' => 'meta_value',
      'meta_key' => 'fh_annual_reports_startdate',
      'order' => 'DESC',
      'post_type' => 'fh_annual_reports',
      'post_status' => 'publish',
  );
  $arg_post_data = get_posts($args_post);

  return $arg_post_data;
}



function displayAnnualReportsAll() {
  if (isset($_GET['month']) || isset($_GET['yr'])) {
    $arg_post_data = get_Month_Years_data('fh_annual_reports_startdate','fh_annual_reports');
  } else {
    $arg_post_data = getAllReports(-1);

  }

  if ($arg_post_data) {
    $counter = 0;
    foreach ($arg_post_data as $post_data) {
      if($counter != 0) {
      $each_faq = (array) $post_data;
      $postvalues = get_values_from_array($each_faq,10,10,7,'fh_annual_reports_startdate','annualreports_pdf');
      $details .= '<div class="col-sm-6 col-md-4">';
      $details .= '<div class="thumbnail">';
      $details .= '<img src="'.$postvalues['feat_image'].'" alt="emirates review magazine">';
      $details .= '<div class="caption">';
      $details .= '<div class="emirates_contents"><h3>'.$postvalues['title'].'</h3></div>';
      // $details .= '<span>'.custom_translate('Date','تاريخ'). ':' .custom_translate($postvalues['date'],$postvalues['date_ar']). '</span>';
      $details .= '<div class="emirates_button"><p><a href="' . $postvalues['download_url'] . '" class="btn btn-primary" role="button" download><span>'.custom_translate('Download','تحميل').'</span></a> <a href="' . $postvalues['download_url'] . '" class="btn btn-default fancybox-pdf" role="button"><span>' . custom_translate('Read','اقرأ') . '</span></a></p></div>';
      $details .= '</div></div></div>';
      }
      $counter++;
    }
      //$details .= emiratespagination(totalPostsEmirates());
    echo $str .= $details;
      //echo $str = $cat_name;
  }else {
    $coming = custom_translate('Coming Soon', 'قريبا');
    $details = '<div class="pastEvtContainer coming">' . $coming . '</div>';
    echo $details;
  }
}

add_shortcode('all-annualreports', 'displayAnnualReportsAll');

function totalPostsAnnualreports() {

  global $wpdb;

  $args_post1 = array(
      'numberposts' => -1,
      'post_type' => 'fh_annual_reports',
      'post_status' => 'publish'
  );
  $arg_post_data1 = get_posts($args_post1);

  return count($arg_post_data1);
}

// 1742 
?>
