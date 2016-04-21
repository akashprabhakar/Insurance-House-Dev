<?php
/**
 * Template Name: Mission & Vision 
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


<section id="recent-works">

<?php 
    while (have_posts()) : the_post(); 
      $custom = get_fields(); //print_r($custom);?>
      <div class="container missionContainer">
        <div class="center wow">
		<h1 class="content_header"> <?php echo get_the_title(); ?></h1>
          <?php the_content(); ?>
        </div> 
	
    
	  <div class="missionCC">
  <?php echo $custom['related_sections_content']; ?>

          <div class="row">
            <div class="col-sm-4 col-md-4">
              <div class="thumbnail">
                <?php echo $custom['section_1_content']; ?>
              </div>
            </div>
            <div class="col-sm-4 col-md-4">
              <div class="thumbnail">
                <?php echo $custom['section_2_content']; ?>
              </div>
            </div>
            <div class="col-sm-4 col-md-4">
              <div class="thumbnail">
                <?php echo $custom['section_3_content']; ?>
              </div>
            </div>
           </div>
           </div>
       
      </div>
      
    <?php endwhile; ?>
</section>
 
<?php get_footer(); ?>

