<?php
/**
 * Template Name: Our Company Child
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
      <div class="container strengthsContainer">
        <div class="center wow">
		<h1 class="content_header"> <?php echo get_the_title(); ?></h1>
          <?php the_content(); 
		  getProductContactForm();?>
        </div> 
	
    
	  <div class="ourcompanyCC">
  <?php echo $custom['related_sections_content']; ?>

    <div class="row">
            <div class="col-sm-6 col-md-6 col-xs-12">
              <div class="thumbnail">
                <?php echo $custom['section_1_content']; ?>
              </div>
            </div>
            <div class="col-sm-6 col-md-6 col-xs-12">
              <div class="thumbnail">
                <?php echo $custom['section_2_content']; ?>
              </div>
            </div>
           </div>
           </div>
       
      </div>
 <?php if($custom['section_3_content']!=""){ ?> 
       <div class="container-fluid">
    <div class="row share-registrar">
      <div class="col-md-12 col-sm-12 customercontainer">
        <div class="container ">
          <div class="row">
    
          <div class="ccf_commonPage"><?php echo $custom['section_3_content']; ?> </div>           
     
          </div>
        </div>
      </div>
    </div>
  </div>  
       <?php } ?>
    <?php endwhile; ?>
</section>
 
<?php get_footer(); ?>

