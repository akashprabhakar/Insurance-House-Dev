<?php
/**
 * Template Name: Value House 
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
  <div class="container" id="content-area">
    <div class="credit_cards">
      <div class="tabMenu">
        <?php get_pf_tabs();?>
      </div>
    </div>
    <!--/.row--> 
  </div>
  <!--/.container-->

<?php 
    while (have_posts()) : the_post(); 
      $custom = get_fields(); //print_r($custom);?>
      <div class="container">
        <div class="row valuehousecontainer">
          <?php the_content(); ?>
        </div>
        <div class="row valuehousevideo">
          <?php echo $custom['video_widget_content']; ?>
        </div>
        <div class="valueHouseCC valusehouseallCardBox">
          <div class="row">
            <div class="col-sm-4 col-md-4">
              <div class="thumbnail">
                <?php echo $custom['benefits_tab_content']; ?>
              </div>
            </div>
            <div class="col-sm-4 col-md-4">
              <div class="thumbnail">
                <?php echo $custom['payment_plan_tab_content']; ?>
              </div>
            </div>
            <div class="col-sm-4 col-md-4">
              <div class="thumbnail">
                <?php echo $custom['killer_deals_tab_content']; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row helpcenter-middlecontainer valuehousehelpcenter">
          <?php echo $custom['vh_discounts_register_content']; ?>
        </div>
      </div>
      <div class="container">
        <div class="allCardBox valueHouseCardBox">
           <?php echo $custom['credit_cards_content']; ?>
          <div class="row">
            <div class="col-sm-12 col-md-3 col-xs-12 col-lg-3">
              <div class="thumbnail">
                <?php echo $custom['credit_cards_tab_1']; ?>
              </div>
            </div>
            <div class="col-sm-12 col-md-3 col-xs-12 col-lg-3">
              <div class="thumbnail">
                <?php echo $custom['credit_cards_tab_2']; ?>
              </div>
            </div>
            <div class="col-sm-12 col-md-3 col-xs-12 col-lg-3">
              <div class="thumbnail">
                <?php echo $custom['credit_cards_tab_3']; ?>
              </div>
            </div>
            <div class="col-sm-12 col-md-3 col-xs-12 col-lg-3">
              <div class="thumbnail">
                <?php echo $custom['credit_cards_tab_4']; ?>
              </div>
            </div>
          </div>
        </div>
      </div>

      
    <?php endwhile; ?>
</section>
 
<?php get_footer(); ?>

