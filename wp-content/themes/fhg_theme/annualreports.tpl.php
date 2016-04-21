<?php
/**
 * Template Name: Annual Reports
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

/* START Media centre Events Container Section */
get_media_content_sections('[featured-annualreports]', custom_translate('PREVIOUS REPORTS', 'PREVIOUS REPORTS'), "", '[all-annualreports]',get_the_title(),'',get_the_content());
/* END Media centre Events Container Section */

get_footer(); ?>