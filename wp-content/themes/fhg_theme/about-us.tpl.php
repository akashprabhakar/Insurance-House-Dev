<?php
/**
 * Template Name: About Us
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
<div id="recent-works">
  <div class="container about-us">
<?php 
    while (have_posts()) : the_post(); 
      $custom = get_fields(); ?>
      <div class="center"> <h1><?php the_title(); ?></h1><?php the_content(); ?></div>
    <?php endwhile; ?>
	  
    <div class="row overviewBoxContainer">
        <?php $counter = 1; while($counter <=3) {
          if(!empty($custom['two_content_block_'.$counter])){?>
            <div class="overviewBoxContainer_inner"><span class="arrow_leftOne"></span>
              <a href="<?php echo $custom['two_page_link_block_'.$counter];?>"><img alt="" src="<?php echo $custom['two_image_block_'.$counter]['url']; ?>"></a>
              <h1><a href="<?php echo $custom['two_page_link_block_'.$counter];?>"><?php echo $custom['two_title_block_'.$counter];?></a></h1>
              <?php echo $custom['two_content_block_'.$counter];?>
              <div class="ccf_learmore"><a href="<?php echo $custom['two_page_link_block_'.$counter];?>" class="readmore"><?php echo LEARNMORE; ?></a></div>
            </div>
        <?php }$counter++; } ?>
              </div>
	<!-- Start Section 2 -->
    <?php if(!empty($custom['lirt_box_content_1'])) {  ?>
	  <div class="row helpcenter-middlecontainer valuehousehelpcenter">
    <?php $counter = 1; while($counter <=2) { ?>
      <div class="missionContentBox">
        <div class="hc-b1-faq">
        <a href="<?php echo $custom['lirt_box_page_link_'.$counter]; ?>"><div class="img-block"><img class="alignnone wp-image-7852 size-full" src="<?php echo $custom['lirt_box_image_'.$counter]['url']; ?>" alt="" width="246" height="279"></div></a>
          <div>
          <h1><a href="<?php echo $custom['lirt_box_page_link_'.$counter]; ?>"><?php echo $custom['lirt_box_title_'.$counter]; ?></a></h1>
          <a href="<?php echo $custom['lirt_box_page_link_'.$counter]; ?>"><?php echo $custom['lirt_box_content_'.$counter]; ?></a>
          <p><a href="<?php echo $custom['lirt_box_page_link_'.$counter]; ?>"><?php echo LEARNMORE; ?></a></p>
          </div>
        </div>
      </div>
    <?php $counter++;} ?>
    </div>
	
   <?php } ?>
 <!-- End Section 2 -->
 <!-- Start Section 3 -->
 <?php 
$pageID = custom_translate(34, 398);
$page = get_post($pageID);
?>
<div class="management-team">
<div class="welcome-text text-center">
<h1><?php echo '<a href="'.get_permalink($pageID).'">' . $page->post_title . '</a>'; ?></h1>
<?php  
$content=  $page->post_content;
echo get_the_content_with_format($content);
wp_reset_postdata();
?>
</div>
 <?php echo do_shortcode('[get-board-of-directors]'); ?>  
	</div>
<!-- End Section 3 -->

<!-- Start Section 4 -->


  <!--  Three block /services -->
  <?php if(!empty($custom['add_services_content'])){?>
    <div class="overviewBoxes">
        <?php echo $custom['add_services_content']; ?>
      <div class="row fourBoxSmallSpace">
        <?php $counter = 1; while($counter <=4) { ?>
        <div class="col-sm-3 col-md-3 tblBox fourBox">
          <div class="thumbnail">
            <?php echo $custom['two_content_block_'.$counter]; ?>
          </div>
        </div>
        <?php $counter++; } ?>
      </div>
    </div>
  <?php } ?>
<!-- End Section 4 --> 


<!-- Start Section 5 -->
<?php if(!empty($custom['slider_section_main_content'])) {  ?>
<div class="abtus-investor">
 <?php echo $custom['slider_section_main_content'];?>

  <div class="col-md-12 col-sm-12 col-xs-12 board-director-list">
  <div class="arrow left-arrow"><a href="#" onclick="return false;" class="next"><img src="<?php echo INC_URL_IMG . DS . 'left_arrow_inv.png';?>" alt="left"></a></div>
  <ul class="list-inline" id="investor-relation-slider">
 <?php $counter=1; while($counter <= 9){ 
 if(!empty($custom['slider_section_content_'.$counter])) {
 echo '<li>' . $custom['slider_section_content_'.$counter] . '</li>';}
  wp_reset_postdata(); $counter++; }?>  
</ul>
<div class="arrow right-arrow">
                          <a href="#" onclick="return false;" class="prev"><img src="<?php echo INC_URL_IMG . DS . 'right_arrow_inv.png';?>" alt="prev"></a>
  </div>
</div> 
</div>
<?php } ?>
</div>
<!--dummy -->

<!-- End Section 5 -->

<!-- Start Section 6 -->
<?php wp_reset_postdata();
if(!empty($custom['content_block_text'])) {
?>
<div class="container-fluid about-us">
    <div class="row share-registrar">
      <div class="col-md-12 col-sm-12 customercontainer">
        <div class="container ">
          <div class="row">
    
          <div class="abt-emirates">		 
<div class="col-md-6 col-sm-12 col-xs-12 customercontainerimg">
<!--Slider-->
<?php do_shortcode('[abt-latest-emirates]'); ?>
</div>
<div class="col-md-6 col-sm-12 col-xs-12">
<!--Content-->
 <?php echo $custom['content_block_text'];
wp_reset_postdata();
?>
</div>
 </div>           
     
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php } ?>

	<!--End Section 6 -->
  <?php  if(!empty($custom['two_small_content_1'])){?>
  <div class="container">
            <div class="overviewBoxes careers-overviewbox">
              <div class="row">
              <?php $counter = 1; while($counter <=2) { ?> 
              <div class="col-sm-6 col-md-6 col-xs-6 tblBox tblBoxborder customarrow">
                <div class="thumbnail">
                  <a href="<?php echo $custom['two_small_page_link_'.$counter];?>"><img class="alignnone size-full wp-image-6987" src="<?php echo $custom['two_small_image_'.$counter]['url']; ?>" alt="button31"></a>
                    <h2><a href="<?php echo $custom['two_small_page_link_'.$counter];?>"><?php echo $custom['two_small_title_'.$counter];?></a></h2>
                     <?php echo $custom['two_small_content_'.$counter];?>
                    <p><a href="<?php echo $custom['two_small_page_link_'.$counter];?>"><?php echo LEARNMORE; ?></a></p>
                </div>
              </div>
              <?php $counter++; } ?>
              </div>
           </div>
  </div>
           <?php } ?>
</div>
 
<?php get_footer(); ?>