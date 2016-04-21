<?php
/**
 * Template Name: Nil Breadcrumb
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
<section id="recent-works" class="legal-disclaimer">
  <div class="container">
    <?php while (have_posts()) : the_post(); ?>
        <h1 class='content_header'><?php echo the_title(); ?></h1> 
        <?php 
          the_content();
          get_applynowform(); 
        ?>
    <?php endwhile; // end of the loop.  ?> 
  </div>
</section>
<!-- END Mid Container Section --> 
<?php get_footer(); ?>