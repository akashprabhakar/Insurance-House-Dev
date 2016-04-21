<?php
/*
Plugin Name: FH Financial Reports
Plugin URI:  http://www.annet.com
Description: To view and download the Financial Reports for the respective years.
Version:     1.0
Author:      Annet Technologies
License:     GPL2

*/


function fh_financialreports_posttypes() {

  $labels = array(
    'name' => _x('Financial Reports', 'post type general name'),
    'singular_name' => _x('Financial Report', 'post type singular name'),
    'add_new' => _x('Add New', 'Financial Report'),
    'add_new_item' => __('Add New Financial Report'),
    'edit_item' => __('Edit Financial Report'),
    'new_item' => __('New Financial Report'),
    'view_item' => __('View Financial Report'),
    'search_items' => __('Search Financial Report'),
    'not_found' =>  __('No Financial Report found'),
    'not_found_in_trash' => __('No Financial Report found in Trash'),
    'parent_item_colon' => '',
);

$args = array(
    'label' => __('Financial Reports'),
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
    'taxonomies' => array( 'financialreports_category', 'post_tag'),
);

register_post_type( 'fh_financial_reports', $args);

}

add_action('init', 'fh_financialreports_posttypes');

function create_financialreports_category_taxonomy() {

  $labels = array(
      'name' => _x('Financial Report Year', 'taxonomy general name'),
      'singular_name' => _x('Financial Report Year', 'taxonomy singular name'),
      'search_items' => __('Search Financial Report Year'),
      'popular_items' => __('Popular Financial Report Year'),
      'all_items' => __('All Financial Report Years'),
      'parent_item' => null,
      'parent_item_colon' => null,
      'edit_item' => __('Edit Financial Report Year'),
      'update_item' => __('Update Financial Report Year'),
      'add_new_item' => __('Add New Financial Report Year'),
      'new_item_name' => __('New Financial Report Year Name'),
      'separate_items_with_commas' => __('Separate Financial Report Year with commas'),
      'add_or_remove_items' => __('Add or remove Financial Report Year'),
      'choose_from_most_used' => __('Choose from the most used Financial Report Year'),
  );

  register_taxonomy('financialreports_category', 'fh_financial_reports', array(
      'label' => __('Financial Report Year Category'),
      'labels' => $labels,
      'hierarchical' => true,
      'show_ui' => true,
      'query_var' => true,
      'rewrite' => array('slug' => 'annualreports-category'),
  ));
}

add_action('init', 'create_financialreports_category_taxonomy', 0);

// 4. Show Meta-Box

add_action('admin_init', 'fh_financial_reports_create');

function fh_financial_reports_create() {
  add_meta_box('fh_financial_reports_meta', 'Financial Report', 'fh_financial_reports_meta', 'fh_financial_reports');
}

function fh_financial_reports_meta() {

  // - grab data -

  global $post;
  $custom = get_post_custom($post->ID);
  $meta_sd = $custom["fh_financial_reports_startdate"][0];
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

  echo '<input type="hidden" name="fh_financial_reports-nonce" id="fh_financial_reports-nonce" value="' .
  wp_create_nonce('fh_financial_reports-nonce') . '" />';

  // - output -
  ?>
  <table class="form-table">
      <tr valign="top">
          <th scope="row"><label>Financial Report Date</label><span class="error">*</span></th>
            <td>
              <input name="fh_financial_reports_startdate" class="tfdate" value="<?php echo $clean_sd; ?>" />
            </td>
      </tr>  
  </table>
  
  <?php
}

// 5. Save Data

add_action('save_post', 'save_fh_financial_reports');

function save_fh_financial_reports() {

  global $post;

  // - still require nonce

  if (!wp_verify_nonce($_POST['fh_financial_reports-nonce'], 'fh_financial_reports-nonce')) {
    return $post->ID;
  }

  if (!current_user_can('edit_post', $post->ID))
    return $post->ID;

  // - convert back to unix & update post

  if (!isset($_POST["fh_financial_reports_startdate"])):
    return $post;
  endif;
  $updatestartd = strtotime($_POST["fh_financial_reports_startdate"] . $_POST["fh_financial_reports_starttime"]);
  update_post_meta($post->ID, "fh_financial_reports_startdate", $updatestartd);
}

