<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Custom Theme
 */
get_header();

/* Start Banner Section */
get_header_banner_image_with_fixed_title(64, custom_translate(get_the_title(64),get_the_title(560)));
/* END Banner Section */

/* START Breadcrums Container Section */
get_breadcrumb_wtout_parent(custom_translate(64, 560), custom_translate(get_the_title(64), get_the_title(560)));
/* END Breadcrums Container Section */

$custom = get_post_custom($id);
while (have_posts()) : the_post();
$date = date('jS F Y', $custom["fhg_news_startdate"][0]);    // eng date
$date_ar = transfullmonth(date('d F Y', $custom["fhg_news_startdate"][0])); //arabic date

//  $newsdate_ar = trans($newsdate_ar);
  ?>
  <!-- START Media centre PressRelease Details Container Section -->

  <div class="arrowmaincontainer">
<div class="arrowcontainer">
  <?php get_prev_next_link('news'); ?>
</div>
</div>

    <div class="container">
      <div class="row">
        <div class="innerpage">  
          <div class="eventdetailMain">  
            <div class="eventDetpartone">      
              <div class="eventHeading"><?php the_title(); ?></div>
              <div class="borderTop">&nbsp;</div>
              <div class="date"><span><?php echo custom_translate($date,$date_ar); ?></span></div>
              <div class="fhg-column-group leftColmp detailscontainer">
              <?php the_post_thumbnail(); the_content(); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

<?php endwhile; // end of the loop.  ?>

<?php get_footer(); ?>