<?php
/*
Plugin Name: Blog
Plugin URI: http://www.annet.com
Description: Blog Plugin
Version: 0.1
Author: Annet
Author URI: http://www.annet.com
License: GPLv2 or later
*/




/**
 * Meta Box For Adding Location for the news in arabic ..(1846)
 */
add_action( 'admin_init', 'fhg_blog_create' );

function fhg_blog_create() {
    add_meta_box('fhg_blog_meta', 'Blog', 'fhg_blog_meta', 'post');
}

function fhg_blog_meta () {

    // - grab data -

    global $post;
    $custom = get_post_custom($post->ID);
    $meta_sd = $custom["fhg_blog_startdate"][0];
    $meta_st = $meta_sd;

    $date_format = get_option('date_format'); // Not required in my code
    $time_format = get_option('time_format');

    // - populate today if empty, 00:00 for time -

    if ($meta_sd == null) { $meta_sd = time(); $meta_ed = $meta_sd; $meta_st = 0; $meta_et = 0;}

    // - convert to pretty formats -

    $clean_sd = date("D, M d, Y", $meta_sd);
    $clean_st = date($time_format, $meta_st);
  

    // - security -

    echo '<input type="hidden" name="tf-events-nonce" id="tf-events-nonce" value="' .
    wp_create_nonce( 'tf-events-nonce' ) . '" />';

    // - output -

    ?>
    <div class="tf-meta">
        <ul>
            <li><label>Blog Published Date</label><input name="fhg_blog_startdate" class="tfdate" value="<?php echo $clean_sd; ?>" /></li>
            
        </ul>
    </div>
    <?php
}

// 5. Save Data

add_action ('save_post', 'save_fhg_blog');

function save_fhg_blog(){

    global $post;

    // - still require nonce

    if ( !wp_verify_nonce( $_POST['tf-events-nonce'], 'tf-events-nonce' )) {
        return $post->ID;
    }

    if ( !current_user_can( 'edit_post', $post->ID ))
        return $post->ID;

    // - convert back to unix & update post

    if(!isset($_POST["fhg_blog_startdate"])):
        return $post;
        endif;
        $updatestartd = strtotime ( $_POST["fhg_blog_startdate"] . $_POST["fhg_blog_starttime"] );
        update_post_meta($post->ID, "fhg_blog_startdate", $updatestartd );
}

// 7. JS Datepicker UI

function fhg_blog_styles() {
    global $post_type;
    if( 'fhg_events' != $post_type )
        return;
    wp_enqueue_style('ui-datepicker', get_bloginfo('template_url') . '/css/jquery-ui-1.8.9.custom.css');
}

function fhg_blog_scripts() {
    global $post_type;
    if( 'fhg_events' != $post_type )
    return;
    wp_enqueue_script('jquery-ui', get_bloginfo('template_url') . '/js/jquery-ui-1.8.9.custom.min.js', array('jquery'));
    wp_enqueue_script('ui-datepicker', get_bloginfo('template_url') . '/js/jquery.ui.datepicker.min.js');
    wp_enqueue_script('custom_script', get_bloginfo('template_url').'/js/pubforce-admin.js', array('jquery'));
}

add_action( 'admin_print_styles-post.php', 'fhg_blog_styles', 1000 );
add_action( 'admin_print_styles-post-new.php', 'fhg_blog_styles', 1000 );

add_action( 'admin_print_scripts-post.php', 'fhg_blog_scripts', 1000 );
add_action( 'admin_print_scripts-post-new.php', 'fhg_blog_scripts', 1000 );


add_action( 'add_meta_boxes', 'cd_meta_box_blog_title_ar' );
function cd_meta_box_blog_title_ar()
{
    add_meta_box( 'title-box', 'Add Blog Title', 'blog_title_cb', 'post', 'normal', 'high' );
}
function blog_title_cb()
{
    // $post is already set, and contains an object: the WordPress post
    global $post;
    $values = get_post_custom( $post->ID );


    $blogenglish = isset( $values['blog_title_text'] ) ? $values['blog_title_text'] : '';
    $blogarabic = isset( $values['blog_title_text_ar'] ) ? $values['blog_title_text_ar'] : '';

 
     
    // We'll use this nonce field later on when saving.
    wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
    ?>
    <p>
        <label for="blog_title_text">English</label>
        <input type="text" name="blog_title_text" id="blog_title_text" value="<?php echo $newsenglish[0]; ?>" />
    </p>
    <p>
        <label for="blog_title_text_ar">Arabic</label>
        <input type="text" name="blog_title_text_ar" id="blog_title_text_ar" value="<?php echo $blogarabic[0]; ?>" />
    </p>
     
 
    <?php    
}

