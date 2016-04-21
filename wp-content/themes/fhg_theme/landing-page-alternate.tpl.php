<?php
/**
 * Template Name: Landing Page Alternate
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
<section id="recent-works">
  <div class="container corporate_commercial_finance ourCompany">
  
<?php 
    while (have_posts()) : the_post(); 
      $custom = get_fields(); //print_r($custom);?>
      <div class="center wow"> <h1 class="content-header"><?php the_title(); ?></h1><?php the_content(); ?></div>
    
    <?php endwhile; ?>
	  
	 
		  <div class="row ccf_Boxcontainer">
		   <?php if(!empty($custom['section_tab_1_content'])) {  ?>
          <div class="ccf_Boxcontainer_one"><span class="ccf_arrow_leftOne"></span>
		  <img alt="" src="<?php echo $custom['section_tab_1_image']; ?>">
		  <?php echo $custom['section_tab_1_content']; ?>
		  </div>
		 
		  <?php } ?>
      
	  <?php if(!empty($custom['section_tab_2_content'])) {  ?>
		
          <div class="ccf_Boxcontainer_two"><span class="ccf_arrow_rightTwo"></span>
		  <img alt="" src="<?php echo $custom['section_tab_2_image']; ?>">
		  <?php echo $custom['section_tab_2_content']; ?>
		  </div>
		 
		  <?php } ?>
		  
		  <?php if(!empty($custom['section_tab_3_content'])) {  ?>
		 
          <div class="ccf_Boxcontainer_one"><span class="ccf_arrow_threeThree"></span>
		  <img alt="" src="<?php echo $custom['section_tab_3_image']; ?>">
		  <?php echo $custom['section_tab_3_content']; ?>
		  </div>
		 
		  <?php } ?>
		  
		    <?php if(!empty($custom['section_tab_4_content'])) {  ?>
		 
          <div class="ccf_Boxcontainer_one"><span class="ccf_arrow_leftOne"></span>
		  <img alt="" src="<?php echo $custom['section_tab_4_image']; ?>">
		  <?php echo $custom['section_tab_4_content']; ?>
		  </div>
		 
		  <?php } ?>
   </div>
	</div>
</section>
 
<?php get_footer(); ?>