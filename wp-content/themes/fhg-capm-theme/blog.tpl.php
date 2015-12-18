<?php
/**Template Name: Blog
 * @package WordPress
 * @subpackage fhg-capm-theme
 * @since FHG CAPM Theme 1.0
 */
get_header();

/* Start Banner Section */
get_header_banner_image($post->ID, get_the_title());
/* END Banner Section */

/* START Breadcrums Container Section */
get_post_breadcrumbs();
/* END Breadcrums Container Section */

/* START Media centre Events Container Section */
get_media_content_sections('', custom_translate('Blog', 'مدونة'), "", '[blogs]');
/* END Media centre Events Container Section */
?>

</div>
</div>
<?php get_footer(); ?>