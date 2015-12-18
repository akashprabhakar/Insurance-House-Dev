<?php

/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package FHG CAPM Theme
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <?php //bloginfo('rss_url'); ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width; initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
    <title><?php
      /* Print the <title> tag based on what is being viewed. */
      global $page, $paged;
      global $current_user;
      get_currentuserinfo();
      wp_title('|', true, 'right');
      // Add a page number if necessary:
      if ($paged >= 2 || $page >= 2)
        echo ' | ' . sprintf(__('Page %s', 'fhg-capm-theme'), max($paged, $page));
      ?>
    </title>

    <link rel="profile" href="http://gmpg.org/xfn/11">

    <!--[if IE]>
        <script src="<?php echo get_template_directory_uri(); ?>/includes/js/html5shiv.js" type="text/javascript"></script>
    <![endif]-->
	

    <!-- CHNAGES of CSS SWITCH FROM ENGLISH TO ARABIC -->
    <?php
      if (check_arabic()) {
      ?>
      <!-- MODIFY STYLE.CSS NAME TO THE RESPECTIVE ARABIC FILE -->
      <link  type="text/css" rel='stylesheet' href="<?php echo get_template_directory_uri(); ?>/includes/css/ar_style.css"/>

      <!--<link  type="text/css" rel='stylesheet' href="<?php //echo get_template_directory_uri(); ?>/includes/css/bootstrap_ar.css"/>-->
      <link  type="text/css" rel='stylesheet' href="<?php echo get_template_directory_uri(); ?>/includes/css/lightbox_ar.css"/>
      <link href="<?php echo get_template_directory_uri(); ?>/includes/css/menu_style_ar.css" rel="stylesheet" type="text/css">
      <link href="<?php echo get_template_directory_uri(); ?>/includes/css/responsive_ar.css" rel="stylesheet" type="text/css">
      <link href="<?php echo get_template_directory_uri(); ?>/includes/css/owl.carousel_ar.css" rel="stylesheet">
      <!--[if IE 8 ]>   <link href="<?php echo get_template_directory_uri(); ?>/includes/css/style_ie8_ar" rel="stylesheet">   <![endif]-->
      <?php
      $siteurl = SITE_URL . '/ar';
    } else {
		
      ?>
   <!--    <link  type="text/css" rel='stylesheet' href="<?php echo get_template_directory_uri(); ?>/includes/css/style.css"/>
      <link  type="text/css" rel='stylesheet' href="<?php echo get_template_directory_uri(); ?>/includes/css/bootstrap.css"/> --> 
	  <!--[if IE 8 ]>   <link href="<?php echo get_template_directory_uri(); ?>/includes/css/style_ie8" rel="stylesheet">   <![endif]-->
                  <link href="<?php echo get_template_directory_uri(); ?>/includes/css/style.css" rel="stylesheet" type="text/css">       
                  <link href="<?php echo get_template_directory_uri(); ?>/includes/css/menu_style.css" rel="stylesheet" type="text/css">       
              
      <!--<link href="<?php //echo get_template_directory_uri(); ?>/includes/css/bootstrap.css" rel="stylesheet" type="text/css">-->

      <link href="<?php echo get_template_directory_uri(); ?>/includes/css/responsive.css" rel="stylesheet" type="text/css">
      <link href="<?php echo get_template_directory_uri(); ?>/includes/css/owl.carousel.css" rel="stylesheet">
      <link  type="text/css" rel='stylesheet' href="<?php echo get_template_directory_uri(); ?>/includes/css/lightbox.css"/>
      
     
      <?php $siteurl = SITE_URL;
    }
    ?>

    <!-- END OF CHNAGES of CSS SWITCH FROM ENGLISH TO ARABIC -->
    <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>-->
	 <link href="<?php echo get_template_directory_uri(); ?>/includes/css/full-slider.css" rel="stylesheet" type="text/css">
    <link href="<?php echo get_template_directory_uri(); ?>/includes/css/jquery.bxslider.css" rel="stylesheet" type="text/css">
    <link href="<?php echo get_template_directory_uri(); ?>/includes/css/owl.theme.css" rel="stylesheet">
	
    <script src="<?php echo INC_URL_JS . DS . "jquery_slider.js" ?>"></script>
    <script src="<?php echo INC_URL_JS . DS . "jquery.mobileMenu.js" ?>"></script>   
    <script src="<?php echo INC_URL_JS . DS . "jquery.blockUI.js" ?>" type="text/javascript"></script>
    <script src="<?php echo INC_URL_JS . DS . "analyticstracking.js" ?>" type="text/javascript"></script> 
    <script src="http://maps.googleapis.com/maps/api/js?language=en"></script>
     
    <script type="text/javascript">
     var onloadCallback = function() {
    //alert("grecaptcha is ready!");
    grecaptcha.render('RecaptchaFields1', {'sitekey' : '6LfA1w0TAAAAAIrHYoGsZ0Nty-pnYcT3EcMZwsIo'});
    grecaptcha.render('RecaptchaFields2', {'sitekey' : '6LfA1w0TAAAAAIrHYoGsZ0Nty-pnYcT3EcMZwsIo'});
    // grecaptcha.render('RecaptchaFields3', {'sitekey' : '6LfA1w0TAAAAAIrHYoGsZ0Nty-pnYcT3EcMZwsIo'});
    // grecaptcha.render('RecaptchaFields4', {'sitekey' : '6LfA1w0TAAAAAIrHYoGsZ0Nty-pnYcT3EcMZwsIo'});
  };
   
    </script>
    <?php wp_head(); ?>
  </head>
  <body>
    <div class="hoverLightBox"> &nbsp; </div>
    <!-- START header Section -->
    <header>
      <div class="container-fluid">
        <div class="row headerRowOne">
          <div class="container headermobileContainer">
            <div id="screen_resolution"></div>
            <div class="socialicons col-md-12 col-sm-13 col-xs-12">
              <!-- <p>
              <a><img src="<?php echo INC_URL_IMG . DS . 'facebook_20.png' ?>" alt="facebook_20"></a> 
              <a><img src="assets/images/twitter_20.png" alt="twitter_20"></a> 
              <a><img src="assets/images/linkedin_20.png" alt="linkedin_20"></a> 
              <a><img src="assets/images/youtube_20.png" alt="youtube_20"></a> 
              <a><img src="assets/images/instagram_20.png" alt="instagram_20"></a> 
              </p>-->            
            </div>
            <div class="headerRightContainer">
              <div class="tabMenu pull-right">
                <aside id="polylang-2">
                  <ul>
                    <li class="lang-item lang-item-15 lang-item-ar"> <?php if (dynamic_sidebar('sidebar')):else:endif; ?></li>
                  </ul>
                </aside>
                <?php include(DIR_THEME_ROOT . '/searchform.php'); ?>
              </div>
            </div>
          </div>
        </div>
        <div class="row headerRowTwo">
          <div class="navbar navbar-inverse">
            <div class="container">
              <!-- .navbar-header -->
              <div class="navbar-header"> 
                <a class="navbar-brand" href="<?php echo $siteurl; ?>"><img src="<?php echo INC_URL_IMG . DS . 'logo.png' ?>" alt=""></a>
                <!-- Button for smallest screens -->
                <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle pull-right" type="button">
                  <span class="icon-bar"></span> 
                  <span class="icon-bar"></span> 
                  <span class="icon-bar"></span> 
                </button>
                <!-- Button for smallest screens -->
              </div>
              <!-- /.navbar-header -->
              <!--.nav-collapse --> 

               <div class="navbar-collapse collapse collapseMini">
                 <ul class="nav navbar-nav pull-right">
                   
                   <div class="search_form_mobile">
                   <?php $search_form_action = esc_url(home_url(custom_translate("/", "/ar/"))) ?>
                    <form id="target" role="search_post" method="get" class="search-form-mobile" action="<?php echo $search_form_action; ?>" >
                      <div class="searchPannelMobile">
                        <input type="text"  id="global_search" class="searchtextbox search-field required" value="<?php echo esc_attr(get_search_query()); ?>" placeholder="<?php echo custom_translate('search here...', 'ابحث هنا...') ?>" name="s">
                      </div>
                    </form>
                  </div>
                    <?php 
                    //include('custom-menu.php');
                     custom_menus();
                    //custom_wp_nav_menu(); ?>
