<?php
/**
 * Template Name: Financial Reports
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
get_media_content_sections('[latest-finance]', custom_translate('PREVIOUS REPORTS', 'التقارير السابقة'), "fh_financial_reports_startdate", '[all-financialreports]',get_the_title(),'',$post->post_content,'emirates-review');
/* END Media centre Events Container Section */
?>  


<?php get_footer(); ?>

