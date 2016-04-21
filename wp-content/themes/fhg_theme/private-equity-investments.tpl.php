<?php
/**
 * Template Name: Private Equity Investments
 * @package WordPress
 * @subpackage Custom-Theme
 * @since Custom Theme 1.0
 */
get_header();

/* Start Banner Section */
get_header_banner_image($post->ID, get_the_title());
/* END Banner Section */

/* START Breadcrums Container Section */
get_primary_breadcrumbs();
/* END Breadcrums Container Section */

/* START Media centre Events Container Section */
//get_media_content_sections('', custom_translate('Private Equity Investments', 'الأسهم الخاصة والاستثمارات'), "", '[display-pvt-investments]');
get_media_content_sections('', custom_translate('',''), "tf_events_pei_startdate", '[display-pvt-investments]',get_the_title(),'',$post->post_content,'emirates-review');
/* END Media centre Events Container Section */
?>

</div>
</div>
<?php get_footer(); ?>