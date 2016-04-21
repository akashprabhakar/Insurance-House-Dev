<?php
/**
 * Template Name: Board Of Directors
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

<!-- START Mid Container Section -->

<div id="management-team">
      <div class="container">
          <div class="center wow">
                  <?php while (have_posts()) : the_post(); ?>
                    <div class="welcome-text text-center">
                      <h1><?php echo the_title(); ?></h1>
						<?php echo the_content(); ?>   					  
                    </div>
                     <?php endwhile; // end of the loop.  ?>
               
                     <?php echo do_shortcode('[get-board-of-directors]'); ?>   
        
     <!--          <hr class="hr-ruller">  -->
            </div>
        </div>
    </div>
<!-- END Mid Container Section -->
<?php get_footer(); ?>