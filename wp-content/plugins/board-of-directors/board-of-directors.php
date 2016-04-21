<?php
/*
  Plugin Name: Board of directors
  Plugin URI: http://www.annet.com/
  Description: Board of directors
  Author: Annet #2049
  Version: 1.0
  Author URI: http://www.annet.com/
 */

add_action('init', 'register_custom_post_type');

/**
 * Registers a Custom Post Type called contact
 */
function register_custom_post_type() {
  register_post_type('board-of-directors', array(
      'labels' => array(
          'name' => _x('Board of Directors', 'post type general name', 'tuts-crm'),
          'singular_name' => _x('Board of Directors', 'post type singular name', 'tuts-crm'),
          'menu_name' => _x('Board OF Directors', 'admin menu', 'tuts-crm'),
          'name_admin_bar' => _x('Board of Directors', 'add new on admin bar', 'tuts-crm'),
          'add_new' => _x('Add New', 'board-of-directors', 'tuts-crm'),
          'add_new_item' => __('Add New Board of Directors', 'tuts-crm'),
          'new_item' => __('New Board of Directors', 'tuts-crm'),
          'edit_item' => __('Edit Board of Directors', 'tuts-crm'),
          'view_item' => __('View Board of Directors', 'tuts-crm'),
          'all_items' => __('Board of Directors', 'tuts-crm'),
          'search_items' => __('Search Board of Directors', 'tuts-crm'),
          'parent_item_colon' => __('Parent board-of-directors:', 'tuts-crm'),
          'not_found' => __('No Board of Directors found.', 'tuts-crm'),
          'not_found_in_trash' => __('No Board of Directors found in Trash.', 'tuts-crm'),
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
      // 'show_in_menu' => 'annet-fhg-capm-all/index.php',
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

// function getBoardOfDirectors() {
  // global $post;
  // // $type = 'board-of-directors';

  // global $wpdb;
  // $args_post = array(
      // 'numberposts' => -1,
      // 'post_type' => 'board-of-directors',
      // 'post_status' => 'publish',
  // );
  // $survey_page = get_posts($args_post);

  // $html = '<div class="boarddirectorBoxes">';
  // foreach ($survey_page as $value) {
    // $board_of_directors = get_post_meta($value->ID, 'meta_box_info', true);
    // $board_of_directors_ar = get_post_meta($value->ID, 'meta_box_info_ar', true);
    // $designation = custom_translate($board_of_directors, $board_of_directors_ar);
    // $url_bod = SITE_URL . '/board-of-directors/' . $value->post_name;

    // $url = wp_get_attachment_url(get_post_thumbnail_id($value->ID));
    // $profile_name = $value->post_title;
    // $html .='<div class="profilecontainer">
          // <div class="profilePic"><img src="' . $url . '" alt="' . $profile_name . '"></div>
          // <div class="name">' . $profile_name . '</div>
          // <div class="place">' . $designation . '</div>
        // </div> ';
  // }
  // $html .= "</div>";
  // return $html;
// }


function getBoardOfDirectors() {
  global $post;
  $type = 'board-of-directors';

  global $wpdb;
  
  $args_post = array(
      'numberposts' => -1,
      'post_type' => 'board-of-directors',
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
    $board_of_directors = get_post_meta($value->ID, 'meta_box_info', true);
    $board_of_directors_ar = get_post_meta($value->ID, 'meta_box_info_ar', true);
    $designation = custom_translate($board_of_directors, $board_of_directors_ar);
    $url_bod = SITE_URL . '/board-of-directors/' . $value->post_name;

    $url = wp_get_attachment_url(get_post_thumbnail_id($value->ID));
    $profile_name = $value->post_title;
      $html.= '<li><img alt="" src="'.$url.'">';
      $html.= '<h3>'.$profile_name.'</h3>';
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

add_shortcode('get-board-of-directors', 'getBoardOfDirectors');

/* 1742 Board Of Directors */

/* Custom meta boxes */
add_action('add_meta_boxes', 'create_meta_boxes');

function create_meta_boxes() {
  add_meta_box('my-meta-box-id', __('Board Of Directors'), 'meta_box_info', 'board-of-directors', 'normal', 'high');
}

// Create meta box: Additional information
function meta_box_info($post) {
  $values = get_post_custom($post->ID);
  wp_nonce_field('my_meta_box_nonce', 'meta_box_nonce');
  ?>
  <?php
  $text = get_post_meta($post->ID, 'meta_box_info', true);
  $text_ar = get_post_meta($post->ID, 'meta_box_info_ar', true);
  ?>
  <p>
    <label for="news_title_text">English</label>
    <input type="text" name="meta_box_info" id="meta_box_info" value="<?php echo $text; ?>">
  </p>

  <p>
    <label for="news_title_text">Arabic</label>
    <input type="text" name="meta_box_info_ar" id="meta_box_info_ar" value="<?php echo $text_ar; ?>">
  </p>
  <?php
}

// Save meta box: Additional information
add_action('save_post', 'save_meta_box_info');

function save_meta_box_info($post_id) {
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

  if (isset($_POST['meta_box_info']))
    update_post_meta($post_id, 'meta_box_info', wp_kses($_POST['meta_box_info'], $allowed));
  if (isset($_POST['meta_box_info_ar']))
    update_post_meta($post_id, 'meta_box_info_ar', wp_kses($_POST['meta_box_info_ar'], $allowed));

  $chk = ( isset($_POST['meta_box_info_rotation']) && $_POST['meta_box_info_rotation'] ) ? 'on' : 'off';

  update_post_meta($post_id, 'meta_box_info_rotation', $chk);
}

/* 1742 Board Of Directors */