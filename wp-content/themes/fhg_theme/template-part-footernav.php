
<?php
/* Footer-Start */

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );


if (!function_exists('is_plugin_active') || !is_plugin_active('Contact/contact.php')) {
  
} else {
      if (($pagename == 'contact') || ($pagename == '%d8%a7%d8%aa%d8%b5%d9%84-%d8%a8%d9%86%d8%a7')|| ($pagename == 'investor-relationcontact-us') || ($pagename == '%d8%a7%d8%aa%d8%b5%d9%84-%d8%a8%d9%86%d8%a7-2') || ($pagename == 'media') || ($pagename == '%d9%85%d8%b1%d9%83%d8%b2-%d8%a7%d9%84%d8%a5%d8%b9%d9%84%d8%a7%d9%85')|| ($pagename == 'news') || ($pagename == '%d8%a7%d9%84%d8%a8%d9%8a%d8%a7%d9%86%d8%a7%d8%aa-%d8%a7%d9%84%d8%b5%d8%ad%d9%81%d9%8a%d8%a9')|| ($pagename == 'events-sponserships') || ($pagename == '%d8%a7%d9%84%d8%b1%d8%b9%d8%a7%d9%8a%d8%a9-%d9%88%d8%a7%d9%84%d9%81%d8%b9%d8%a7%d9%84%d9%8a%d8%a7%d8%aa')|| ($pagename == 'videos') || ($pagename == '%d8%a7%d9%84%d9%81%d9%8a%d8%af%d9%8a%d9%88')|| ($pagename == 'pictures') || ($pagename == '%d8%a7%d9%84%d8%b5%d9%88%d8%b1')|| ($pagename == 'media-kit') || ($pagename == 'media-kit-2') || (strpos(get_permalink(), "News")) || (strpos(get_permalink(), "events"))) {
        
      } else { ?>
       
          <?php  echo do_shortcode('[contact_us]'); ?>
       
      <?php }
    }
?>

<!-- START Social Media feeds Section -->

<div class="container-fluid socialmediafeed_container">
  <div class="row">
    <div class="socialFeeds">
      <ul class="nav-social mobilesocialicons">
        <li><a onclick="return false;" class="facebook social-anchor" href="#"><i class="fa fa-facebook"></i></a></li>
        <li><a onclick="return false;" class="twitter social-anchor" href="#"><i class="fa fa-twitter"></i></a></li>
        <li><a onclick="return false;" class="youtube social-anchor" href="#"><i class="fa fa-youtube"></i></a></li>
        <li><a onclick="return false;" class="linkedin social-anchor" href="#"><i class="fa fa-linkedin"></i></a></li>
        <li><a onclick="return false;" class="instagram social-anchor" href="#"><i class="fa fa-instagram"></i></a></li>
      </ul>
      <div class="closeBtn"><i class="fa fa-times"></i>
</div>
   
    <?php  echo do_shortcode('[social_feeds]'); ?> </div>
  </div>
</div>
</div>

<!-- END Social Media feeds Section --> 

<!--  Contact Us Mobile Slider Version -->
<div class="contactmobileslider contactLeftContainer"> <a href="javascript:void(0);" class="btn" id="contact_mobile"><?php echo custom_translate('Contact Us', 'اتصل بنا') ?></a>
  <div id="contactformmobile">
    <?php
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    if (!function_exists('is_plugin_active') || !is_plugin_active('Contact/contact.php')) {
      
    } else {
      echo do_shortcode('[contact_us_mobile]');
    }
    ?>
  </div>
</div>

<section id="conatcat-info">
  <div class="container">
    <div class="row">
      <?php if (!dynamic_sidebar(custom_translate('Subscribe to Newsletter', 'Subscribe to Newsletter - Arabic'))) : else : endif; ?>
    </div>
  </div>
  <!--/.container-->
