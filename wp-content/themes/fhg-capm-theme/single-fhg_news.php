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
get_header_banner_image_with_fixed_title(64, custom_translate(get_the_title(64), get_the_title(560)));
/* END Banner Section */


get_breadcrumb_wtout_parent(custom_translate(64, 560), custom_translate(get_the_title(64), get_the_title(560)));


/* START Breadcrums Container Section */
//get_post_breadcrumbs();
/* END Breadcrums Container Section */

$custom = get_post_custom($id);
while (have_posts()) : the_post();
  $newsdate = date('jS F Y', $custom["fhg_news_startdate"][0]);
  $newsdate_ar = transfullmonth((date('d F Y', $custom["fhg_news_startdate"][0])));

  ?>
  <!-- START Media centre PressRelease Details Container Section -->
  <div class="arrowmaincontainer">
    <div class="arrowcontainer">
      <?php get_prev_next_link('news'); ?>
    </div>
  </div>
  <div class="container-fluid">
    <div class="row">
      <!--  <?php get_prev_next_link('news'); ?> -->
      <div class="container">
        <div class="eventdetailMain">
          <div class="eventDetpartone">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-16"></div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-16 innerpageContent eventDetailContainer">      
              <div class="eventHeading"><?php the_title($before, $after); ?></div>
              <div class="borderTop">&nbsp;</div>
              <div class="date"><span><?php echo custom_translate($newsdate, $newsdate_ar); ?></span></div>
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