// 6. Customize Update Messages

add_filter('post_updated_messages', 'fh_financial_reports_updated_messages');

function fh_financial_reports_updated_messages($messages) {

  global $post, $post_ID;

  $messages['fh_financial_reports'] = array(
      0 => '', // Unused. Messages start at index 1.
      1 => sprintf(__('Financial Report updated. <a href="%s">View item</a>'), esc_url(get_permalink($post_ID))),
      2 => __('Custom field updated.'),
      3 => __('Custom field deleted.'),
      4 => __('Financial Report updated.'),
      /* translators: %s: date and time of the revision */
      5 => isset($_GET['revision']) ? sprintf(__('Financial Report restored to revision from %s'), wp_post_revision_title((int) $_GET['revision'], false)) : false,
      6 => sprintf(__('Financial Report published. <a href="%s">View Financial Report</a>'), esc_url(get_permalink($post_ID))),
      7 => __('Financial Report saved.'),
      8 => sprintf(__('Financial Report submitted. <a target="_blank" href="%s">Preview Financial Report</a>'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
      9 => sprintf(__('Financial Report scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Financial Report</a>'),
              // translators: Publish box date format, see http://php.net/date
              date_i18n(__('M j, Y @ G:i'), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
      10 => sprintf(__('Financial Report draft updated. <a target="_blank" href="%s">Preview Financial Report</a>'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
  );

  return $messages;
}

// 7. JS Datepicker UI

function financialreports_review_styles() {
  global $post_type;
  if ('fh_financial_reports' != $post_type)
    return;
  wp_enqueue_style('ui-datepicker', get_bloginfo('template_url') . '/css/jquery-ui-1.8.9.custom.css');
}

function financialreports_review_scripts() {
  global $post_type;
  if ('fh_financial_reports' != $post_type)
    return;
  wp_enqueue_script('jquery-ui', get_bloginfo('template_url') . '/js/jquery-ui.min.js', array('jquery'));
  wp_enqueue_script('ui-datepicker', get_bloginfo('template_url') . '/js/jquery.ui.datepicker.min.js');
  wp_enqueue_script('custom_script', get_bloginfo('template_url') . '/js/pubforce-admin.js', array('jquery'));
}

function financialreports_load_scripts() {
  wp_enqueue_media();
  wp_enqueue_script('custom-financialreports-js', '/wp-content/plugins/fh-financial-reports/js/fh_financial_reports.js');
}

add_action('admin_enqueue_scripts', 'financialreports_load_scripts');

add_action('admin_print_styles-post.php', 'financialreports_review_styles', 1000);
add_action('admin_print_styles-post-new.php', 'financialreports_review_styles', 1000);

add_action('admin_print_scripts-post.php', 'financialreports_review_scripts', 1000);
add_action('admin_print_scripts-post-new.php', 'financialreports_review_scripts', 1000);

/**
 * Coded By 1846
 * Meta Box for assigning the featured tag to the selected posts.
 */
function financial_reports_featured_meta() {
  add_meta_box('prfx_meta', __('Featured Financial Report', 'prfx-textdomain'), 'financial_reports_meta_callback', 'fh_financial_reports', 'normal', 'high');
}

add_action('add_meta_boxes', 'financial_reports_featured_meta');

/**
 * Outputs the content of the meta box
 */
function financial_reports_meta_callback($post) {
  wp_nonce_field(basename(__FILE__), 'prfx_nonce');
  $prfx_stored_meta = get_post_meta($post->ID);
  ?>

  <p>
    <span class="prfx-row-title"><?php _e('Check if this is a featured report: ', 'prfx-textdomain') ?></span>
  <div class="prfx-row-content">
    <label for="featured-checkbox-financial-reports">
      <input type="checkbox" name="featured-checkbox-financial-reports" id="featured-checkbox-financial-reports" value="yes" <?php if (isset($prfx_stored_meta['featured-checkbox-financial-reports'])) checked($prfx_stored_meta['featured-checkbox-financial-reports'][0], 'yes'); ?> />
  <?php _e('Featured Financial Report', 'prfx-textdomain') ?>
    </label>

  </div>
  </p>   

  <?php
}

/**
 * Saves the custom meta input
 */
function financial_reports_meta_save($post_id) {

  // Checks save status - overcome autosave, etc.
  $is_autosave = wp_is_post_autosave($post_id);
  $is_revision = wp_is_post_revision($post_id);
  $is_valid_nonce = ( isset($_POST['prfx_nonce']) && wp_verify_nonce($_POST['prfx_nonce'], basename(__FILE__)) ) ? 'true' : 'false';

  // Exits script depending on save status
  if ($is_autosave || $is_revision || !$is_valid_nonce) {
    return;
  }

// Checks for input and saves - save checked as yes and unchecked at no
  if (isset($_POST['featured-checkbox-financial-reports'])) {
    update_post_meta($post_id, 'featured-checkbox-financial-reports', 'yes');
  } else {
    update_post_meta($post_id, 'featured-checkbox-financial-reports', 'no');
  }
}

add_action('save_post', 'financial_reports_meta_save');
/**
 *  Meta Box Module end
 */
add_action('add_meta_boxes', 'cd_meta_box_add_financial_reports');

function cd_meta_box_add_financial_reports() {
  add_meta_box('annual-reports', 'Add Financial Report Magazine', 'financial_reports_pdf_cb', 'fh_financial_reports', 'normal', 'high');
}

function financial_reports_pdf_cb() {
  // $post is already set, and contains an object: the WordPress post
  global $post;
  $values = get_post_custom($post->ID);

  //print_r($values);
  $financialreports_pdf_url = isset($values['financialreports_pdf']) ? $values['financialreports_pdf'] : '';
  $financialreports_pdf_url_ar = isset($values['financialreports_pdf_ar']) ? $values['financialreports_pdf_ar'] : '';
  // We'll use this nonce field later on when saving.
  wp_nonce_field('my_meta_box_nonce', 'meta_box_nonce');
  ?>
<table>
    <tr valign="top">
    <th scope="row"><label>Upload PDF (English):</label> <span class="error">*</span></th>
    <td>
      <input id="financialreports_pdf" type="text" value="<?php echo $financialreports_pdf_url[0]; ?>" name="financialreports_pdf" />
      <button type="button" id="finupload-button-fh" class="button" ><span class="dashicons dashicons-admin-media"></span> Add PDF</button>
    </td>
  </tr>
   <br>
  <tr valign="top">
    <th scope="row"><label>Upload PDF (Arabic):</label> <span class="error">*</span></th>
    <td>
      <input id="financialreports_pdf_ar" type="text" value="<?php echo $financialreports_pdf_url_ar[0]; ?>" name="financialreports_pdf_ar" />
      <button type="button" id="finupload-button-fh-ar" class="button" ><span class="dashicons dashicons-admin-media"></span> Add PDF</button>
    </td>
  </tr>               
</table>

  <?php
}

add_action('save_post', 'cd_meta_box_financial_reports_save');

function cd_meta_box_financial_reports_save($post_id) {
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
  if (isset($_POST['financialreports_pdf']))
    update_post_meta($post_id, 'financialreports_pdf', wp_kses($_POST['financialreports_pdf'], $allowed));

   if (isset($_POST['financialreports_pdf_ar']))
    update_post_meta($post_id, 'financialreports_pdf_ar', wp_kses($_POST['financialreports_pdf_ar'], $allowed));

}



function getAllFinancialReports($catyear) {
  global $wpdb;

  $args_post = array(
      'numberposts' => -1,
      'post_type' => 'fh_financial_reports',
      'post_status' => 'publish',
      'order'   => 'ASC',
      'orderby' => 'ID',
      'tax_query' => array(array('taxonomy' => 'financialreports_category','field' => "slug",'terms' => $catyear)),
      'posts_per_page' => 10, 
      'paged' => get_query_var('paged') ? get_query_var('paged') : 1

  );
  $arg_post_data = get_posts($args_post);

  return $arg_post_data;
}
function displayFinanceL() {
  $args_post = array(
   'numberposts' => 1,
    'post_type' => 'fh_financial_reports',
    'orderby'   => 'ID',
    'order'     => 'DESC',
    'post_status' => 'publish',
    );
  $arg_post_data = get_posts($args_post);
  if ($arg_post_data) {
    foreach ($arg_post_data as $post_data) {
      $each_faq = (array) $post_data;
      $postvalues = get_values_from_array($each_faq,50,50,7,'fh_financial_reports_startdate','financialreports_pdf');
      echo '<div class="col-md-5 emiSliderLeft">
              <h1>'.custom_translate('LATEST REPORT','التقريرالأخير').'</h1>
              <p class="date">'.custom_translate('Date:','التاريخ:').custom_translate($postvalues['date'],$postvalues['date_ar']).'</p>
              <p>'.$postvalues['title'].'</p>
            </div>
            <div class="col-md-7 emiSliderRight">
              <div class="sliderimg"><img src="'.INC_URL_IMG.DS.'fh-financeial_reports.jpg" alt="fh-financeial_reports">  
              <div class="emirates_button"><p><a href="' . $postvalues['download_url'] . '" class="btn btn-primary" role="button" download><span>'.custom_translate('Download','تحميل').'</span></a> <a href="' . $postvalues['download_url'] . '" class="btn btn-default fancybox-pdf" role="button"><span>' . custom_translate('Read','اقرأ') . '</span></a></p></div>
              </div>
            </div>';
      break;
    }
  } 
}
  

add_shortcode('latest-finance', 'displayFinanceL');

function displayFinancialReportsAll() {

  if (isset($_GET['finyr']) && !empty($_GET['finyr'])) {
 
      $finyear = $_GET['finyr'];
      $args = array(
          'numberposts' => $no,
          'post_type' => 'fh_financial_reports',
          'post_status' => 'publish',
          'order'   => 'ASC',
          'orderby' => 'ID',
          'tax_query' => array(array('taxonomy' => 'financialreports_category','field' => "slug",'terms' => $finyear)),
          'posts_per_page' => 10, 
          'paged' => get_query_var('paged') ? get_query_var('paged') : 1

      );
      $arg_post_data = get_posts($args);
      //$totalposts = totalPosts_mon_yrs($postidarr);
  } else {
      $args = array(
        'taxonomy' => 'financialreports_category',
        'orderby' => 'name',
        'order' => 'DESC'
      );
    $fincategories = get_categories($args);
    $arg_post_data = getAllFinancialReports($fincategories[1]->slug);
    //$totalposts = totalPostsFinancialreports();
  }

  if ($arg_post_data) {
    //  $counter = 0;
    foreach ($arg_post_data as $post_data) {
      $each_faq = (array) $post_data;
      $postvalues = get_values_from_array($each_faq,10,10,7,'fh_financial_reports_startdate','financialreports_pdf');
      $details .= '<div class="col-sm-6 col-md-4">';
      $details .= '<div class="thumbnail">';
      $details .= '<img src="'.$postvalues['feat_image'].'" alt="emirates review magazine">';
      $details .= '<div class="caption">';
      $details .= '<div class="emirates_contents"><h3>'.$postvalues['title'].'</h3>';
      $details .= '<span>'.custom_translate('Year','عام'). ':' .$postvalues['year']. '</span></div>';
      $details .= '<div class="emirates_button"><p><a href="' . $postvalues['download_url'] . '" class="btn btn-primary" role="button" download><span>'.custom_translate('Download','تحميل').'</span></a> <a href="' . $postvalues['download_url'] . '" class="btn btn-default fancybox-pdf" role="button"><span>' . custom_translate('Read','اقرأ') . '</span></a></p></div>';
      $details .= '</div></div></div>';

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

add_shortcode('all-financialreports', 'displayFinancialReportsAll');

function totalPostsFinancialreports() {

  global $wpdb;

  $args_post1 = array(
      'numberposts' => -1,
      'post_type' => 'fh_financial_reports',
      'post_status' => 'publish'
  );
  $arg_post_data1 = get_posts($args_post1);

  return count($arg_post_data1);
}
?>
