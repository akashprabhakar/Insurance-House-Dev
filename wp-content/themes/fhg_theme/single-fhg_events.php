<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package FHG CAPM Theme
 */
get_header();

/* Start Banner Section */
/* Start Banner Section */
get_header_banner_image_with_fixed_title(189, custom_translate(get_the_title(189),get_the_title(562)));
/* END Banner Section */
/* END Banner Section */

/* START Breadcrums Container Section */
get_breadcrumb_wtout_parent(custom_translate(189, 562), custom_translate(get_the_title(189), get_the_title(562)));

/* END Breadcrums Container Section */

$custom = get_post_custom($id);
while (have_posts()) : the_post();
  $eventsdate = date('jS F Y', $custom["fhg_events_startdate"][0]);
  $eventsdate_ar = transfullmonth((date('d F Y', $custom["fhg_events_startdate"][0])));
  ?>

<div class="arrowmaincontainer">
<div class="arrowcontainer">
  <?php get_prev_next_link('events'); ?>
</div>
</div>

    <div class="container">
      <div class="row">
        <div class="innerpage">  
          <div class="eventdetailMain">  
            <div class="eventDetpartone">      
              <div class="eventHeading"><?php the_title(); ?></div>
              <div class="borderTop">&nbsp;</div>
              <div class="date"><span><?php echo custom_translate($eventsdate,$eventsdate_ar); ?></span></div>
              <div class="fhg-column-group leftColmp detailscontainer">
              <?php the_post_thumbnail(); the_content(); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
<?php endwhile; // end of the loop.   ?>

<?php get_footer(); ?>