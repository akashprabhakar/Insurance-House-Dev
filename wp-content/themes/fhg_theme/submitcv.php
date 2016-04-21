<?php 
/**
 * Template Name: Submit your CV
 * @package WordPress
 * @subpackage fhg-theme
 * @since fhg-theme 1.0
 */
get_header(); 

/* Start Banner Section */
get_header_banner_image($post->ID, get_the_title());
/* END Banner Section */

/* START Breadcrums Container Section */
get_post_breadcrumbs();
/* END Breadcrums Container Section */

?>
<!--/#feature-->
<!-- START Mid Container Section --> 
<section id="recent-works">
  <div class="container careerDetailMainContainer">
 	<?php echo do_shortcode('[show_success_msg]'); ?>
    <?php while (have_posts()) : the_post(); ?>
        <h1 class='content_header hidecontent'><?php echo the_title(); ?></h1> 
        <div class="center row hidecontent"><?php 
           the_content(); ?></div>
          <?php echo do_shortcode('[careersform]'); ?>
    <?php endwhile; // end of the loop.  ?>

    </div>
 
</section>
<!-- END Mid Container Section --> 
<?php get_footer(); ?>