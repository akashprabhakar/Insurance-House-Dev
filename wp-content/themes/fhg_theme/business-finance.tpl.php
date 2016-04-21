<?php
/**
 * Template Name: Business Finance
 * @package WordPress
 * @subpackage custom-theme
 * @since custom-theme
 */
get_header();

/* Start Banner Section */
get_header_banner_image($post->ID, get_the_title());
/* END Banner Section */

/* START Breadcrums Container Section */
get_post_breadcrumbs()
/* END Breadcrums Container Section */
?>
<section id="recent-works">
<?php 
    while (have_posts()) : the_post(); 
      $custom = get_fields(); //print_r($custom);?>
        <div class="container">
          <div class="row">
            <?php the_content(); ?>
          </div>
		  
      <?php endwhile; ?>
		      <div id="applynowfrm" class="finance_applynowfrm">
		        <?php echo custom_translate(do_shortcode('[contact-form-7 id="1660" title="Apply Now"]'), do_shortcode('[contact-form-7 id="1666" title="Apply Now - Arabic"]')); ?>
          </div>
		
      <?php if(!empty($custom['terms_and_conditions_field'])){ ?>
		
        <div class="footerCardFaqLink pf_financeFaqcontainer businessfooterCardFaqLink">
          <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12 col-md-offset-4 col-sm-offset-4">
              <a href="<?php echo $custom['terms_and_conditions_field']['url']; ?>" target="_blank">Terms &amp; Conditions</a>
            </div>
				
            <?php if(!empty($custom['faq_content'])){ ?>
              <div class="col-md-4 col-sm-4 col-xs-12 col-md-pull-2 col-sm-pull-2">
                <a href="<?php echo $custom['faq_content']; ?>" target="_blank">FAQ’s</a>
              </div>
			       <?php } ?>
             <?php if(!empty($custom['fees_and_charges_field'])){ ?>
			<div class="col-md-4 col-sm-4 col-xs-12"><a id="fees_charges_a" class="fees_charges" href="#fees_charges">Fees Charges</a></div>
             <!--Fees and Chargers--> 
            <div class="fees_container ">
              <div class="col-md-12">
                <div class="servicecharges">
                  <?php echo $custom['fees_and_charges_field']; ?>
                </div>
              </div>
            </div>
			 <?php } ?>
            <!--Fees and Charges-->
          </div>
        </div>

                <div class="cardDtls pf_cardDtls">
          <ul class="nav nav-tabs bluecardlist">
            <?php if(!empty($custom['rewards_field'])){ ?><li class="active"><a href="#tab11" data-toggle="tab">Rewards<br> &amp; Offers</a></li> <?php } ?>
            <?php if(!empty($custom['ease_field'])){ ?><li class=""><a href="#tab12" data-toggle="tab">Ease and<br> Convenience</a></li> <?php } ?>
            <?php if(!empty($custom['protection_field'])){ ?><li class=""><a href="#tab13" data-toggle="tab">Protection<br>&nbsp;<br></a></li> <?php } ?>
            <?php if(!empty($custom['eligibility_field'])){ ?><li class=""><a href="#tab14" data-toggle="tab">Eligibility<br>&nbsp;<br></a></li> <?php } ?>
            <?php if(!empty($custom['required_documents_field'])){ ?><li class=""><a href="#tab15" data-toggle="tab">Required<br> documents</a></li> <?php } ?>
          </ul>
          <div class="tab-content">
            <?php if(!empty($custom['rewards_field'])){ ?>
            <div id="tab11" class="tab-pane active">
              <div class="cardBoxContent">
              <?php echo $custom['rewards_field']; ?>
              </div>
            </div>
            <?php } ?>
            <?php if(!empty($custom['ease_field'])){ ?>
            <div id="tab12" class="tab-pane">
              <div class="cardBoxContent">
                <?php echo $custom['ease_field']; ?>
              </div>
            </div>
            <?php } ?>
            <?php if(!empty($custom['protection_field'])){ ?>
            <div id="tab13" class="tab-pane">
              <div class="cardBoxContent">
                <?php echo $custom['protection_field']; ?>
              </div>
            </div>
            <?php } ?>
            <?php if(!empty($custom['eligibility_field'])){ ?>
            <div id="tab14" class="tab-pane">
              <div class="cardBoxContent">
                <?php echo $custom['eligibility_field']; ?>
              </div>
            </div>
            <?php } ?>
            <?php if(!empty($custom['required_documents_field'])){ ?>
            <div id="tab15" class="tab-pane">
              <div class="cardBoxContent">
                <?php echo $custom['required_documents_field']; ?>
              </div>
            </div>
            <?php } ?>
          </div>
       

        
     </div>
		<?php } ?> </div>
            
  
</section>
 
<?php get_footer(); ?>

