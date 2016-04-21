<?php
/**
 * Template Name: Top Nav Breadcrumb
 * @package WordPress
 * @subpackage custom-theme
 * @since custom-theme
 */
get_header();

/* Start Banner Section */
get_header_banner_image($post->ID, get_the_title());
/* END Banner Section */

/* START Breadcrums Container Section */
get_topnav_breadcrumbs();
/* END Breadcrums Container Section */
?>
<!--/#feature-->
<div id="recent-works">
  <div class="container">
    <?php while (have_posts()) : the_post(); ?>
        <h1><?php echo the_title(); ?></h1> 
        <?php 
          the_content();
          get_applynowform(); 
        ?>
    <?php endwhile; // end of the loop.  ?> 
  </div>
</div>
<!-- END Mid Container Section --> 
<?php get_footer(); ?>