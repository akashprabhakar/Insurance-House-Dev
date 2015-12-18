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
get_header_banner_image_with_custom_title(189, 'events_title_text');
/* END Banner Section */

/* START Breadcrums Container Section */
get_breadcrumb_wtout_parent(custom_translate(189, 562), custom_translate(get_the_title(189), get_the_title(562)));

/* END Breadcrums Container Section */

$custom = get_post_custom($id);
while (have_posts()) : the_post();
$eventsdate = date('jS F Y', $custom["fhg_events_startdate"][0]);
$eventsdate_ar = transfullmonth((date('d F Y', $custom["fhg_events_startdate"][0]));
//  $newsdate_ar = transfullmonth($newsdate_ar);
  //$newsdate_ar = trans($newsdate_ar);

  ?>
  <!-- START Media centre PressRelease Details Container Section -->
  <div class="container-fluid">
    <div class="row">   
  <?php get_prev_next_link('events'); ?>
      <div class="container">
        <div class="eventdetailMain">
          <div class="eventDetpartone">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-16"></div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-16 innerpageContent eventDetailContainer">
              <div class="eventHeading"><?php the_title($before, $after); ?></div>
              <div class="borderTop">&nbsp;</div>
              <div class="date"><span><?php echo  custom_translate($eventsdate,$eventsdate_ar); ?></span></div>
  <?php the_content(); ?>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-16"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
<?php endwhile; // end of the loop.  ?>
<!-- END Media centre PressRelease Details Container Section --> 
</article>
</main><!-- #main -->
</div><!-- #primary -->
<?php get_footer(); ?>