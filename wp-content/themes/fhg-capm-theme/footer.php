<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package FHG CAPM Theme
 */
// Contact Us Form plugin only shows when the plugin is activated
// 1846


/* Footer-Start */
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

if (!function_exists('is_plugin_active') || !is_plugin_active('Contact/contact.php')) {
  
} else {
  echo do_shortcode('[contact_us]');
} 
?>


<!--  Contact Us Mobile Slider Version -->
<!--  Contact Us Mobile Slider Version -->
<div class="contactmobileslider">
  <a href="#" class="btn btn-default" id="contact_mobile">Contact Us</a>
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

<footer>
      <div class="container-fluid">
    <div class="row footerupperrow">
          <div class="container">
        <div class="footerupper">
              <ul>
               <li class="fifth">
                  <?php if (!dynamic_sidebar(custom_translate('Logos', 'Logos - Arabic'))) : else : endif; ?>
                </li>
                
            <li class="first">
                  <?php if (!dynamic_sidebar(custom_translate('Contacts', 'Contacts - Arabic'))) : else : endif; ?>
                </li>
            <li class="second">
              <?php if (!dynamic_sidebar(custom_translate('Subscribe to Newsletter', 'Subscribe to Newsletter - Arabic'))) : else : endif; ?>
                </li>
            <li class="third">
                  <?php if (!dynamic_sidebar(custom_translate('Finance House', 'Finance House - Arabic'))) : else : endif; ?>
                </li>
                  <li class="seventh">
                  <?php if (!dynamic_sidebar(custom_translate('Insurance House', 'Insurance House - Arabic'))) : else : endif; ?>
                </li>
            <li class="fourth">
                  <?php if (!dynamic_sidebar(custom_translate('Islamic Finance House', 'Islamic Finance House - Arabic'))) : else : endif; ?>
                </li>
           
            <li class="sixth"> </li>
          
            <li class="eight">
                 <?php if (!dynamic_sidebar(custom_translate('Finance House Securties', 'Finance House Securties - Arabic'))) : else : endif; ?>
                </li>
          </ul>
            </div>
      </div>
        </div>
  </div>

   
  <div class="container-fluid">
    <div class="row footerlowerrow">
      
        <div class="container">
        <div class="copyright">
              <?php if (!dynamic_sidebar(custom_translate('Footer', 'Footer - Arabic'))) : else : endif; ?>
			 
			  <?php if (!dynamic_sidebar(custom_translate('Font Resizer', 'Font Resizer - Arabic'))) : else : endif; ?>
              
            </div>
        </div>
      </div>
  </div>
</footer>
<!-- END Footer Section -->
<!-- Second Footer Section -->
<!--<div class="scroll-fix">
 <div class="container-fluid fixedFooter">     
    <div class="row footerlowerrow">
        <div class="container">
        <div class="copyright">
            <ul>
              <li><?php //if (!dynamic_sidebar(custom_translate('Fixed Footer Disablitiies', 'Fixed Footer Disablitiies - Arabic'))) : else : endif; ?></li>
              <li><?php //if (!dynamic_sidebar(custom_translate('Fixed Footer Font Zoom', 'Fixed Footer Font Zoom - Arabic'))) : else : endif; ?></li>
              <li><?php //if (!dynamic_sidebar(custom_translate('Fixed Footer Product', 'Fixed Footer Product - Arabic'))) : else : endif; ?></li>
              <li><?php //if (!dynamic_sidebar(custom_translate('Fixed Footer Phone', 'Fixed Footer Phone - Arabic'))) : else : endif; ?></li>
            <ul>
        </div>
      </div>
    </div>
  </div>
</div>-->


<!-- START Social Media feeds Section -->
<div class="container-fluid">
      <div class="row">

    <?php


$pagename = $post->post_name;
    
    if (!function_exists('is_plugin_active') || !is_plugin_active('social-feeds/social-feeds.php')) {
    } else {
		if(($pagename == 'contact') || ($pagename == '%d8%a7%d8%aa%d8%b5%d9%84-%d8%a8%d9%86%d8%a7')){
		} else {
      echo do_shortcode('[social_feeds]');  
		}
    }
 
    ?>
    <!-- </div> -->
  </div> 
</div>
<!-- END Social Media feeds Section -->
<!-- 1360 - to check is home page from JS -->
<input id="is_front_page" type="hidden" value="<?php echo is_front_page(); ?>" />
<!-- 1360 - to check is home page from JS -->

<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer> </script>
<?php
/* Footer-End */

wp_footer();
?>
</body>
</html>