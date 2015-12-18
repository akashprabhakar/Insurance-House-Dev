<?php
/**
 * Template Name: Sitemap
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
?>
<!--Main-Content-Start-->
<div class="container-fluid">
  <div class="row">
    <div class="container">
      <?php while (have_posts()) : the_post(); ?>
        <div class="col-lg-16 col-md-16 col-sm-16 col-xs-16 aboutcampHed"><h1><?php the_title($before, $after); ?></h1></div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-16"></div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-16 sitemap content_text">
						<?php 
                 custom_wp_nav_menu_sitemap(); 
				the_content();
				?>
        
        
      <?php endwhile; // end of the loop.  ?>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-16"></div>
  </div> 
  <!--<div class="container">
          <div class="col-lg-16 col-md-16 col-sm-16 col-xs-16 overview_divider"><img src="<?php echo INC_URL_IMG . DS . 'abtdivider.png' ?>" ></div>
        </div> -->
</div>
</div>
<!--Main-Content-End-->
<?php get_footer(); ?>