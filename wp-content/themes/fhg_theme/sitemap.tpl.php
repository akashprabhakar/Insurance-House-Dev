<?php
/**
 * Template Name: Sitemap
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
  <div class="container sitemap">
    <?php while (have_posts()) : the_post(); ?>
        <h1 class='content_header'><?php echo the_title(); ?></h1> 
        <?php 
           echo header_topnav_menu();
		  echo header_primary_menu();
          the_content();
        ?>
    <?php endwhile; // end of the loop.  ?> 
  </div>
</section>
<!--Main-Content-End-->
<?php get_footer(); ?>