<?php
/*
Plugin Name: FH Emirates Review
Plugin URI:  http://www.annet.com
Description: To view and download the emirates review magazine. Emirates Review is a magazine produced quarterly on behalf of Finance House covering issues that is of interest to you both in business and at home.
Version:     1.0
Author:      Annet Technologies
License:     GPL2

*/


function fh_emirates_posttypes() {

  $labels = array(
    'name' => _x('Emirates Review', 'post type general name'),
    'singular_name' => _x('Emirates Review', 'post type singular name'),
    'add_new' => _x('Add New', 'Emirates Review'),
    'add_new_item' => __('Add New Emirates Review'),
    'edit_item' => __('Edit Emirates Review'),
    'new_item' => __('New Emirates Review'),
    'view_item' => __('View Emirates Review'),
    'search_items' => __('Search Emirates Review'),
    'not_found' =>  __('No Emirates Review found'),
    'not_found_in_trash' => __('No Emirates Review found in Trash'),
    'parent_item_colon' => '',
);

$args = array(
    'label' => __('Emirates Review'),
    'labels' => $labels,
    'public' => true,
    'can_export' => true,
    'show_ui' => true,
    '_builtin' => false,
    '_edit_link' => 'post.php?post=%d', // ?
    'capability_type' => 'post',
    'menu_icon' => 'dashicons-format-aside',
    'hierarchical' => false,
    'rewrite' => array( "slug" => "en/section/about-us/emirates-review" ),
    'supports'=> array('title', 'thumbnail', 'excerpt' ,'editor') ,
    'show_in_nav_menus' => true,
    'taxonomies' => array( 'emirates_category', 'post_tag'),
   // 'show_in_menu' => 'annet-fhg-capm-all/index.php'
);

register_post_type( 'fh_emirates_review', $args);

}

add_action('init', 'fh_emirates_posttypes');

function create_emirates_category_taxonomy() {

  $labels = array(
      'name' => _x('Emirates Review Year', 'taxonomy general name'),
      'singular_name' => _x('Emirates Review Year', 'taxonomy singular name'),
      'search_items' => __('Search Emirates Review Year'),
      'popular_items' => __('Popular Emirates Review Year'),
      'all_items' => __('All Emirates Review Years'),
      'parent_item' => null,
      'parent_item_colon' => null,
      'edit_item' => __('Edit Emirates Review Year'),
      'update_item' => __('Update Emirates Review Year'),
      'add_new_item' => __('Add New Emirates Review Year'),
      'new_item_name' => __('New Emirates Review Year Name'),
      'separate_items_with_commas' => __('Separate Emirates Review Year with commas'),
      'add_or_remove_items' => __('Add or remove Emirates Review Year'),
      'choose_from_most_used' => __('Choose from the most used Emirates Review Year'),
  );

  register_taxonomy('emirates_category', 'fh_emirates_review', array(
      'label' => __('Emirates Year Category'),
      'labels' => $labels,
      'hierarchical' => true,
      'show_ui' => true,
      'query_var' => true,
      'rewrite' => array('slug' => 'emirates-category'),
  ));
}

add_action('init', 'create_emirates_category_taxonomy', 0);

// 4. Show Meta-Box

add_action('admin_init', 'fh_emirates_review_create');

function fh_emirates_review_create() {
  add_meta_box('fh_emirates_review_meta', 'Emirates Review', 'fh_emirates_review_meta', 'fh_emirates_review');
}

function fh_emirates_review_meta() {

  // - grab data -

  global $post;
  $custom = get_post_custom($post->ID);
  $meta_sd = $custom["fh_emirates_review_startdate"][0];
  $meta_st = $meta_sd;
  $date_format = get_option('date_format');
  $time_format = get_option('time_format');
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

  echo '<input type="hidden" name="fh_emirates_review-nonce" id="fh_emirates_review-nonce" value="' .
  wp_create_nonce('fh_emirates_review-nonce') . '" />';

  // - output -
  ?>
  <table class="form-table">
      <tr valign="top">
          <th scope="row"><label>Emirates Review Date</label><span class="error">*</span></th>
            <td>
              <input name="fh_emirates_review_startdate" class="tfdate" value="<?php echo $clean_sd; ?>" />
            </td>
      </tr>  
  </table>
  
  <?php
}