add_action( 'save_post', 'blog_title_save' );
function blog_title_save( $post_id )
{
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
     
    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;
     
    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post' ) ) return;
     
    // now we can actually save the data
    $allowed = array( 
        'a' => array( // on allow a tags
            'href' => array() // and those anchors can only have href attribute
        )
    );
     
    // Make sure your data is set before trying to save it
    if( isset( $_POST['blog_title_text'] ) )
        update_post_meta( $post_id, 'blog_title_text', wp_kses( $_POST['blog_title_text'], $allowed ) );

     if( isset( $_POST['blog_title_text_ar'] ) )
        update_post_meta( $post_id, 'blog_title_text_ar', wp_kses( $_POST['blog_title_text_ar'], $allowed ) );
         
    
}
?>
<?php 

function totalblogPosts(){
    
     global $wpdb;

    $args_post1 = array(
        'numberposts' => -1,
        'child_of' => 0,
        'orderby' => 'title',
        'order' => 'ASC',
        'post_type' => 'post',
        'post_status' => 'publish'



        );
    $arg_post_data1 = get_posts($args_post1);

    return count($arg_post_data1);
}

function getblogPosts($no){
    
     global $wpdb;

    $args_post = array(
        'numberposts' => $no,
        'child_of' => 0,
        'orderby'   => 'meta_value',
        'meta_key'  => 'fhg_blog_startdate',
        'order'     => 'DESC',
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' =>10, 
        'paged' => get_query_var('paged') ? get_query_var('paged') : 1



        );
    $arg_post_data = get_posts($args_post);

    return $arg_post_data;
}

/**
 * Code to display all events based on the category(year) ..
 * Done by (1846)
 */
