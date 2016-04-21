<?php get_header(); 

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
  <div class="container commonInnerPage_container">
 
    <?php while (have_posts()) : the_post(); ?>
        <h1 class='content_header'><?php echo the_title(); ?></h1>
         <div class="innerCommonpageText_img"> 
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