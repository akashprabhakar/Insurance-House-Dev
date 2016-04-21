<?php
/**
 * Template Name: Investor - Contact Us
 * @package WordPress
 * @subpackage fhg-theme
 * @since fhg-theme
 */
 get_header(); 
?>

<div class="headerbanner">
  <div class="innerBanner">
    <div id="googleMap_invcon" style="width: 100%; height: 380px;"></div>  
  </div>
</div>
<?php

/* START Breadcrums Container Section */
get_post_breadcrumbs();
/* END Breadcrums Container Section */
?>
<!--/#feature-->
<!-- START Mid Container Section --> 
<section id="recent-works">
  <div class="container commonInnerPage_container">
 
    <?php while (have_posts()) : the_post(); ?>
        <h1 class='content_header'><?php echo the_title(); ?></h1>
         <div class="innerinvcontact"> 
        <?php 
          the_content();
        ?>
    <?php endwhile; // end of the loop.  ?>
    </div>
  </div>
</section>
<!-- END Mid Container Section --> 
<?php get_footer(); ?>