</section>
<!--/#conatcat-info-->
<section id="bottom">
  <div class="container wow">
    <div class="row">
      <div class="column">
        <div class="widget">
          <?php if (!dynamic_sidebar(custom_translate('Insurance House', 'Insurance House - Arabic'))) : else : endif; ?>
        </div>
      </div>
      <!--/.col-md-3-->
      <div class="column">
        <div class="widget">
          <?php if (!dynamic_sidebar(custom_translate('Islamic Finance House', 'Islamic Finance House - Arabic'))) : else : endif; ?>
        </div>
      </div>
      <!--/.col-md-3-->
      <div class="column">
        <div class="widget">
          <?php if (!dynamic_sidebar(custom_translate('Finance House Securties', 'Finance House Securties - Arabic'))) : else : endif; ?>
        </div>
      </div>
      <!--/.col-md-3-->
      <div class="column">
        <div class="widget">
          <?php if (!dynamic_sidebar(custom_translate('CAPM', 'CAPM - Arabic'))) : else : endif; ?>
        </div>
      </div>
      <div class="column">
        <div class="widget">  
          <?php if (!dynamic_sidebar(custom_translate('Contacts', 'Contacts - Arabic'))) : else : endif; ?>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="socialMediaContainer">
          <div class="col-xs-12 col-md-6 col-sm-12">
            <div class="emirateslogo"><?php if (!dynamic_sidebar(custom_translate('Logos', 'Logos - Arabic'))) : else : endif; ?></div>
          </div>
          <div class="col-xs-12 col-md-6 col-sm-12">
            <div class="socialmediaicons">
              <?php if (!dynamic_sidebar(custom_translate('Social Follow', 'Social Follow - Arabic'))) : else : endif; ?>
            </div>
          </div>
        </div>
      </div>
      <!--/.col-md-3-->
    </div>
  </div>
</section>
<!--/#bottom-->
<footer id="footer" class="midnight-blue">
  <div class="container">
    <div class="row">
    <div class="footerInner">
      <?php if (!dynamic_sidebar(custom_translate('Footer', 'Footer - Arabic'))) : else : endif; ?>
      </div>
    </div>
  </div>
</footer>
<!--/#footer-->

<!-- START Social Media feeds Section -->
  <?php
    $pagename = $post->post_name;
    if (!function_exists('is_plugin_active') || !is_plugin_active('social-feeds/social-feeds.php')) {
      
    } else {
      if (($pagename == 'contact') || ($pagename == '%d8%a7%d8%aa%d8%b5%d9%84-%d8%a8%d9%86%d8%a7')|| ($pagename == 'media') || ($pagename == '%d9%85%d8%b1%d9%83%d8%b2-%d8%a7%d9%84%d8%a5%d8%b9%d9%84%d8%a7%d9%85')|| ($pagename == 'news') || ($pagename == '%d8%a7%d9%84%d8%a8%d9%8a%d8%a7%d9%86%d8%a7%d8%aa-%d8%a7%d9%84%d8%b5%d8%ad%d9%81%d9%8a%d8%a9')|| ($pagename == 'events-sponserships') || ($pagename == '%d8%a7%d9%84%d8%b1%d8%b9%d8%a7%d9%8a%d8%a9-%d9%88%d8%a7%d9%84%d9%81%d8%b9%d8%a7%d9%84%d9%8a%d8%a7%d8%aa')|| ($pagename == 'videos') || ($pagename == '%d8%a7%d9%84%d9%81%d9%8a%d8%af%d9%8a%d9%88')|| ($pagename == 'pictures') || ($pagename == '%d8%a7%d9%84%d8%b5%d9%88%d8%b1')|| ($pagename == 'media-kit') || ($pagename == 'media-kit-2') || (strpos(get_permalink(), "News")) || (strpos(get_permalink(), "events"))) {
        
      } else { ?>
        <!-- START Social Media feeds Section -->
      <div class="container-fluid desktopsocialslider">
        <div class="row">
          <?php  echo do_shortcode('[social_feeds]'); ?>
        </div>
      </div> 
      </div>
      <?php }
    }
    ?>
<!-- END Social Media feeds Section -->
<!-- 1360 - to check is home page from JS -->
<input id="is_front_page" type="hidden" value="<?php echo is_front_page(); ?>" />
<!-- 1360 - to check is home page from JS -->
<?php wp_footer(); ?>



