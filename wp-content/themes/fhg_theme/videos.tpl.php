<?php
/**
 * Template Name: Videos
 * @package WordPress
 * @subpackage ant-fhg-capm
 * @since 21 Aug 2015
 */
// error_reporting(E_ALL);
// ini_set("display_errors",1);
get_header();

/* Start Banner Section */
get_header_banner_image($post->ID, get_the_title());
/*  END Banner Section */
/*  START Breadcrums Container Section */
get_topnav_breadcrumbs();
/*  END Breadcrums Container Section */
/*  Main-Content-Start */
$upload_dir = wp_upload_dir();
?>
<section id="video-gallery">
  <div class="container">
    <div class="row">
          <h1 class="content_header"><?php echo custom_translate('Video Gallery', 'معرض الصور'); ?></h1>


        <?php
        echo do_shortcode('[videosfunction]');
        ?>

  </div>
</section>

<!-- Content Area Start -->
<!-- Content Area End -->
<?php get_footer(); ?>