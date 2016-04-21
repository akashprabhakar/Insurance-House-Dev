<?php
/**
 * Template Name: Emirates Review
 * @package WordPress
 * @subpackage Custom-Theme
 * @since Custom Theme 1.0
 */
get_header();

/* Start Banner Section */
get_header_banner_image($post->ID, get_the_title());
/* END Banner Section */

/* START Breadcrums Container Section */
get_post_breadcrumbs();
/* END Breadcrums Container Section */
//START Media centre Events Container Section */
get_media_content_sections('[latest-emirates]', custom_translate('PREVIOUS ISSUES', 'PREVIOUS ISSUES'), "fh_emirates_review_startdate", '[all-emiratesmagazines]',get_the_title(),'',$post->post_content,'emirates-review');
/* END Media centre Events Container Section */
  


get_footer(); ?>