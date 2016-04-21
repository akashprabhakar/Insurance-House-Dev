<?php 
/**
 * Template Name: Forms and Downloads
 * @package WordPress
 * @subpackage Custom Theme
 * @since Custom Theme 1.0
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
<section id="recent-works">
  <div class="container">
  	<h1 class="content_header"><?php echo get_the_title(); ?></h1>
    <?php echo get_the_content(); ?>
  </div>
</section>
<!-- END Mid Container Section --> 
<?php get_footer(); ?>