<?php
/**
 * Template Name: All Faqs
 * @package WordPress
 * @subpackage Custom Theme
 * @since Custom Theme 1.0
 */
get_header();

/* Start Banner Section */
get_header_banner_image($post->ID, get_the_title());
/* END Banner Section */

/* START Breadcrums Container Section */
get_topnav_breadcrumbs();
/* END Breadcrums Container Section */

/* START About us Container Section */

wp_reset_query();


  $section1 = '<h1 class="content_header">'. get_the_title() .' </h1>';
  $section1 .= get_the_content();

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
            'value' => 'faq',
            'compare' => '='
        ),        
    )
);
function customorderby($orderby) {
  return 'mt1.meta_value ASC';
}
add_filter('posts_orderby','customorderby');
query_posts($args);

remove_filter('posts_orderby','customorderby');
// die();

$section2 = "";
$section3 = "";
$section4 = "";
$section5 = "";
$section_top ="";
$cntr= 1;
$hrclass = '<hr class="hr-ruller">'; ?>
    

<section id="recent-works">
  <div class="container">

<?php 
while (have_posts ()) : the_post();
  $section = get_post_meta( get_the_ID(), '_fhg_lp_section', true );
  if(!($section=="")){
   

   if($section==2){
      if($cntr == 1){
        $class_active = ' active';
         $class_li = ' active';
      } else {
          $class_active = ' hide';
           $class_li = '';
		    }
   
      $section_top .= '<li class="'.$class_li.'">
          <a href="#tab'.$cntr.'">'.get_the_title().'</a>
        </li>';
       $section2 .='<section id="tab'.$cntr.'" class="tab-content'. $class_active.'">
     <div class="fhg-column-group leftColmp leftColmpProductTab">';
      $section2 .= get_the_content_with_formatting(false) . 
	  '</div></section>';
       $cntr += 1;
    }

       }
endwhile; // end of the loop.

    if($section1!=""){ 
      echo $section1;
    }       
   
    if($section2!=""){ 
      echo '<div class="faq-tabGroup"><ul class="nav-faq nav-tabs-faq">';
      echo $section_top;
      echo '</ul></div></div>';
      echo '<div class="container-fluid faq-tab-container"> <div class="container">' . $section2 . '</div>';
    }
  ?>
    
  </div>
</section>

<?php get_footer(); ?>