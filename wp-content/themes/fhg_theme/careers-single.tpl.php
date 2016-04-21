<?php
/**
 * Template Name: Careers Description
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
        
         
  
           <?php echo do_shortcode('[show_job_desc_sc]'); ?>
   
    <?php endwhile; // end of the loop.  ?>
    
    
  </div>
</section>
<!--Main-Content-End-->

<?php get_footer(); ?>