<?php
/**
 * Template Name: Home Page
 * @package WordPress
 * @subpackage FHG CAPM
 * @since 21 Aug 2015
 */
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

get_header();
$images = get_slider_images();

?>

<!-- Slider Section Starts -->

<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <?php foreach ($images as $imagekey => $image) { ?>
      <li data-target="#myCarousel" id="<?php echo 'slide' . $imagekey; ?>" data-slide-to="<?php echo $imagekey; ?>" ></li>
    <?php } ?>
  </ol>
  <div class="carousel-inner" role="listbox">
    <?php foreach ($images as $imagekey => $image) { ?>        
        <div class="item <?php echo (($imagekey==0) ? 'active' : '' ) ?>"> 	
          <?php $image_alt = custom_translate($image->alt, $image->arabic_description);
				$commentsval = custom_translate($image->comments, $image->arabic_comments); 
		  ?>
          <a href="<?php echo custom_translate($image->img_link, $image->img_arabiclink); ?>">
          <img class="<?php echo 'image' . $imagekey; ?>" src="<?php echo $image->title; ?>" alt="<?php echo $image_alt; ?>">
		   <?php if (!empty($image_alt) || !empty($commentsval) || !empty($image->youtube_url) || !empty($image->upload_video) ) { ?>
          <div class="container">
            <?php if (!empty($image->youtube_url) || !empty($image->upload_video) ) { ?>
              <div class="slidervideo">
                <?php get_videos($image); ?>
              </div> 
            <?php } ?> 
			
            <div class="carousel-caption">
              <div>
                <h1>
                 <!--  <img src="<?php //echo INC_URL_IMG . DS ?>banner_house_finance_img.png"> -->
                  <?php echo $image_alt; ?>
                </h1>
              </div>
              <?php echo $commentsval; ?>
            </div>
			 
          </div>
		  <?php } ?> 
          </a>      
        </div>
    <?php } ?>
  </div>
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span></span>
  <!--<span class="sr-only">Previous</span> -->
  </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span></span>
  <!--<span class="sr-only">Next</span>-->
  </a> </div>

<!--/#main-slider-->

                         
<!-- Slider Section Ends -->
<section id="recent-works">
  <div class="container">
    <div class="center wow ">
      <!-- Welcome Section Starts   --> 
      <?php dynamic_sidebar(custom_translate('Welcome Page', 'Welcome Page - Arabic')); ?>
      <!-- Welcome Section Ends   --> 
    </div>
    <div class="row">
    <div class="boxContainer">
      <!-- Home Boxes Section Starts  --> 
      <?php $boximages = homeboxes(); ?>
      <?php foreach ($boximages as $boxkey => $boximage) { ?>
      <div class="item box<?php echo $boxkey+1; ?>">
        <div class="recent-work-wrap"> 
          <a href="<?php echo custom_translate($boximage->img_link, $boximage->img_arabiclink); ?>">
            <div class="recent-work-inner">
              <h2>
              <?php echo custom_translate($boximage->alt, $boximage->arabic_description); ?>
            </h2>
            </div>
            <img class="img-responsive" src="<?php echo $boximage->title; ?>" alt=""> 
          </a> 
        </div>
      </div>
      <?php } ?>
      <!-- Home Boxes Section Ends  --> 
      </div>
    </div>
    <div class="row">
      <!-- Latest News Section Start  --> 
      <div class="col-md-12 newsSection">
        <div class="center wow ">
          <h1><?php echo custom_translate('Latest News', 'آخر الأخبار'); ?></h1>
        </div>
        <div id="owl-demo" class="owl-carousel">
          <?php echo do_shortcode('[latest-news]'); ?>  
        </div>
      </div>
      <!-- Latest News Section Ends  --> 
    </div>
    <!--/.row-->
  </div>
  <!--/.container-->
</section>

<?php get_footer(); ?>