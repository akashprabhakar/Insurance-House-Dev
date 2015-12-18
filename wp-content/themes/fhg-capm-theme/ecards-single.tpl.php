<?php
/**
 * Template Name: Ecards Description
 * @package WordPress
 * @subpackage fhg-capm-theme
 * @since fhg-capm-theme
 */
get_header();

/* Start Banner Section */
get_header_banner_image($post->ID, get_the_title());
/* END Banner Section */

/* START Breadcrums Container Section */
get_post_breadcrumbs();
/* END Breadcrums Container Section */
require_once(ROOTDIR . 'includes/fhg-ecards-class.php');
  $ecardobj = new ECard;
?>
<!--Main-Content-Start-->
<div class="container-fluid">
  <div class="row">
    <div class="container">
      <?php while (have_posts()) : the_post(); ?>
        <div class="col-lg-16 col-md-16 col-sm-16 col-xs-16 aboutcampHed">
          <h1><?php the_title($before, $after); ?></h1></div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-16"></div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-16 content_text">
          <?php the_content(); ?>
           
        </div>
      <?php endwhile; // end of the loop.  ?>

      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-16"></div>
    </div> 

      <?php echo do_shortcode('[ecards-description]'); ?>
  
  </div>



</div>
<!--Main-Content-End-->

<?php get_footer(); ?>