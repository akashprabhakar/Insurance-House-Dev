<?php
/**
 * Template Name: Landing Page Template 4
 * @package WordPress
 * @subpackage FHG FH Theme
 * @since FHG FH Theme 1.0
 */
get_header();

/* Start Banner Section */
get_header_banner_image($post->ID, get_the_title());
/* END Banner Section */

/* START Breadcrums Container Section */
get_primary_breadcrumbs();
/* END Breadcrums Container Section */
$custom = get_fields();//print_r($custom);
// $count = 1;
while (have_posts ()) : the_post(); ?>

<section id="recent-works">
  <div class="container corporate_commercial_finance">
    <div class="center wow"><?php echo get_the_content(); ?></div>
       
    <div class="row overviewBoxContainer">
        <?php $counter = 1; while($counter <=3) {
          if(!empty($custom['two_content_block_'.$counter])){?>
            <div class="overviewBoxContainer_inner"><span class="arrow_leftOne"></span>
              <a href="<?php echo $custom['two_page_link_'.$counter]['url'];?>" class="readmore"><img src="<?php echo $custom['two_image_block_'.$counter]['url']; ?>"></a>
              <h1><a href="<?php echo $custom['two_page_link_'.$counter]['url'];?>"><?php echo $custom['two_title_block_'.$counter];?></a></h1>
              <?php echo $custom['two_content_block_'.$counter];?>
              <div class="ccf_learmore"><a href="<?php echo $custom['two_page_link_block_'.$counter];?>" class="readmore"><?php echo LEARNMORE; ?></a></div>
            </div>
        <?php }$counter++; } ?>
              </div>



              <div class="overviewBoxes">
            <div class="row twoBoxTbl">
            <?php $counter = 1; while($counter <=2) {
                if(!empty($custom['two_small_content_'.$counter])){?>
              <div class="col-sm-6 col-md-5 tblBox twoBox">
                <div class="thumbnail">
                  <div class="img-block">
                  <a href="<?php echo $custom['two_small_page_link_'.$counter]['url'];?>"><img class="alignnone size-full wp-image-6987" src="<?php echo $custom['two_small_image_'.$counter]['url']; ?>" alt="button31"></a>
                  <div class="caption">
                    <h2><a href="<?php echo $custom['two_small_page_link_'.$counter]['url'];?>"><?php echo $custom['two_small_title_'.$counter];?></a></h2>
                     <?php echo $custom['two_small_content_'.$counter];?>
                    <p><a href="<?php echo $custom['two_small_page_link_'.$counter];?>"><?php echo KNOWMORE; ?></a></p>
                  </div>
                </div>
              </div>
             </div>
              <?php }$counter++; } ?>
          </div>
           </div>


      </div>     
</section>
<?php endwhile; // end of the loop.
?>

<!--/#feature-->

<!-- END Mid Container Section --> 
<?php get_footer(); ?>

