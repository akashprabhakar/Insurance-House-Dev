<?php
/**
 * Template Name: Financial
 * @package WordPress
 * @subpackage FHG FH Theme
 * @since FHG FH Theme 1.0
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
$learnmore = custom_translate('Learn More', 'أعر�? أكثر');

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
            'value' => 'financial',
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

$section1 = "";
$section2 = "";
$section3 = "";
$section4 = "";
$section5 = "";
$hrclass = '<hr class="hr-ruller">';
$default_img = INC_URL_IMG . DS . 'blankImg1.jpg';
// $count = 1;

while (have_posts ()) : the_post();

  $section = get_post_meta( get_the_ID(), '_fhg_lp_section', true );
  if(!($section=="")){
    if($section==1){
      $section1 .= '<div class="center wow">'.get_the_content(false).'</div>';
    }

  if($section==2){ 
      $section2 .= '<span class="ccf_arrow_leftOne"></span><img alt="" src="' . catch_that_image('featured-large') . '"/>
                    <h1><a href="'.get_permalink().'">'. get_the_title() .'</a></h1>';
      $section2 .= '<p>'.get_the_content_with_mytrim(get_the_content(),custom_translate(17,15)) . '</p>
                    <div class="ccf_learmore"><a href="' . get_permalink() . '" class="readmore"> '. $learnmore . '</a></div>';
  }
 if($section==3){
      $section3 .= '<span class="ccf_arrow_rightTwo"></span><img alt="" src="' . catch_that_image('featured-large') . '"/>
                    <h1><a href="'.get_permalink().'">'. get_the_title() .'</a></h1>';
      $section3  .= '<p>'.get_the_content_with_mytrim(get_the_content(),custom_translate(17,15)) . '</p>
                    <div class="ccf_learmore"><a href="' . get_permalink() . '" class="readmore"> '. $learnmore . '</a></div>';  
    }
	if($section==4){
      $section4 .= '<span class="ccf_arrow_threeThree"></span><img alt="" src="' . catch_that_image('featured-large') . '"/>
                    <h1><a href="'.get_permalink().'">'. get_the_title() .'</a></h1>';
      $section4  .= '<p>'.get_the_content_with_mytrim(get_the_content(),custom_translate(17,15)) . '</p>
                    <div class="ccf_learmore"><a href="' . get_permalink() . '" class="readmore"> '. $learnmore . '</a></div>';  
    }

  if($section==5){
    $section5 .= '<img alt="" src="'.id_only_post_image(get_the_ID()).'"/>
                  <h1><a href="'.get_permalink().'">'. get_the_title() .'</a></h1>';
    $section5  .= get_the_content_with_mytrim(get_the_content(),custom_translate(40,15)) . '
                  <div class="pt_learmore"><a href="' . get_permalink() . '" class="readmore"> '. $learnmore . '</a></div>';  
  }

  if($section==6){
    $section6 .= '<img alt="" src="'.id_only_post_image(get_the_ID()).'"/>
                  <h1><a href="'.get_permalink().'">'. get_the_title() .'</a></h1>';
    $section6  .= get_the_content_with_mytrim(get_the_content(),custom_translate(17,15)) . '
                  <div class="pt_learmore"><a href="' . get_permalink() . '" class="readmore"> '. $learnmore . '</a></div>';  
  }
  if($section==7){
    $section7 .= '<img alt="" src="'.id_only_post_image(get_the_ID()).'"/>
                  <h1><a href="'.get_permalink().'">'. get_the_title() .'</a></h1>';
    $section7  .= get_the_content_with_mytrim(get_the_content(),custom_translate(17,15)) . '
                  <div class="ccf_commonPage_readmore"><a href="' . get_permalink() . '" class="readmore"> '. $readmore . '</a></div>';  
  }
}
endwhile; // end of the loop.
?>

<!--/#feature-->
<section id="recent-works">
  <div class="container financials_page">
    <?php if($section1!=""){ ?> 
      <div class="center wow"><?php echo $section1; ?></div>
    <?php } ?>

    <div class="row ccf_Boxcontainer">
      <?php if($section2!=""){ ?> 
          <div class="ccf_Boxcontainer_one"><?php echo $section2; ?></div>
      <?php } ?>

      <?php if($section3!=""){ ?> 
          <div class="ccf_Boxcontainer_two"><?php echo $section3; ?> </div>           
      <?php } ?>
                
      <?php if($section4!=""){ ?> 
          <div class="ccf_Boxcontainer_one"><?php echo $section4; ?></div>                        
      <?php } ?>
    </div>

    <div class="row ccf_Twocontainer">
      <?php if($section5!=""){ ?> 
        <div class="ccf_TwocontainerBox"><?php echo $section5; ?></div>                        
      <?php } ?>
      <?php if($section6!=""){ ?> 
        <div class="ccf_TwocontainerBox"><?php echo $section6; ?></div>                        
      <?php } ?>
    </div>

    <div class="ccf_commonPage">
     <?php if($section7!=""){ ?> 
        <div class="ccf_TwocontainerBox"><?php //echo $section7; ?></div>                        
      <?php } ?>
    </div>
  </div>
</section>
<!-- END Mid Container Section --> 
<?php get_footer(); ?>