<?php
/**
 * Template Name: Help Center
 * @package WordPress
 * @subpackage Custom Theme
 * @since Custom Theme 1.0
 */
get_header();

/* Start Banner Section */
get_header_banner_image($post->ID, get_the_title());
/* END Banner Section */

/* START Breadcrums Container Section */
get_topnav_breadcrumbs();
/* END Breadcrums Container Section */

/* START About us Container Section */
$custom = get_fields();//print_r($custom);

while (have_posts ()) : the_post(); ?>

<section id="recent-works">
  <div class="container helpCentreBox">
   <!----Title-->
   <h1 class='content_header'><?php echo get_the_title(); ?></h1> 
   <!----Title-->
   <!----Post Content-->
    <div class="center wow"><?php echo get_the_content(); ?></div>
	 <!----Post Content-->
	  <!----Container First-->
	   <?php if(!empty($custom['two_content_block_1'])){?>
     <div class="row ccf_Boxcontainer">
	 <div class="ccf_Boxcontainer_one"><span class="ccf_arrow_threeThree"></span>
	  <a href="<?php echo $custom['two_page_link_1']['url'];?>" class="readmore"><img src="<?php echo $custom['two_image_block_1']['url']; ?>"></a>
                    <h1><a href="<?php echo $custom['two_page_link_block_1'];?>"><?php echo $custom['two_title_block_1'];?></a></h1>
					<?php echo $custom['two_content_block_1'];?>
                    <div class="ccf_learmore"><a href="<?php echo $custom['two_page_link_block_1'];?>" class="readmore"><?php echo LEARNMORE; ?></a></div></div>
	 
          </div>
		  <?php } ?>
		   <!----Container First-->
	 <!-- Start Section 2 -->
    <?php if(!empty($custom['lirt_box_content_1'])) {  ?>
    <div class="row helpcenter-middlecontainer valuehousehelpcenter">
    <?php $counter = 1; while($counter <=2) { ?>
      <div class="missionContentBox">
        <div class="hc-b1-faq">
        <a href="<?php echo $custom['lirt_box_page_link_'.$counter]; ?>"><div class="img-block"><img class="alignnone wp-image-7852 size-full" src="<?php echo $custom['lirt_box_image_'.$counter]['url']; ?>" alt="" width="246" height="279"></div></a>
          <div>
          <h1><a href="<?php echo $custom['lirt_box_page_link_'.$counter]; ?>"><?php echo $custom['lirt_box_title_'.$counter]; ?></a></h1>
          <p><a href="<?php echo $custom['lirt_box_page_link_'.$counter]; ?>"><?php echo $custom['lirt_box_content_'.$counter]; ?></a></p>
          <p><a href="<?php echo $custom['lirt_box_page_link_'.$counter]; ?>"><?php echo LEARNMORE; ?></a></p>
          </div>
        </div>
      </div>
    <?php $counter++;} ?>
    </div>
  
   <?php } ?>
 <!-- End Section 2 -->
  <!----Last Container-->
   <?php if(!empty($custom['two_content_block_2'])){?>
 <div class="row ccf_Boxcontainer hpmrgnbtm">               
          <div class="ccf_Boxcontainer_two"><span class="ccf_arrow_rightTwo"></span>
		   <a href="<?php echo $custom['two_page_link_2']['url'];?>" class="readmore"><img src="<?php echo $custom['two_image_block_2']['url']; ?>"></a>
              <h1><a href="<?php echo $custom['two_page_link_2']['url'];?>"><?php echo $custom['two_title_block_2'];?></a></h1>
              <?php echo $custom['two_content_block_2'];?>
              <div class="ccf_learmore"><a href="<?php echo $custom['two_page_link_block_2'];?>" class="readmore"><?php echo LEARNMORE; ?></a></div>
		</div>
		</div>
		   <?php } ?>
		   <!----Last Container-->
           </div>    
</section>
<?php endwhile; // end of the loop.
?>

<!--/#feature-->

<!-- END Mid Container Section --> 
<?php get_footer(); ?>