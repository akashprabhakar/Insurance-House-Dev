<?php
/*
  Plugin Name: FH Executive management
  Plugin URI: http://www.annet.com/
  Description: Executive management
  Author: Annet #2049
  Version: 1.0
  Author URI: http://www.annet.com/
 */

add_action('init', 'executive_management_custom_post_type');

/**
 * Registers a Custom Post Type called contact
 */
function executive_management_custom_post_type() {
  register_post_type('executive-management', array(
      'labels' => array(
          'name' => _x('Executive Management', 'post type general name', 'tuts-crm'),
          'singular_name' => _x('Executive Management', 'post type singular name', 'tuts-crm'),
          'menu_name' => _x('Executive Management', 'admin menu', 'tuts-crm'),
          'name_admin_bar' => _x('Executive Management', 'add new on admin bar', 'tuts-crm'),
          'add_new' => _x('Add New', 'executive-management', 'tuts-crm'),
          'add_new_item' => __('Add New Executive Management', 'tuts-crm'),
          'new_item' => __('New Executive Management', 'tuts-crm'),
          'edit_item' => __('Edit Executive Management', 'tuts-crm'),
          'view_item' => __('View Executive Management', 'tuts-crm'),
          'all_items' => __('Executive Management', 'tuts-crm'),
          'search_items' => __('Search Executive Management', 'tuts-crm'),
          'parent_item_colon' => __('Parent executive-management:', 'tuts-crm'),
          'not_found' => __('No Executive Management found.', 'tuts-crm'),
          'not_found_in_trash' => __('No Executive Management found in Trash.', 'tuts-crm'),
      ),
      // Frontend
      'has_archive' => true,
      'public' => true,
      'publicly_queryable' => true,
      // Admin
      'capability_type' => 'post',
      'menu_icon' => 'dashicons-businessman',
      'menu_position' => 10,
      'query_var' => true,
      'show_in_menu' => true,
      'show_ui' => true,
      'supports' => array(
          'title',
          'author',
          'editor',
          'thumbnail',
          'excerpt',
          'custom-fields'
      ),
          )
  );
  add_theme_support('post-thumbnails');
}

function getexecutivemanagement() {
  global $post;
  $type = 'executive-management';

  global $wpdb;
  
  $args_post = array(
      'numberposts' => -1,
      'post_type' => 'executive-management',
      'post_status' => 'publish',
	  'orderby' => 'ID',
	  'order' => 'ASC'
  );
  $survey_page = get_posts($args_post);
  ?>

  <?php
  $html = ' <div class="board-directors-block welcome-text">                                  
                    <div class="col-md-12 board-director-list">';
  $html.= ' <div class="arrow left-arrow"><a href="#" onclick="return false;" class="next"><img src="'.INC_URL_IMG . DS . 'left_arrow.png" alt=""></a></div>
  <ul class="list-inline" id="owl-demo2">';

  foreach ($survey_page as $value) {
    $executive_management = get_post_meta($value->ID, 'exec_manag_meta_box_info', true);
    $executive_management_ar = get_post_meta($value->ID, 'exec_manag_meta_box_info_ar', true);
    $designation = custom_translate($executive_management, $executive_management_ar);
    $url_bod = SITE_URL . '/executive-management/' . $value->post_name;
    $url = wp_get_attachment_url(get_post_thumbnail_id($value->ID));
      $html.= '<li><img alt="" src="'.$url.'">';
      $html.= '<h3>'.$value->post_title.'</h3>';
      $html.='<h4>'.$designation.'</h4>';
      $html.='</li>';                        
  }
  $html .='</ul>
                        <div class="arrow right-arrow">
                          <a href="#" onclick="return false;" class="prev"><img src="'.INC_URL_IMG . DS . 'right_arrow.png" alt=""></a>
                        </div>
                </div>
                </div>  
';

  return $html;
}

add_shortcode('get-executive-management', 'getexecutivemanagement');

/* 1742 Executive Management */
add_action('add_meta_boxes', 'create_executive_management_meta_boxes');

function create_executive_management_meta_boxes() {
  add_meta_box('my-meta-box-id', __('Executive Management'), 'exec_manag_meta_box_info', 'executive-management', 'normal', 'high');
}

// Create meta box: Additional information
function exec_manag_meta_box_info($post) {

  $values = get_post_custom($post->ID);

  wp_nonce_field('my_meta_box_nonce', 'meta_box_nonce');
  ?>
    <?php $text = get_post_meta($post->ID, 'exec_manag_meta_box_info', true);
    $text_ar = get_post_meta($post->ID, 'exec_manag_meta_box_info_ar', true);
    ?>

    <p>        <label for="news_title_text">English</label>
      <input type="text" name="exec_manag_meta_box_info" id="exec_manag_meta_box_info" value="<?php echo $text; ?>">
    </p>

    <p>
      <label for="news_title_text">Arabic</label>
      <input type="text" name="exec_manag_meta_box_info_ar" id="exec_manag_meta_box_info_ar" value="<?php echo $text_ar; ?>">
    </p>
  <?php
}

// Save meta box: Additional information

add_action('save_post', 'save_exec_manag_meta_box_info');

function save_exec_manag_meta_box_info($post_id) {

  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
    return;

  if (!isset($_POST['meta_box_nonce']) || !wp_verify_nonce($_POST['meta_box_nonce'], 'my_meta_box_nonce'))
    return;

  if (!current_user_can('edit_post'))
    return;

  $allowed = array(
      'a' => array(// on allow a tags
          'href' => array() // and those anchords can only have href attribute
      )
  );

  if (isset($_POST['exec_manag_meta_box_info']))
    update_post_meta($post_id, 'exec_manag_meta_box_info', wp_kses($_POST['exec_manag_meta_box_info'], $allowed));


  if (isset($_POST['exec_manag_meta_box_info_ar']))
    update_post_meta($post_id, 'exec_manag_meta_box_info_ar', wp_kses($_POST['exec_manag_meta_box_info_ar'], $allowed));

  $chk = ( isset($_POST['exec_manag_meta_box_info_rotation']) && $_POST['exec_manag_meta_box_info_rotation'] ) ? 'on' : 'off';

  update_post_meta($post_id, 'exec_manag_meta_box_info_rotation', $chk);
}

/* 1742 Executive Management */