<?php
/**
 * Template Name: Press Release
 * @package WordPress
 * @subpackage fhg-theme
 * @since FHG CAPM Theme
 */
get_header();

/* Start Banner Section */
get_header_banner_image($post->ID, get_the_title());
/* END Banner Section */

/* START Breadcrums Container Section */
get_post_breadcrumbs();
/* END Breadcrums Container Section */

/* START Media centre Events Container Section */
get_media_content_sections('[featured-news]', custom_translate('More Press Releases', 'المزيد من البيانات الصح�?ية'), "fhg_news_startdate", '[latest-newss]',custom_translate('FEATURED','الأبرز'),'','','press-releases','press-previous');
/* END Media centre Events Container Section */
?>


<?php get_footer(); ?>