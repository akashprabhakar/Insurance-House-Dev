<?php
/**
 * Template Name: Investor Relation Landing
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

/* START About us Container Section */

?>

<section id="recent-works-investor">
  <div class="container investor-relations">
<?php 
    while (have_posts()) : the_post(); 
      $custom = get_fields(); //print_r($custom);?>
      <h1 class="content-header"><?php the_title(); ?></h1>
      <div class="center wow"><?php the_content(); ?></div>
    
    <?php endwhile; ?>

    <?php if(!empty($custom['section_1_content'])) { $content1 = $custom['section_1_content']; setup_postdata($content1);?>
      <div class="row ir_Boxcontainer">
        <div class="ir_Boxcontainer_one">
        <div class="Boxcontainer_left">
          <img alt="" src="<?php echo $custom['section_1_image']['url']; ?>">
         </div>
         <div class="Boxcontainer_right"> 
            <?php echo $custom['section_1_content']; ?>
           </div>
        </div>                   
      </div>
    <?php wp_reset_postdata();} ?>
    <!--  Three block /services -->
  <?php if(!empty($custom['section_2_content'])){?>
    <div class="overviewBoxes ownership-statistic">
        <?php echo $custom['section_2_content']; ?>
      <div class="row fourBoxSmallSpace">
        <?php $counter = 1; while($counter <=4) { ?>
         <?php setup_postdata( $custom['block_'.$counter]); ?>
        <div class="col-sm-3 col-md-3 tblBox fourBox">
          <div class="thumbnail">
            <?php echo get_the_content(); ?>
          </div>
        </div>
        <?php $counter++; } ?>
      </div>
    </div>
  <?php } ?>


    <!--  Two block /services -->
  <?php if((!empty($custom['section_3_content'])) && (!empty($custom['section_4_content']))){ ?>
    <div class="overviewBoxes">
      <div class="row">
        <?php $counter = 3; while($counter <=4) { ?>
        <div class="col-sm-6 col-md-6 col-xs-6 tblBox tblBoxborder customarrow">
          <div class="thumbnail">
            <?php echo $custom['section_'.$counter.'_content']; ?>

          </div>
        </div>
        <?php $counter++; } ?>
      </div>
    </div>
  <?php } ?>


	  <?php if(!empty($custom['section_5_contact'])){ ?>
      <?php $content4 = $custom['section_5_contact']; setup_postdata($content4);?>
      <div class="container commonInnerPage_container">
        <h1><?php echo $content4->post_title; ?></h1>
        <div class="innerinvcontact">
        <p><?php echo apply_filters('the_content', $content4->post_content); ?></p>
        </div>
      </div>
	   <?php } ?>
</div></section>
 
<?php get_footer(); ?>


        
