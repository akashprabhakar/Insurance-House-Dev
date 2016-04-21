<?php
/**
 * Template Name: Single Landing Page 4
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

<div id="recent-works">
  <div class="container corporate_commercial_finance">
  <div class="center row"><h1><?php echo get_the_title(); ?></h1><?php echo get_the_content(); ?></div>

<?php endwhile; // end of the loop.?>
          <!--  Three block /services -->
    <?php wp_reset_postdata(); ?>
  <?php if(!empty($custom['add_services_content'])){?>
  
    <div class="overviewBoxes">
        <?php echo $custom['add_services_content']; ?>
      <div class="row">
        <?php $counter = 1; while($counter <=3) { ?>
        <?php setup_postdata( $custom['add_content_widget_'.$counter]); ?>
        <div class="col-sm-4 col-md-4 col-xs-4 tblBox tblBoxborder">
          <div class="thumbnail">
            <a href="<?php echo get_field('add_page_link', $custom['add_content_widget_'.$counter]->ID); ?>">
              <img class="alignnone size-full wp-image-7621" src="<?php echo get_field('add_image', $custom['add_content_widget_'.$counter]->ID,true)['url']; ?>" alt="ms_certificate_image">
            </a>
            <h2>
              <a href="<?php echo get_field('add_page_link', $custom['add_content_widget_'.$counter]->ID); ?>"><?php echo get_field('add_title', $custom['add_content_widget_'.$counter]->ID); ?></a>
            </h2>
            <?php echo get_field('add_content', $custom['add_content_widget_'.$counter]->ID); ?>
            <p><a href="<?php echo get_field('add_page_link', $custom['add_content_widget_'.$counter]->ID); ?>"><?php echo custom_translate('Know more', 'أعرف أكثر'); ?></a></p>

          </div>
        </div>
        <?php wp_reset_postdata(); $counter++; } ?>
      </div>
    </div>
  
  <?php } ?>
<!-- End Section 4 --> 


  </div>     <!-- end of container -->
</div>


<!--/#feature-->

<!-- END Mid Container Section --> 
<?php get_footer(); ?>


