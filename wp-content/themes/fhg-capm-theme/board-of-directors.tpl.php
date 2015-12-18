<?php
/**
 * Template Name: Board Of Directors
 * @package WordPress
 * @subpackage fhg-capm-theme
 * @since fhg-capm-theme
 */
get_header();

/* Start Banner Section */
get_header_banner_image($post->ID, get_the_title());
/* END Banner Section */

/* START Breadcrums Container Section */
get_primary_breadcrumbs();
/* END Breadcrums Container Section */
?>

<!-- START Mid Container Section -->
<div class="container-fluid">
  <div class="row">
    <!-- container -->
    <div class="container">
    <?php while (have_posts()) : the_post(); ?>
      <div class="col-lg-16 col-md-16 col-sm-16 col-xs-16 innerPageheading"><h1><?php the_title($before, $after); ?></h1></div>
      <!-- .innerpageContent -->
      <div class="col-lg-16 col-md-16 col-sm-16 col-xs-16 innerpageContent boarddirector"><?php the_content();?></div>
      <!-- .innerpageContent -->
    <?php endwhile; // end of the loop. ?>  
    </div>
    <!-- container -->
    <!-- container -->
    <div class="container">
      <div class="col-lg-16 col-md-16 col-sm-16 col-xs-16 innerpage_divider">
        <img src="<?php echo INC_URL_IMG . DS . 'innerPagedivider.jpg' ?>">
      </div>
    </div>    
    <!-- container -->
  </div>
</div>
<!-- END Mid Container Section -->
<?php get_footer(); ?>