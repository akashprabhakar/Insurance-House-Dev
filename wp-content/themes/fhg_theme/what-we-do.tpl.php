<?php
/**
 * Template Name: What We Do
 * @package WordPress
 * @subpackage Custom Theme
 * @since Custom Theme 1.0
 */
get_header();

/* Start Banner Section */
get_header_banner_image($post->ID, get_the_title());
/* END Banner Section */

/* START Breadcrums Container Section */
get_post_breadcrumbs();
/* END Breadcrums Container Section */

/* START About us Container Section */
$readmore = custom_translate('Read More', 'اقرأ المزيد');
$leftimg = custom_translate('invt-coma.png', 'doublequote_left_ar.png');
$rightimg = custom_translate('invt-coma-1.png', 'doublequote_right_ar.png');

$args = array(
    'post_type' => 'page',
    'meta_key' => '_fhg_lp_post_order',
    'posts_per_page' => 20,
    'meta_query' => array(
        array(
            'key' => '_fhg_lp_post_order',
        ),
        array(
            'key' => '_fhg_lp_name',
            'value' => 'what-we-do',
            'compare' => '='
        ),
    )
);

function customorderby($orderby) {
  return 'mt1.meta_value ASC';
}

add_filter('posts_orderby', 'customorderby');
$getpost = query_posts($args);

remove_filter('posts_orderby', 'customorderby');

$section1 = "";
$section2 = "";
// $section3 = "";
// $section4 = "";
// $section5 = "";
// The Loop
while (have_posts()) : the_post();
  $section = get_post_meta(get_the_ID(), '_fhg_lp_section', true);
  if (!($section == "")) {
    if ($section == 1) {
      $section1 .='<div class="col-lg-16 col-md-16 col-sm-16 col-xs-16 rhs-sec1">
          <a href="' . get_permalink() . '"><h1>' . get_the_title() . '</h1></a>
      </div>
      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-16"></div>
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-16 whatwedoContent">';
      $section1 .= get_the_content_with_formatting(false, 150) . '        
        <a href="' . get_the_guid() . '" class="pull-right read-more"> ' . $readmore . '</a>
      </div>';
    }

    if ($section == 2) {
      $section2 .= '<div class="col-lg-16 col-md-16 col-sm-16 col-xs-16 lhs-sec2">
         <a href="' . get_permalink() . '"> <h1>' . get_the_title() . '</h1></a>
      </div>
      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-16"></div>
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-16 whatwedoContent_lhs">';
      $section2 .= get_the_content_with_formatting(false, 150) . '        
        <a href="' . get_the_guid() . '" class="pull-right read-more"> ' . $readmore . '</a>
      </div> ';
    }
  }
endwhile; // end of the loop.

/* Restore original Post Data */
wp_reset_postdata();

/* Divider */
$divider = '<div class="container"><div class="col-lg-16 col-md-16 col-sm-16 col-xs-16 abt_divider"><img src="' . INC_URL_IMG . DS . 'abtdivider.png' . '" alt="about-us-divider"></div></div>';
?>
<!-- START Mid Container Section -->
<div class="container-fluid">
  <div class="row">
    <div class="container">
      <div class="col-lg-2 col-md-2 col-sm-16 col-xs-16"></div>
      <?php
      if ($section1 != "") {
        echo $section1;
      }
      ?>      
      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-16"></div>
    </div>    
<?php echo $divider; ?>
    <div class="container">
      <div class="col-lg-2 col-md-2 col-sm-16 col-xs-16"></div>
      <?php
      if ($section2 != "") {
        echo $section2;
      }
      ?>
      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-16"></div>
    </div>
<?php echo $divider; ?>
  </div>    
</div>

<!-- END Mid Container Section --> 
<?php get_footer(); ?>