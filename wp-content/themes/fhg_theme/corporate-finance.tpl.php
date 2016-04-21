<?php
/**
 * Template Name: Corporate Finance
 * @package WordPress
 * @subpackage Custom Theme
 * @since Custom Theme 1.0
 */
get_header();

/* Start Banner Section */
get_header_banner_image($post->ID, get_the_title());
/* END Banner Section */

/* START Breadcrums Container Section */
get_primary_breadcrumbs();
/* END Breadcrums Container Section */

/* START About us Container Section */

wp_reset_query();
$readmore = custom_translate('Read More', 'اقرأ المزيد');
$leftimg = custom_translate('invt-coma.png', 'doublequote_left_ar.png');
$rightimg = custom_translate('invt-coma-1.png', 'doublequote_right_ar.png');
$section1 = "";

  $section1 .= '<div class="welcome-text text-center">
      <a href="'.get_permalink().'"><h1>'. get_the_title() .' </h1></a>                       
                    </div>';
      $section1 .='<div class="fhg-column-group leftColmp">
      <img src="'.catch_that_image().'?src=' . catch_that_image() . '&amp;w=200&amp;zc=1"/>';
      $section1 .= get_the_content_with_formatting_trim() . '</div>';

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
            'value' => 'corporate-finance',
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
$hrclass = '<hr class="hr-ruller">';
 $cntr= 1;
  
    
    

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
     <div class="fhg-column-group leftColmp leftColmpProductTab">
     <h1>'.get_the_title().'</h1>';
      $section2 .= get_the_content_with_formatting_trim(true, 60) . 
'<a href="' . get_permalink() . '" class="pull-right readmore investor-relationadmore"> '. $readmore . '</a>'.
      '</div></section>';
       $cntr += 1;
    }

      if($section==3){
       // $section3 .= '<div class="col-md-6 right-side text-justify">
       //                   <a href="'.get_permalink().'"><h2 class="text-left">'. get_the_title() .' </h2></a>
       //                  <div class="directors arrow_box">
       //                    <img src="'.INC_URL_IMG . DS .'invt-coma.png" alt="">'.get_the_content_with_formatting_trim(true, 36) . '<img src="'.INC_URL_IMG . DS .'invt-coma-1.png" alt="">
       //                  </div>
       //                  <a href="' . get_permalink() . '" class="pull-right readmore"> '. $readmore . '</a>
       //                </div>';
                 $section3 .= '<div class="cardContainer">
<img src="'.catch_that_image('featured').'?src=' . catch_that_image('featured') . '&amp;w=200&amp;zc=1"/>
<h1><a href="'.get_permalink().'">'. get_the_title() .'</a></h1>
<p>'.get_the_content_with_formatting_trim(true, 25).'</p>
<a href="' . get_permalink() . '" class="readcard readmore"> '. $readmore . '</a>
</div>';

    }

    if($section==4){
      $section4 .= '<div class="welcome-text text-center">
      <a href="'.get_permalink().'"><h1>'. get_the_title() .' </h1></a>                       
                    </div>';
      $section4 .='<div class="fhg-column-group leftColmp">
      <img src="'.catch_that_image().'?src=' . catch_that_image() . '&amp;w=200&amp;zc=1"/>';
      $section4 .= get_the_content_with_formatting_trim(true, 35).'        
        <a href="' . get_permalink() . '" class="pull-right readmore"> '. $readmore . '</a></div>';      
    }

    if($section==5){
       $section5 .= '<div class="boxLCol">
        <div> 
          <a href="'.get_permalink().'"><h2>'. get_the_title() .' </h2></a>
          <img src="'.catch_that_image('featured').'?src=' . catch_that_image('featured') . '&amp;w=200&amp;zc=1"/>
        </div> ';
      $section5  .= get_the_content_with_formatting_trim(true, 18) . 
        '<a href="' . get_permalink() . '" class="pull-right readmore"> '. $readmore . '</a>
        </div>';
    }

   }
endwhile; // end of the loop.
?>

<section id="content-area">
      <div class="container">
          <div class="row">
              <div class="innerpage">

 <?php 
            if($section1!=""){ 
              echo $section1;
              echo $hrclass;            
            }

                      if($section2!=""){ 
                  echo '<div class="productcontainer investorcontainer">
      <ul class="nav-inv nav-tabs-inv">';
             echo $section_top;
     echo '</ul>';
              echo $section2;
               echo $hrclass.'</div>';
                  }

            
            echo '<div class="credit_cards"><div class="fhg-column-group creditContainer innerpage"><div class="Bluelastontainer csfprice"><div class="BluethreecardsContainers">';
            if($section3!=""){ 
              echo $section3; 
              echo $hrclass;          
            }
            echo "</div></div></div></div>";
      
              if($section4!=""){ 
              echo $section4;
              echo $hrclass;    
                      
            }
               if($section5!=""){ 
              echo '<div class="fhg-column-group fareport">' . $section5  .'</div>';
                      
            }
            
        ?>
             
    </div>
   
    <?php

              echo $hrclass;             
        
          ?>
  </div>  
            </div>
        </div>
    </section>
<?php get_footer(); ?>