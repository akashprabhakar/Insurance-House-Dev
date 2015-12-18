<?php
/**
 * Template Name: Contact Us
 * @package WordPress
 * @subpackage fhg-capm-theme
 */
get_header();
?>

<!-- Start Google Map Banner Section -->
<div class="headerbanner">
  <div class="innerBanner">
	<div id="googleMap" style="width: 100%; height: 380px;"></div>	
  </div>
</div>
<!-- END Google Map Banner Section --> 
<!-- START Breadcrums Container Section -->
<?php get_primary_breadcrumbs() ?>
<!-- END Breadcrums Container Section --> 
<!--Main-Content-Start-->
<div class="container-fluid">
  <div class="row">
    
    <div class="container" id="contactusadd">
     <div class="col-lg-2 col-md-2 col-sm-2 col-xs-16 paddingleft"></div>
     <?php while (have_posts()) : the_post(); ?>
  
      <?php the_content(); ?>
     <?php endwhile; // end of the loop.   ?>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-16 paddingright"></div>
  </div>
    

          
           <div class="container" id="contactusadd">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-16 paddingleft"></div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-16">
              		  <div id="form_container" class="form_container">
                        <p><?php echo custom_translate('Please select what your inquiry is about', 'يرجى منك تحديد طلبك') ?></p>
                        <form class="maindrop">  
                        <div class="droparrow1">
                          <span class="wpcf7-form-control-wrap menu-product">
                            <select name="show" class="myclass" onchange="getForm(this.value);">
                              <option value="choose"><?php echo custom_translate('Choose', 'قائمة الاختيارات'); ?></option>
                              <option value="product"><?php echo custom_translate('Apply for a service', 'اطلب خدمةً'); ?></option>
                              <option value="feedback"><?php echo custom_translate('Feedback', 'ملاحظات'); ?></option>                           
                            </select>
                          </span>
                        </div>
                        </form>
                        <div class="apply-for-product none-class" id="apply-for-product"><?php echo getContactFormProduct(); ?></div>
                        <div class="feedback none-class" id="feedback"><?php echo getContactFormFeedback(); ?></div>
                      </div>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-16 paddingleft"></div>
	           </div>
      

      

    

  </div>
</div>  
</div>

<!--Main-Content-End-->

<?php get_footer(); ?>