<?php
/**
 * Template Name: Home Page English
 * @package WordPress
 * @subpackage FHG CAPM
 * @since 21 Aug 2015
 */

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

get_header();

$images = get_slider_images();
$counter = 0;
$i = 0;

?>




<!-- START Slider Section -->
<header id="myCarousel" class="carousel slide">
        <!-- Indicators -->
        <ol class="carousel-indicators">
        <?php foreach ($images as $image) { ?>
          <li data-target="#myCarousel" id="<?php echo 'slide' . $i; ?>" data-slide-to="<?php echo $i; ?>" ></li>
          <?php $i++;
        } ?>
        </ol>
        <!-- Wrapper for Slides -->
        <div class="carousel-inner">
        <?php $counter = 0;
        foreach ($images as $image) {// print_r($image);?>

          <div class="item" id="<?php echo 'image' . $counter; ?>">
             <div class="fill" style="background-image:url(<?php echo $image->title; ?>);"></div>
         <!--    <img src="<?php echo $image->title; ?>" height="718" alt=""/> -->
            <div class="col-lg-8 indicator">
             <?php if(!empty($image->youtube_url) || !empty($image->upload_video)) { ?><div class="slidervideo"><?php get_videos($image); ?></div> <?php } ?>   
            <a href="<?php echo custom_translate($image->img_link,$image->img_arabiclink); ?>">
              <div class="carousel-caption">
                <div class="caption_container">
                <h1><?php echo custom_translate($image->alt, $image->arabic_description); ?><span></span></h1>
                <p><?php echo custom_translate($image->comments, $image->arabic_comments); ?></p>
                </div> 
              </div>    
              </a>                       
            </div>
          </div>
          <?php $counter++;
        } ?>                          
      </div>
        <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="icon-prev"></span></a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="icon-next"></span></a>

    </header>
<!-- END Slider Section   --> 

<!-- START Mid Container Section -->
<div class="container-fluid">
      <div class="row">
    <div class="container">
          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-16">&nbsp;</div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-16 welcomeGroup">
       <?php dynamic_sidebar(custom_translate('Welcome Page', 'Welcome Page - Arabic')); ?>
      </div>
          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-16"></div>
        </div>
  </div>
    </div>

    <?php $boximages = homeboxes(); ?>
<div class="container">
  <div class="row">
    <!-- <div class="col-lg-1"></div>
    <div class="col-lg-14"> -->
    <div class="container">
      <div class="colmnHome">
        <ul>
        <?php $counter = 1;
        foreach ($boximages as $boximage) { ?>
                    <a href="<?php echo $boximage->img_link; ?>">
                    <li class="boxes<?php echo $counter; ?>">
                      <div class="boxBrown"><?php echo custom_translate($boximage->alt, $boximage->arabic_description); ?></div>
                      <img src="<?php echo $boximage->title; ?>" alt=""/> 
                    </li>
                    </a>
          <?php $counter++;
        } ?>
        </ul>
      </div>
<!--     </div> -->
    </div>
  </div>
</div>

    </div>
<!-- END Mid Container Section -->
<div class="container-fluid">
      <div class="row">
    <div class="container" id="homenewssection">
          <div class="col-lg-16 col-md-16 col-sm-16 col-xs-16 latestNewsContainer">
        <h1><?php echo custom_translate('Latest News','آخر الأخبار'); ?></h1>
        <div class="latestNewsmain">
          <div id="owl-demo" class="owl-carousel">
            <?php echo do_shortcode('[latest-news]'); ?>  
          </div>
        </div>
      </div>
        </div>
  </div>
    </div>
<!-- END Mid Container Section --> 
<?php get_footer(); ?>