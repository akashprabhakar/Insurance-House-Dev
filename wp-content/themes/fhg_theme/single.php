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
get_header_banner_image_with_custom_title(1162, 'blog_title_text');
/* END Banner Section */

/* START Breadcrums Container Section */
get_post_breadcrumbs();
/* END Breadcrums Container Section */

$custom = get_post_custom($id);
while (have_posts()) : the_post();
  $eventsdate = date('jS F Y', $custom["fhg_blog_startdate"][0]);
  $eventsdate_ar = transfullmonth((date('d F Y', $custom["fhg_blog_startdate"][0])));
  setPostViews(get_the_ID());
  ?>

<div class="arrowmaincontainer">
<div class="arrowcontainer">
  <?php get_prev_next_link(''); ?>
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