<?php
/**
 * Template Name: Careers
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

<section id="recent-works">
  <div class="container careerDetailMainContainer">
 
    <?php while (have_posts()) : the_post(); ?>
<div class="center"> <h1 class="content-header"><?php the_title(); ?></h1><?php the_content(); ?></div>
  
   
    <?php endwhile; // end of the loop.  ?>
    
        <?php  if(!empty($custom['add_services_content2'])){?>
          <div class="overviewBoxes helpcenter-middlecontainer valuehousehelpcenter">
            <?php echo $custom['add_services_content2'];?>
            <div class="row">
              <?php echo do_shortcode('[show_job_listing_sc]');?>
            </div>
          </div>
          <?php } ?>
  </div>
</section>
<!--Main-Content-End-->

<?php get_footer(); ?>