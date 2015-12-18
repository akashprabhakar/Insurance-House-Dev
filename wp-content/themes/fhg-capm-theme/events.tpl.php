<?php
/**
 * Template Name: Events
 * @package WordPress
 * @subpackage fhg-capm-theme
 * @since fhg-capm-theme 1.0
 */
get_header();
/* Start Banner Section */
get_header_banner_image($post->ID, get_the_title());
/* END Banner Section */

/* START Breadcrums Container Section */
get_primary_breadcrumbs();
/* END Breadcrums Container Section */

/* START Media centre Events Container Section */
get_media_content_sections('', custom_translate('Events & Sponsorships', 'الأحداث والرعاية'), "fhg_events_startdate", '[events]');
/* END Media centre Events Container Section */
?>

</div>
<!-- END Media centre Events Details Container Section --> 
<?php get_footer(); ?>