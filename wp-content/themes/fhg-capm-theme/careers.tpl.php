<?php
/**
 * Template Name: Careers
 * @package WordPress
 * @subpackage fhg-capm-theme
 * @since fhg-capm-theme
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
<div class="container-fluid">
  <div class="row">
 <div class="container">
      <!--<div class="col-lg-16 col-md-16 col-sm-16 col-xs-16 innerPageheading">
        <h1>Contact Us</h1>
      </div>-->
      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-16"></div>
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-16 innerpageContent careers">
        <div class="careersListingCont">
          <?php
          the_content();

          echo do_shortcode('[applicationstatus]');
          ?>
          
        </div>
      </div>
      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-16"></div>
    </div>

    <div class="container">
    <div class="careersOpening">
       <?php echo do_shortcode('[show_job_listing_sc]'); ?>
            
          </div>  
    </div>
  </div>
</div>

<?php get_footer(); ?>