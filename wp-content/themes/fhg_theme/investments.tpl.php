<?php
/**
 * Template Name: Investments
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
$learnmore = custom_translate('Learn More', 'أعر�? أكثر');
$leftimg = custom_translate('invt-coma.png', 'doublequote_left_ar.png');
$rightimg = custom_translate('invt-coma-1.png', 'doublequote_right_ar.png');
$section1 =  get_the_content();

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
            'value' => 'investment',
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
$section2 = "";
$section3 = "";
$section4 = "";
$section5 = "";
$hrclass = '<hr class="hr-ruller">';

// $count = 1;
while (have_posts ()) : the_post();

  $section = get_post_meta( get_the_ID(), '_fhg_lp_section', true );
  if(!($section=="")){
    if($section==2){ 
        $section2 .= '<h1 class="content_header"><a href="'.get_permalink().'">'. get_the_title() .'</a></h1>'.get_the_content();
    }
    if($section==3){ 
        $section3 .= '<span class="ccf_arrow_leftOne"></span><img alt="" src="'.id_only_post_image(get_the_ID()).'"/>
                      <h1><a href="'.get_permalink().'">'. get_the_title() .'</a></h1>';
        $section3 .= '<p>'.get_the_content_with_mytrim(get_the_content(),custom_translate(17,15)) . '</p>
                      <div class="ccf_learmore"><a href="' . get_permalink() . '" class="readmore"> '. $learnmore . '</a></div>';
    }
    if($section==4){
        $section4 .= '<span class="ccf_arrow_rightTwo"></span><img alt="" src="'.id_only_post_image(get_the_ID()).'"/>
                      <h1><a href="'.get_permalink().'">'. get_the_title() .'</a></h1>';
        $section4  .= '<p>'.get_the_content_with_mytrim(get_the_content(),custom_translate(17,15)) . '</p>
                      <div class="ccf_learmore"><a href="' . get_permalink() . '" class="readmore"> '. $learnmore . '</a></div>'; 
    }
}
endwhile; // end of the loop.
?>

<!--/#feature-->
<section id="recent-works">
  <div class="container investmentContainer">
    <?php if($section1!=""){ ?> 
      <div class="center wow"><?php echo $section1; ?></div>
    <?php } ?>

    <?php if($section2!=""){ ?> 
        <?php //echo $section2; ?>
    <?php } ?>

    <div class="row ccf_Boxcontainer">
      <?php if($section3!=""){ ?> 
          <div class="ccf_Boxcontainer_one"><?php echo $section3; ?> </div>           
      <?php } ?>
                
      <?php if($section4!=""){ ?> 
          <div class="ccf_Boxcontainer_two"><?php echo $section4; ?></div>                        
      <?php } ?>
    </div>
  </div>
</section>
<!-- END Mid Container Section --> 
<?php get_footer(); ?>