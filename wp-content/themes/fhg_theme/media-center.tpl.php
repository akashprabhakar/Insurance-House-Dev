<?php
/**
 * Template Name: Media Center
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
// get_media_center_template();

/* END Media centre Events Container Section */


?>  

<section id="press-releases">
	<div class="container helpCentreBox">
		<h1 class="content-header">Press Releases</h1>
		<div class="row emiSlider_container">
			<?php echo do_shortcode('[featured-news newstemplate="media"]'); ?>
				

		</div>

		<h1 class="content-header">Events & Sponserships</h1>
		<div class="row">
			<?php echo do_shortcode('[events eventscount=6]'); ?>
		</div>
		
        <div id="video-gallery">
        	<h1 class="content-header">Video Gallery</h1>
			<div class="mediaGallery">
				<?php echo do_shortcode('[videosfunction]'); ?>
			</div>
        
        
        <div id="image-gallery">
        	<h1 class="content-header">Image Gallery</h1>
        	<?php picturessection(); ?>
        </div>

        <?php $custom = get_fields();?>
        <div id="recent-works">
        <a href="<?php echo $custom['two_page_link_block_1'];?>" class="readmore"><h1 class="content-header"><?php echo $custom['two_title_block_1'];?></h1></a>
        <div class="row mediaKit_Boxcontainer">
      <div class="mediaKit_Boxcontainer_one">
		<span class="mediaKit_arrow_leftOne"></span>
		<a href="<?php echo $custom['two_image_block_1'];?>" class="readmore"><img src="<?php echo $custom['two_image_block_1']['url'];?>" alt="media kit"></a>
		<?php echo $custom['two_content_block_1'];?>
      </div>
    </div>
</div>
	</div>
                </div>
</section>
<?php get_footer(); ?>