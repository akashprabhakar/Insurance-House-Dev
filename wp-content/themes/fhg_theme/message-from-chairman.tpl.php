<?php
/**
 * Template Name: Message From Chairman
 * @package WordPress
 * @subpackage custom-theme
 * @since custom-theme
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
<div id="recent-works">
  <div class="container msgchairmanContainer">
   
      
        <?php while (have_posts()) : the_post(); ?>
         <h1><?php the_title($before, $after); ?></h1>                        
       
          <div class="innerCommonpageText_img">
            <!-- <div class="img-block"> -->
           <!-- <img src="<?php //echo catch_that_image() ?>"/></div> -->
            <?php
            //echo get_the_content_with_formatting_trim(false);
            the_content();
            ?>
          </div>
        <?php endwhile; // end of the loop.   ?>
                  
     

  </div>
</div>
<!--Main-Content-End-->
<?php get_footer(); ?>