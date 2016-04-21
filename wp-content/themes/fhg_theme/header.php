<!DOCTYPE html>
<html <?php language_attributes(); ?>>
 <head itemscope>
 	<meta charset="utf-8">
 	 <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no" />
     <meta charset="<?php bloginfo('charset'); ?>">

    <meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <meta name="description" content="<?php echo esc_attr(get_bloginfo('description')); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

     <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />

<!-- CHNAGES of CSS SWITCH FROM ENGLISH TO ARABIC -->
    <?php
    if (check_arabic()) {
      ?>
       <!--[if IE 8 ]>   <link href="<?php echo get_template_directory_uri(); ?>/includes/css/style_ie8_ar.css" rel="stylesheet">   <![endif]-->
	   <!--[if IE]> <link href="<?php echo get_template_directory_uri(); ?>/includes/css/style_ie.css" rel="stylesheet">   <![endif]-->
      <?php
      $siteurl = SITE_URL . '/ar';
    } else {
      ?>
      <!--[if IE 8 ]>   <link href="<?php echo get_template_directory_uri(); ?>/includes/css/style_ie8.css" rel="stylesheet">   <![endif]-->
                  <!-- <link href="<?php echo get_template_directory_uri(); ?>/includes/css/style.css" rel="stylesheet" type="text/css">   -->     
      <!--[if IE]> <link href="<?php echo get_template_directory_uri(); ?>/includes/css/style_ie.css" rel="stylesheet">   <![endif]-->
    <?php
      $siteurl = SITE_URL;
    }
    ?>



    <link rel="profile" href="http://gmpg.org/xfn/11">
     <!--[if IE]>
        <script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.js" type="text/javascript"></script>
    <![endif]-->

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header id="header">
  <?php
  // get_template_part('template-part', 'head'); 
  get_template_part('template-part', 'headermenu'); 
  get_template_part('template-part', 'mainmenu');
  ?>
</header>