<!--                  <div class="callus_menu">
                    <?php //if (!dynamic_sidebar(custom_translate('Call Us', 'Call Us - Arabic'))) : else : endif; ?>
                  </div>-->
                  <div class="shareon_menu">
                    <?php echo get_followlinks(); ?>
                  </div>
                 </ul>
               </div>
              <!--/.nav-collapse -->
            </div>
          </div>
        </div>
      </div>
    </header>
    <!-- END header Section -->

    <!--Fixed header-->

    <div class="headerRowOne1 row headerRowOne" style="display:none;">
      <div class="container headermobileContainer">
        <div id="screen_resolution1"></div>
        <div class="scrollable_logo"><a href="<?php echo $siteurl; ?>"><img src="<?php echo INC_URL_IMG . DS . 'scrollable_logo.png' ?>" alt="capm small logo"></a></div>
        <!--<div class="socialicons col-md-12 col-sm-13 col-xs-12">
                     
        </div>-->
        <div class="headerRightContainer headerRightContainer_scrollable">
          <div class="tabMenu pull-right">
            <aside id="polylang-2">
              <ul>
                <li class="lang-item lang-item-15 lang-item-ar"> <?php if (dynamic_sidebar('sidebar')):else:endif; ?></li>
              </ul>
            </aside>
            <?php include(DIR_THEME_ROOT . '/searchform.php'); ?>
          </div>
        </div>
      </div>
    </div>



