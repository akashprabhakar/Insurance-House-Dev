<?php
/**
 * Template Name: Personal Finance Landing
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
$applynow = custom_translate('Apply Now', 'قدم الآن');
$readmore = custom_translate('Read More', 'اقرأ المزيد');
$learnmore = custom_translate('Learn More', 'أعر�? أكثر');
$leftimg = custom_translate('invt-coma.png', 'doublequote_left_ar.png');
$rightimg = custom_translate('invt-coma-1.png', 'doublequote_right_ar.png');
$section1 = "";


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
            'value' => 'personal-finance',
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
//$hrclass = '<hr class="hr-ruller">';
    

while (have_posts ()) : the_post();
  $section = get_post_meta( get_the_ID(), '_fhg_lp_section', true );

  if(!($section=="")){
    if($section==1){
      $section1 = get_the_content( );
    }

    if($section==2){ 
      $section2 .= '<span class="ccf_arrow_leftOne"></span><img alt="" src="'.id_only_post_image(get_the_ID()).'"/>
                    <h1><a href="'.get_permalink().'">'. get_the_title() .'</a></h1>';
      $section2 .= '<p>'.get_the_content_with_formatting_trim(get_the_content(),custom_translate(27,15),'','','','',25) . '
                    <div class="ccf_learmore"><a href="' . get_permalink() . '" class="readmore"> '. $learnmore . '</a></div>';
    }
  
    if($section==3){
      $section3 .= '<span class="ccf_arrow_rightTwo"></span><img alt="" src="'.id_only_post_image(get_the_ID()).'"/>
                    <h1><a href="'.get_permalink().'">'. get_the_title() .'</a></h1>';
      $section3  .= '<p>'.get_the_content_with_formatting_trim(get_the_content(),custom_translate(45,15),'','','','',26) . '
                    <div class="ccf_learmore"><a href="' . get_permalink() . '" class="readmore"> '. $learnmore . '</a></div>'; 
    }
  
    if($section==4){
      $section4 .= '<span class="ccf_arrow_threeThree"></span><img alt="" src="'.id_only_post_image(get_the_ID()).'"/>
                    <h1><a href="'.get_permalink().'">'. get_the_title() .'</a></h1>';
      $section4  .= '<p>'.get_the_content_with_formatting_trim(get_the_content(),custom_translate(30,15),'','','','',26) . '
                    <div class="ccf_learmore"><a href="' . get_permalink() . '" class="readmore"> '. $learnmore . '</a></div>';  
    }
	
	 if($section==5){
      $section5 .= '<div class="col-md-6 col-sm-12 col-xs-12 customercontainerimg"><img alt="" src="'.id_only_post_image(get_the_ID()).'"/></div>
                    <div class="col-md-6 col-sm-12 col-xs-12"><h1><a href="'.get_permalink().'">'. get_the_title() .'</a></h1>';
      $section5  .= '<p>'.get_the_content_with_formatting_trim(get_the_content(),custom_translate(50,50),'','','','',40) . '
                    <div class="ccf_commonPage_readmore"><a href="' . get_permalink() . '" class="readmore"> '. $learnmore . '</a></div></div>';  
    }
  }
endwhile; // end of the loop.
?>

<section id="recent-works">
  <div class="container personal_finance_container">
    <?php get_pf_tabs(); ?>

    <?php if($section1!=""){ ?> 
      <div class="center wow"><?php echo $section1; ?></div>
    <?php } ?>
  </div>

  <div class="personal-credit-slider">
    <div class="container">
      <div id="owl-demo" class="owl-carousel">
        <?php if (!dynamic_sidebar(custom_translate('Credit Cards Slider', 'Credit Cards Slider'))) : else : endif; ?>
      </div>
    </div>
  </div>
</section>

<section id="recent-works-personal">
  <div class="container personal_finance_container">
     <div class="row ccf_Boxcontainer">
      <?php if($section2!=""){ ?> 
          <div class="ccf_Boxcontainer_two"><?php echo $section2; ?></div>
      <?php } ?>

      <?php if($section3!=""){ ?> 
          <div class="ccf_Boxcontainer_one"><?php echo $section3; ?> </div>           
      <?php } ?>
                
      <?php if($section4!=""){ ?> 
          <div class="ccf_Boxcontainer_two"><?php echo $section4; ?></div>                        
      <?php } ?>
    </div>
  </div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 col-sm-12 customercontainer">
        <div class="container ">
          <div class="row">
     <?php if($section5!=""){ ?> 
          <div class="ccf_commonPage"><?php echo $section5; ?> </div>           
      <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>  
  <div class="container personal_finance_container">
    <?php echo do_shortcode('[valuehousetabs]'); ?>
  </div>

</section>
<?php get_footer(); ?>