function displayBlogs() {

    if (isset($_GET['month']) || isset($_GET['yr'])) {

      if (isset($_GET['month']) && !empty($_GET['month'])) {
        $monthval = $_GET['month'];

        global $wpdb;
        $sq = "SELECT * FROM $wpdb->postmeta WHERE DATE_FORMAT( FROM_UNIXTIME(  `meta_value` ) ,  '%b' ) =  '$monthval' AND meta_key =  'fhg_blog_startdate'";
        $months1 = $wpdb->get_results($sq);

        foreach ($months1 as $month) {
          $monthval1 = $month->post_id;
          $postidarr[] = $month->post_id;
        }

        $args = array(
              'numberposts' => -1,
              'orderby'   => 'meta_value',
              'meta_key'  => 'fhg_blog_startdate',
              'order'     => 'DESC',
              'post_type' => 'post',
              'post__in' => $postidarr,
              'post_status' => 'publish',
              'posts_per_page' => 10, 
              'paged' => get_query_var('paged') ? get_query_var('paged') : 1
        );
        $arg_post_data = get_posts($args);
        $totalposts = totalBPosts_mon_yrs($postidarr);            
      }

        if (isset($_GET['yr']) && !empty($_GET['yr'])) {

          $yearval = $_GET['yr'];
          global $wpdb;
          $sq = "SELECT * FROM $wpdb->postmeta WHERE DATE_FORMAT( FROM_UNIXTIME(  `meta_value` ) ,  '%Y' ) =  '$yearval' AND meta_key =  'fhg_blog_startdate'";

          $years1 = $wpdb->get_results($sq);

          foreach ($years1 as $year) {
            $yearval1 = $year->post_id;
            $postidarr[] = $year->post_id;
          }

          $args = array(
              'numberposts' => -1,
              'orderby'   => 'meta_value',
              'meta_key'  => 'fhg_blog_startdate',
              'order'     => 'DESC',
              'post_type' => 'post',
              'post__in' => $postidarr,
              'post_status' => 'publish',
              'posts_per_page' => 10, 
              'paged' => get_query_var('paged') ? get_query_var('paged') : 1
          );
          $arg_post_data = get_posts($args);
          $totalposts = totalBPosts_mon_yrs($postidarr);  
          
        }
      } else {
        $arg_post_data = getblogPosts(-1);
        $totalposts =  totalblogPostsEvents();          
      }   //code for sorting posts based on month --(1846)
      


           
              
  if ($arg_post_data) {
    $details .= '<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"></div>';
    $details .= '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 newslistingcontainer">';
    $details .= '<div class="pastEvtContainer"><ul>';

    $counter = 0;
    foreach ($arg_post_data as $post_data) {
      $each_faq = (array) $post_data;
      $postvalues = get_values_from_array($each_faq,10,10,30,'fhg_blog_startdate');
      $num_comments = get_comments_number();
      if ( $num_comments == 0 ) {
          $comments = __('0 Comments');
      } elseif ( $num_comments > 1 ) {
          $comments = $num_comments . __(' Comments');
      } else {
          $comments = __('1 Comment');
      }
      $postvalues_title = $postvalues['title'];
      $postvalues['content'] .= '...</p><p><a href="#">'. $comments.'</a> <a href="#">'.getPostViews($postvalues['id']).'</a></p><a class="newslistinglink" href="' . $postvalues['customurl'] . '">' . custom_translate('Read More', 'اقرأ المزيد') . '</a>';

        $details .= '<li><div class="detailpast"><div class="left">';
        $details .= '<img src=' . $postvalues['feat_image'] . ' alt="'.$postvalues_title.'"></div>';
        $details .= '<div class="right"><div class="topborder">&nbsp;</div>';
        $details .= '<div class="venueDate"><span>' . custom_translate('Date', 'تاريخ') . ':</span> <span>' . custom_translate($postvalues['date'], $postvalues['date_ar']) . '</span></div>';
        $details .= '<div class="pastEvtxt"><a href="' . $postvalues['customurl'] . '">' . $postvalues['title1'] . '</a>';
        $details .= '<p>' . $postvalues['content'] . '</div></div></div></li>';

    }
    $details .= '</ul>';

    $details .= '</div></div><div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"></div></div>';

    $details .= eventspagination(totalPostsNews());
    echo $str .= $details;
    //echo $str = $cat_name;
  } else {
    $coming = custom_translate('Coming Soon', 'قريبا');
    $details = '<div class="pastEvtContainer coming">' . $coming . '</div>';
    echo $details;
  }


   
}

add_shortcode('blogs', 'displayBlogs');

function totalblogPostsEvents() {

  global $wpdb;

  $args_post1 = array(
      'numberposts' => -1,
      'post_type' => 'post',
      'post_status' => 'publish'
  );
  $arg_post_data1 = get_posts($args_post1);

  return count($arg_post_data1);
}

function totalBPosts_mon_yrs($postidarr){

    global $wpdb;
    $args = array(
        'numberposts' => -1,
        'post_type' => 'post',
        'post__in' => $postidarr
    );
    $arg_post_data_mon_yr = get_posts($args);

    return count($arg_post_data_mon_yr);

}

function blogpagination($totalposts){

  $big = 999999999; // need an unlikely integer
  $details1 .= ' <div class="paginationContainer text-center">';            
  $totalcount  =  ceil($totalposts / 10);
  $pages = paginate_links( array(

      'base' => custom_translate(str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),SITE_URL.'/ar/مدونة%_%'),
      'format' => '?paged=%#%',
      'current' => max( 1, get_query_var('paged') ),
      'total' => $totalcount,
      'prev_next' => false,
      'type'  => 'array',
      'prev_next'   => TRUE,
      'prev_text'    => __(custom_translate('previous','سابق')),
      'next_text'    => __(custom_translate('next','التالي')),
  ) );

  if( is_array( $pages ) ) {
      $details1.= '<ul class="pagination">';
          foreach ( $pages as $page ){
              $details1 .= "<li>$page</li>";
          }                                
     $details1 .= '</ul>';
  }
  $details1 .= '</div></div>';

  return $details1;
}

function fhg_blogs_deactivate(){
     remove_shortcode('blogs');
}

register_deactivation_hook( __FILE__, 'fhg_blogs_deactivate' );

?>
