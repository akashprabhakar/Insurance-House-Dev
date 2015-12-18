<?php
/**
 * Template Name: About Us
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
            'value' => 'about',
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
$section1 = "";
$section2 = "";
$section3 = "";
$section4 = "";
$section5 = "";

    

// The Loop
while (have_posts ()) : the_post();
  $section = get_post_meta( get_the_ID(), '_fhg_lp_section', true );
  if(!($section=="")){
    if($section==1){
		$section1 .= '<div class="col-lg-16 col-md-16 col-sm-16 col-xs-16 innerPageheading"><h1><a href="'.get_the_guid().'">'. get_the_title() .' </a></h1></div>
      <div class="col-lg-2 col-md-2 col-sm-16 col-xs-16"></div>
      <div class="col-lg-12 col-md-12 col-sm-16 col-xs-16 innerpageContent">';
      $section1 .= get_the_content_with_formatting(true, 84) .'        
        <a href="' . get_the_guid() . '" class="pull-right read-more"> '. $readmore . '</a> ';
		$section .= '</div>
      <div class="col-lg-2 col-md-2 col-sm-16 col-xs-16"></div>';
    }

    if($section==2){ 
      // $html_content = wp_trim_words( preg_replace('/(<)([img])(\w+)([^>]*>)/', '', get_the_content()) , 25);
      $html_content = wp_trim_words( get_the_content(), 30);
      $section2 .= '<div class="col-lg-8 col-md-8 col-sm-16 col-xs-16 left-side ">
         <h2 class="text-left"> <a href="' . get_the_guid() . '">'. get_the_title() .' </a></h2>
          <div class="vision arrow_box">
             <p> <span><img src="'. INC_URL_IMG . DS . $leftimg .'" alt=""/></span>
          ' . $html_content . '
            <span><img src="'. INC_URL_IMG . DS . $rightimg .'" alt=""></span></p>  
          </div>
      </div> ';
    }

    if($section==3){ 
      $section3 .= '
      <div class="col-lg-16 col-md-16 col-sm-16 col-xs-16 innerPageheading bod"><h1><a href="'.get_the_guid().'">'. get_the_title() .'</a></h1></div>      
      <div class="col-lg-16 col-md-16 col-sm-16 col-xs-16 innerpageContent boarddirector">' . get_the_content_with_formatting() . '</div>      
    ';
    }

    // if($section==4){
    //   $src = wp_get_attachment_image_src(get_post_thumbnail_id($pageId), false, '');
    //   $section4 .= '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-16 bottomBoxleft">
    //     <div class="boxlable"><a href="' . get_the_guid() . '">'. get_the_title() .'</a></div>';
    //     if(isset($src[0])){
    //       $section4 .= '<img src="' . $src[0] . '" width="440" height="240" />';
    //     }        
    //     $section4 .= '<p>' . wp_trim_words( get_the_content(), 20) . '</p>
    //     <p class="readmore"><a href="' . get_the_guid() . '">'. $readmore . '</a></p>
    //   </div>';
    // }
  }
endwhile; // end of the loop.

/* Restore original Post Data */
wp_reset_postdata();
$divider = '<div class="container"><div class="col-lg-16 col-md-16 col-sm-16 col-xs-16 innerpage_divider"><img src="'. INC_URL_IMG . DS . 'abtdivider.png' .'"></div></div>';
?>
<!-- START Mid Container Section -->
<div class="container-fluid">
  <div class="row">
    <div class="container">    
      
        <?php 
            if($section1!=""){ 
              echo $section1 ;             
            }
          ?>
      
    </div>
    <?php echo $divider; ?>              
  <div class="container">
        <div class="col-lg-2 col-md-2 col-sm-16 col-xs-16"></div>
        <div class="col-lg-12 col-md-12 col-sm-16 col-xs-16 vision-directors innerpage ">
            <?php
              if($section2!=""){ 
                echo $section2;
              }
            ?>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-16 col-xs-16"></div>
    </div>
    <?php echo $divider; ?>            
    <div class="container">
        <?php
          if ($section3!=""){
            echo $section3;
          }  
        ?>
    </div>    
    <?php echo $divider; ?>
  </div>
    
  </div>
</div>
<!-- END Mid Container Section --> 
<?php get_footer(); ?>