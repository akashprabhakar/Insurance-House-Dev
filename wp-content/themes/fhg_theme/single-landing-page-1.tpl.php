<?php
/**
 * Template Name: Single Landing Page 1
 * @package WordPress
 * @subpackage FHG FH Theme
 * @since FHG FH Theme 1.0
 */
get_header();

/* Start Banner Section */
get_header_banner_image($post->ID, get_the_title());
/* END Banner Section */

/* START Breadcrums Container Section */
get_post_breadcrumbs();
wp_reset_query();
/* END Breadcrums Container Section */
$custom = get_fields();//print_r($custom);
// $count = 1;
while (have_posts ()) : the_post(); ?>

<section id="recent-works">
  <div class="container corporate_commercial_finance">
  <div class="credit_cards ccftabs">
      <div class="tabMenu">
        <?php get_cf_tabs();?>
      </div>
    </div>
    <div class="row">
        <div class="cardLeftBox">
        <img alt="" src="<?php echo $custom['left_image']['url']; ?>" class="alignnone size-full wp-image-6722">
        <ul class="applyNowBox">
        <li><a class="apply_now applybtn applyNowBtn" href="<?php echo $custom['add_apply_now_link']; ?>">Apply Now</a></li>
        <li>OR</li>
        <li class="callNowBtn">Call Us on: <a href="tel:80034"><?php echo $custom['add_contact_us_info']; ?></a></li>
        </ul>
        </div>
        <div class="cardCustomRightBox">
          <?php echo get_the_content(); ?>
          <?php get_applynowform(); ?>
        </div>

    </div>



        
        <?php if(!empty($custom['show_hide_title_1']) || !empty($custom['show_hide_title_2']) || !empty($custom['show_hide_title_3'])){ ?>
        <div class="cardDtlsBox">
        <div class="topCardDtlsLink">
          <ul class="nav nav-tabs platinumlisting">
            <?php if(!empty($custom['show_hide_content_1'])){ ?><li class="active"><a href="#tab11" data-toggle="tab"><?php echo $custom['show_hide_title_1'] ?></a></li> <?php } ?>
            <?php if(!empty($custom['show_hide_title_2'])){ ?><li class=""><a href="#tab12" data-toggle="tab"><?php echo $custom['show_hide_title_2'] ?></a></li> <?php } ?>
            <?php if(!empty($custom['show_hide_title_3'])){ ?><li class=""><a href="#tab13" data-toggle="tab"><?php echo $custom['show_hide_title_3'] ?></a></li> <?php } ?>
          </ul>
          <div class="tab-content">
            <?php if(!empty($custom['show_hide_title_1'])){ ?>
            <div id="tab11" class="tab-pane active">
              <div class="cardDtlsBoxContent">
              <?php echo $custom['show_hide_content_1']; ?>
              </div>
            </div>
            <?php } ?>
            <?php if(!empty($custom['show_hide_title_2'])){ ?>
            <div id="tab12" class="tab-pane">
              <div class="cardDtlsBoxContent">
                <?php echo $custom['show_hide_content_2']; ?>
              </div>
            </div>
            <?php } ?>
            <?php if(!empty($custom['show_hide_title_3'])){ ?>
            <div id="tab12" class="tab-pane">
              <div class="cardDtlsBoxContent">
                <?php echo $custom['show_hide_content_3']; ?>
              </div>
            </div>
            <?php } ?>
          </div>
        </div>
        </div>
        <?php } ?>



  <!--  Three block /services -->
  <?php if(!empty($custom['add_services_content'])){?>
    <div class="overviewBoxes">
        <?php echo $custom['add_services_content']; ?>
      <div class="row">
        <?php $counter = 1; while($counter <=3) { ?>
        <div class="col-sm-4 col-md-4 col-xs-4 tblBox tblBoxborder">
          <div class="thumbnail">
            <?php echo $custom['two_content_block_'.$counter]; ?>

          </div>
        </div>
        <?php $counter++; } ?>
      </div>
    </div>
  <?php } ?>


  </div>     <!-- end of container -->
</section>
<?php endwhile; // end of the loop.
?>

<!--/#feature-->

<!-- END Mid Container Section --> 
<?php get_footer(); ?>


