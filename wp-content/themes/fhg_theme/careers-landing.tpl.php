<?php
/**
 * Template Name: Careers Landing Page
 * @package WordPress
 * @subpackage FHG FH Theme
 * @since FHG FH Theme 1.0
 */
get_header();

/* Start Banner Section */
get_header_banner_image($post->ID, get_the_title());
/* END Banner Section */

/* START Breadcrums Container Section */
get_topnav_breadcrumbs();
/* END Breadcrums Container Section */
?><section id="recent-works">
  <div class="container about-us careers">
<?php 
    while (have_posts()) : the_post(); 
      $custom = get_fields(); ?>
      <div class="center"> <h1 class="content-header"><?php the_title(); ?></h1><?php the_content(); ?></div>
    <?php endwhile; ?>
	  
	 <!-- Start Section 1 -->
	   <?php if(!empty($custom['section_tab_1_content'])) {  ?>
		  <div class="row careers_Boxcontainer">		 
          <div class="careers_Boxcontainer_one"><span class="careers_arrow_leftOne"></span>
		  <img alt="" src="<?php echo $custom['section_tab_1_image']; ?>">
		  <?php echo $custom['section_tab_1_content']; ?>
		  </div>
			  
		  <?php if(!empty($custom['section_tab_2_content'])) {  ?>
		
          <div class="careers_Boxcontainer_two"><span class="careers_arrow_rightTwo"></span>
		  <img alt="" src="<?php echo $custom['section_tab_2_image']; ?>">
		  <?php echo $custom['section_tab_2_content']; ?>
		  </div>
		 
		  <?php } ?>
		  
		    </div>
		  <?php } ?>
   <!-- End Section 1 -->
	

<!-- Start Section 2 -->

<?php wp_reset_postdata(); ?>
 <?php if($custom['section_1_content']!=""){ ?> 
  
    <div class="ourcompanyCC">
  <?php echo $custom['related_sections_content']; ?>

    <div class="row">
            <div class="col-sm-6 col-md-6 col-xs-12 careersLeft">
              <div class="thumbnail">
                <?php echo $custom['section_1_content']; ?>
              </div>
            </div>
            <div class="col-sm-6 col-md-6 col-xs-12 careersRight">
              <div class="thumbnail">
                <?php echo $custom['section_2_content']; ?>
              </div>
            </div>
           </div>
           </div>



       <?php } ?>

        <div class="row helpcenter-middlecontainer valuehousehelpcenter">
          <?php echo $custom['add_services_content2']; ?>
          <?php echo do_shortcode('[show_job_listing_sc openingscount=2]'); ?>
        </div>
      </div>
<!-- End Section 2 --> 	
</section>
 
<?php get_footer(); ?>