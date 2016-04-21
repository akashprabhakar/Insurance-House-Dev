<?php 
/**
 * Template Name: Accordion View
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
  <div class="container"><h1 class='content_header'><?php echo the_title(); ?></h1> </div>
  <div class="container-fluid faq-tab-container faq-inner">
  	<div class="container">
    <?php while (have_posts()) : the_post(); ?>        
        <?php 
          the_content();
          get_applynowform(); 
        ?>
    <?php endwhile; // end of the loop.  ?> 
    </div>
  </div>
</section>
<!-- END Mid Container Section --> 
<?php get_footer(); ?>