// 5. Save Data

add_action('save_post', 'save_fh_emirates_review');

function save_fh_emirates_review() {

  global $post;

  // - still require nonce

  if (!wp_verify_nonce($_POST['fh_emirates_review-nonce'], 'fh_emirates_review-nonce')) {
    return $post->ID;
  }

  if (!current_user_can('edit_post', $post->ID))
    return $post->ID;

  // - convert back to unix & update post

  if (!isset($_POST["fh_emirates_review_startdate"])):
    return $post;
  endif;
  $updatestartd = strtotime($_POST["fh_emirates_review_startdate"] . $_POST["fh_emirates_review_starttime"]);
  update_post_meta($post->ID, "fh_emirates_review_startdate", $updatestartd);
}

// 6. Customize Update Messages

add_filter('post_updated_messages', 'fh_emirates_review_updated_messages');

function fh_emirates_review_updated_messages($messages) {

  global $post, $post_ID;

  $messages['fh_emirates_review'] = array(
      0 => '', // Unused. Messages start at index 1.
      1 => sprintf(__('Emirates Review updated. <a href="%s">View item</a>'), esc_url(get_permalink($post_ID))),
      2 => __('Custom field updated.'),
      3 => __('Custom field deleted.'),
      4 => __('Emirates Review updated.'),
      /* translators: %s: date and time of the revision */
      5 => isset($_GET['revision']) ? sprintf(__('Emirates Review restored to revision from %s'), wp_post_revision_title((int) $_GET['revision'], false)) : false,
      6 => sprintf(__('Emirates Review published. <a href="%s">View Emirates Review</a>'), esc_url(get_permalink($post_ID))),
      7 => __('Emirates Review saved.'),
      8 => sprintf(__('Emirates Review submitted. <a target="_blank" href="%s">Preview Emirates Review</a>'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
      9 => sprintf(__('Emirates Review scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Emirates Review</a>'),
              // translators: Publish box date format, see http://php.net/date
              date_i18n(__('M j, Y @ G:i'), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
      10 => sprintf(__('Emirates Review draft updated. <a target="_blank" href="%s">Preview Emirates Review</a>'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
  );

  return $messages;
}

// 7. JS Datepicker UI

function emirates_review_styles() {
  global $post_type;
  if ('fh_emirates_review' != $post_type)
    return;
  wp_enqueue_style('ui-datepicker', get_bloginfo('template_url') . '/css/jquery-ui-1.8.9.custom.css');
}

function emirates_review_scripts() {
  global $post_type;
  if ('fh_emirates_review' != $post_type)
    return;
  wp_enqueue_script('jquery-ui', get_bloginfo('template_url') . '/js/jquery-ui.min.js', array('jquery'));
  wp_enqueue_script('ui-datepicker', get_bloginfo('template_url') . '/js/jquery.ui.datepicker.min.js');
  wp_enqueue_script('custom_script', get_bloginfo('template_url') . '/js/pubforce-admin.js', array('jquery'));
}

function emirates_load_scripts() {
  wp_enqueue_media();
  wp_enqueue_script('custom-emirates-js', '/wp-content/plugins/fh-emirates-review/js/fh_emirates_review.js');
}

add_action('admin_enqueue_scripts', 'emirates_load_scripts');

add_action('admin_print_styles-post.php', 'emirates_review_styles', 1000);
add_action('admin_print_styles-post-new.php', 'emirates_review_styles', 1000);

add_action('admin_print_scripts-post.php', 'emirates_review_scripts', 1000);
add_action('admin_print_scripts-post-new.php', 'emirates_review_scripts', 1000);

/**
 * Coded By 1846
 * Meta Box for assigning the featured tag to the selected posts.
 */
function emirates_review_featured_meta() {
  add_meta_box('prfx_meta', __('Featured emirates_review', 'prfx-textdomain'), 'emirates_review_meta_callback', 'fh_emirates_review', 'normal', 'high');
}

add_action('add_meta_boxes', 'emirates_review_featured_meta');

/**
 * Outputs the content of the meta box
 */
function emirates_review_meta_callback($post) {
  wp_nonce_field(basename(__FILE__), 'prfx_nonce');
  $prfx_stored_meta = get_post_meta($post->ID);
  ?>

  <p>
    <span class="prfx-row-title"><?php _e('Check if this is a featured news: ', 'prfx-textdomain') ?></span>
  <div class="prfx-row-content">
    <label for="featured-checkbox-emirates-review">
      <input type="checkbox" name="featured-checkbox-emirates-review" id="featured-checkbox-emirates-review" value="yes" <?php if (isset($prfx_stored_meta['featured-checkbox-emirates-review'])) checked($prfx_stored_meta['featured-checkbox-emirates-review'][0], 'yes'); ?> />
  <?php _e('Featured emirates_review', 'prfx-textdomain') ?>
    </label>

  </div>
  </p>   

  <?php
}

/**
 * Saves the custom meta input
 */
function emirates_review_meta_save($post_id) {

  // Checks save status - overcome autosave, etc.
  $is_autosave = wp_is_post_autosave($post_id);
  $is_revision = wp_is_post_revision($post_id);
  $is_valid_nonce = ( isset($_POST['prfx_nonce']) && wp_verify_nonce($_POST['prfx_nonce'], basename(__FILE__)) ) ? 'true' : 'false';

  // Exits script depending on save status
  if ($is_autosave || $is_revision || !$is_valid_nonce) {
    return;
  }

// Checks for input and saves - save checked as yes and unchecked at no
  if (isset($_POST['featured-checkbox-emirates-review'])) {
    update_post_meta($post_id, 'featured-checkbox-emirates-review', 'yes');
  } else {
    update_post_meta($post_id, 'featured-checkbox-emirates-review', 'no');
  }
}

add_action('save_post', 'emirates_review_meta_save');
/**
 *  Meta Box Module end
 */
add_action('add_meta_boxes', 'cd_meta_box_add_emirates_review');

function cd_meta_box_add_emirates_review() {
  add_meta_box('emirates-magazine', 'Add Emirates Review Magazine', 'emirates_review_pdf_cb', 'fh_emirates_review', 'normal', 'high');
}

function emirates_review_pdf_cb() {
  // $post is already set, and contains an object: the WordPress post
  global $post;
  $values = get_post_custom($post->ID);

  //print_r($values);
  $emirates_pdf_url = isset($values['emirates_pdf']) ? $values['emirates_pdf'] : '';
  $emirates_pdf_url_ar = isset($values['emirates_pdf_ar']) ? $values['emirates_pdf_ar'] : '';
  // We'll use this nonce field later on when saving.
  wp_nonce_field('my_meta_box_nonce', 'meta_box_nonce');
  ?>
<table>
    <tr valign="top">
    <th scope="row"><label>Upload PDF (English):</label> <span class="error">*</span></th>
    <td>
      <input id="emirates_pdf" type="text" value="<?php echo $emirates_pdf_url[0]; ?>" name="emirates_pdf" />
      <button type="button" id="upload-button-fh" class="button" ><span class="dashicons dashicons-admin-media"></span> Add PDF</button>
    </td>
  </tr>  
  <br>
  <tr valign="top">
    <th scope="row"><label>Upload PDF (Arabic):</label> <span class="error">*</span></th>
    <td>
      <input id="emirates_pdf_ar" type="text" value="<?php echo $emirates_pdf_url_ar[0]; ?>" name="emirates_pdf_ar" />
      <button type="button" id="upload-button-fh-ar" class="button" ><span class="dashicons dashicons-admin-media"></span> Add PDF</button>
    </td>
  </tr>            
</table>

  <?php
}

add_action('save_post', 'cd_meta_box_emirates_review_save');

function cd_meta_box_emirates_review_save($post_id) {
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
  if (isset($_POST['emirates_pdf']))
    update_post_meta($post_id, 'emirates_pdf', wp_kses($_POST['emirates_pdf'], $allowed));

  if (isset($_POST['emirates_pdf_ar']))
    update_post_meta($post_id, 'emirates_pdf_ar', wp_kses($_POST['emirates_pdf_ar'], $allowed));


  
}

function getAllMagazines($no) {
  global $wpdb;

  $args_post = array(
      'numberposts' => -1,
      'child_of' => 0,
      'orderby' => 'meta_value',
      'meta_key' => 'fh_emirates_review_startdate',
      'order' => 'DESC',
      'post_type' => 'fh_emirates_review',
      'post_status' => 'publish',
      // 'posts_per_page' => 10,
      // 'paged' => get_query_var('paged') ? get_query_var('paged') : 1
  );
  $arg_post_data = get_posts($args_post);

  return $arg_post_data;
}

//Displays latest issue
function displayEmiratesL() {
  $args_post = array(
   'numberposts' => 1,
    'post_type' => 'fh_emirates_review',
    'orderby'   => 'meta_value',
    'meta_key'  => 'fh_emirates_review_startdate',
    'order'     => 'DESC',
    'post_status' => 'publish',
  );
  $arg_post_data = get_posts($args_post);
	if ($arg_post_data) {
    foreach ($arg_post_data as $post_data) {
      $each_faq = (array) $post_data;
      $postvalues = get_values_from_array($each_faq,50,50,7,'fh_emirates_review_startdate','emirates_pdf');
      echo '<div class="col-md-5 emiSliderLeft">
              <h1>'.custom_translate('LATEST ISSUE','العدد الأخير').'</h1>
              <p class="date">'.custom_translate('Date:','التاريخ:').custom_translate($postvalues['date'],$postvalues['date_ar']).'</p>
              <p>'.$postvalues['content'].'</p>
            </div>
            <div class="col-md-7 emiSliderRight">
              <div class="sliderimg"><img src="'.INC_URL_IMG.DS.'emirates-review_slider_img.jpg" alt="emirates_latest_issue">  
             <div class="emirates_button"><p><a href="' . $postvalues['download_url'] . '" class="btn btn-primary" role="button" download><span>'.custom_translate('Download','تحميل').'</span></a> <a href="' . $postvalues['download_url'] . '" class="btn btn-default fancybox-pdf" role="button"><span>' . custom_translate('Read','اقرأ') . '</span></a></p></div>
          	  </div>
            </div>';
      break;
    }
	}
}
add_shortcode('latest-emirates', 'displayEmiratesL');

/*Display Latest Emirates Review Mag on the ABout Us Page*/
function displayEmiratesAbt() {
       
        $args_post = array(
         'numberposts' => -1,
          'post_type' => 'fh_emirates_review',
          'orderby'   => 'meta_value',
        'meta_key'  => 'fh_emirates_review_startdate',
        'order'     => 'DESC',
        'post_status' => 'publish',
        );
    $arg_post_data = get_posts($args_post);
    $counter = 1;
    echo '<div class="welcome-text investor-relation"><div class="col-md-12 board-director-list">';
    echo '<div class="arrow left-investor-arrow"><a href="#" onclick="return false;" class="next_v2"><img src="' . INC_URL_IMG . DS . 'left_arrow_inv.png" alt=""></a></div>';
    echo '<ul class="list-inline" id="aboutus-emirates-slider">';
		if ($arg_post_data) {
        $counter = 1;
        foreach ($arg_post_data as $post_data) {
            setup_postdata($post_data);
            $each_faq = (array) $post_data;
            $id = $each_faq['ID'];
            $post_title = $each_faq['post_title'];
            $post_content = $each_faq['post_content'];
            $customurl = $each_faq['guid'];
            $custom = get_post_custom($id); 
            $download_url = custom_translate($custom['emirates_pdf'][0],$custom['emirates_pdf_ar'][0]);
            $featured = $custom['featured-checkbox'][0];
            $sd = $custom["fh_emirates_review_startdate"][0];          
            $gmts = date('jS F Y', $sd);    // eng date
            $gmts_ar = trans(transfullmonth(date('d F Y', $sd))); //arabic date
            if(wp_get_attachment_url( get_post_thumbnail_id($id))){
             $feat_image = wp_get_attachment_url( get_post_thumbnail_id($id));
             $feat_image_url ='<img src="'.$feat_image.'"  alt=""/>';
            }else{
                $feat_image = INC_URL_IMG . DS . 'fhs_form_img.png';
                $feat_image_url ='<img src="'.$feat_image.'" alt=""/>';
            }
            $arrowurl =  INC_URL_IMG . DS . 'aarrow-brown.png';
           echo '<li>
      <div class="investoricon">'.$feat_image_url.'</div>
      <h1><a href="' . $download_url . '">' . trimcontent($post_title,custom_translate(55,80)) . '</a></h1>';
            echo '<div class="description">' . trimcontent($post_content,custom_translate(65,150)) . '</div>';
            //echo '<a href="' . $customurl . '" class="readmore_investor_slider">'.READMORE.'</a>';
            echo "</li>";
      }
	}
    echo '</ul>';
    echo '<div class="arrow right-investor-arrow"> <a href="#" onclick="return false;" class="prev_v2"><img src="' . INC_URL_IMG . DS . 'right_arrow_inv.png" alt=""></a>
                        </div>
                </div>
                </div>';
    $counter++;
	}
add_shortcode('abt-latest-emirates', 'displayEmiratesAbt');

function displayEmiratesAll() {
  if (isset($_GET['month']) || isset($_GET['yr'])) {
    $arg_post_data = get_Month_Years_data('fh_emirates_review_startdate','fh_emirates_review');
  } else {
    $arg_post_data = getAllMagazines(-1);
  }

  if ($arg_post_data) {
      if((isset($_GET['month']) || isset($_GET['yr']))){
      $counter = 1;
      }else{
        $counter = 0;
      }
    foreach ($arg_post_data as $post_data) {
      
	   if($counter != 0){
      $each_faq = (array) $post_data;
      $postvalues = get_values_from_array($each_faq,10,10,7,'fh_emirates_review_startdate','emirates_pdf');
      $details .= '<div class="col-sm-6 col-md-4">';
      $details .= '<div class="thumbnail">';
      $details .= '<img src="'.$postvalues['feat_image'].'" alt="emirates review magazine">';
      $details .= '<div class="caption">';
      $details .= '<div class="emirates_contents"><h3>'.$postvalues['content'].'</h3>';
      $details .= '<span>'.custom_translate('Date','تاريخ'). ':' .custom_translate($postvalues['date'],$postvalues['date_ar']). '</span></div>';
      $details .= '<div class="emirates_button"><p><a href="' . $postvalues['download_url'] . '" class="btn btn-primary" role="button" download><span>'.custom_translate('Download','تحميل').'</span></a> <a href="' . $postvalues['download_url'] . '" class="btn btn-default fancybox-pdf" role="button"><span>' . custom_translate('Read','اقرأ') . '</span></a></p></div>';
      $details .= '</div></div></div>';
      
      }
      $counter++;
    }
    //$details .= emiratespagination(totalPostsEmirates());
    echo $str .= $details;
    //echo $str = $cat_name;
  } else {

    $coming = custom_translate('Coming Soon', 'قريبا');
    $details = '<div class="pastEvtContainer coming">' . $coming . '</div>';
    echo $details;
  }
}

add_shortcode('all-emiratesmagazines', 'displayEmiratesAll');

function totalPostsEmirates() {

  global $wpdb;

  $args_post1 = array(
      'numberposts' => -1,
      'post_type' => 'fh_emirates_review',
      'post_status' => 'publish'
  );
  $arg_post_data1 = get_posts($args_post1);

  return count($arg_post_data1);
}

// function emiratespagination($totalposts,$arabicpageurl){

//   $big = 999999999; // need an unlikely integer
//   $details1 .= ' <div class="paginationContainer text-center">';            
//   $totalcount  = ceil($totalposts / 10);
//   //echo str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) );
//   $pages = paginate_links( array(

//       'base' => custom_translate(str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),SITE_URL.'/ar/section/about-us/emirates-review-1%_%'),
//       'format' => '?paged=%#%',
//       'current' => max( 1, get_query_var('paged') ),
//       'total' => $totalcount,
//       'prev_next' => false,
//       'type'  => 'array',
//       'prev_next'   => TRUE,
//       'prev_text'    => __('previous'),
//       'next_text'    => __('next'),
//   ) );

//   if( is_array( $pages ) ) {
//    //   $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
//       $details1.= '<ul class = "pagination">';
//           foreach ( $pages as $page ){
//               $details1 .= "<li>$page</li>";
//           }                                
//      $details1 .= '</ul>';
//   }

//    $details1 .= '</nav></div></div></div>';
//   return $details1;
// }
?>
