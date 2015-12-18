<?php
/**
 * Template Name: Publications
 * @package WordPress
 * @subpackage fhg-capm-theme
 * @since FHG CAPM Theme
 */
get_header();
/* Start Banner Section */
get_header_banner_image($post->ID, get_the_title());
/* END Banner Section */

/* START Breadcrums Container Section */
get_primary_breadcrumbs();
/* END Breadcrums Container Section */

/* START Media centre Events Container Section */

get_media_content_sections('[featured-publications]', custom_translate('More Publications', 'المزيد من المنشورات'), "fhg_publications_startdate", '[all-publications]');
/* END Media centre Events Container Section */
?>  

</div>
</div>
<?php get_footer(); ?>