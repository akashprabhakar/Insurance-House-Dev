<?php
/**
 * Template Name: Font page
 * @package WordPress
 * @subpackage fhg-theme
 * @since fhg-theme
 */
get_header();

/* Start Banner Section */
get_header_banner_image($post->ID, get_the_title());
/* END Banner Section */

/* START Breadcrums Container Section */
get_post_breadcrumbs();
/* END Breadcrums Container Section */
?>
<!--Main-Content-Start-->

<!-- END Contact slider Section --> 
<!-- START Mid Container Section -->
<div class="container-fluid">
  <!-- row -->
  <div class="row">
    <!-- container -->
    <div class="container">
      <?php while (have_posts()) : the_post(); ?>
      <div class="col-lg-16 col-md-16 col-sm-16 col-xs-16 innerPageheading fontchange"><h1><?php the_title($before, $after); ?></h1></div>
      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-16"></div>
      <!-- .innerpageContent -->
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-16 innerpageContent fontchange"><?php the_content(); get_applynowform();?></div>
      <!-- .innerpageContent -->
      <?php endwhile; // end of the loop. ?>
      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-16"></div>    
    </div>
    <!-- container -->
    <div class="container">
      <div class="col-lg-16 col-md-16 col-sm-16 col-xs-16 innerpage_divider">
        <img src="<?php echo INC_URL_IMG . DS . 'innerPagedivider.jpg' ?>">
      </div>
    </div>
  </div>
  <!-- row -->
</div>
<!--Main-Content-End-->
<?php get_footer(); ?>