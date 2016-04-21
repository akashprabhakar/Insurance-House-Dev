<?php
/**
 * Template Name: Products Pages
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
  <div class="container" id="content-area">
    <div class="credit_cards">
      <div class="tabMenu">
        <?php get_pf_tabs();?>
        
          <div class="tabsubMenu tabsubMenuNew">
            <?php if (strpos(get_permalink(get_the_id()), 'credit-cards') !== false) {
        if (shortcode_exists('shrt_credit_cards_comparison_content')) {
          echo do_shortcode('[shrt_personal_finance_credit_cards]');
        }
      }?>
          </div>
      </div>
    </div>
    <!--/.row--> 
 

<?php 
    while (have_posts()) : the_post(); 
      $custom = get_fields();

	  //print_r($custom);?>

        <div class="row">
         <div class="cardLeftBox">
        <img src="<?php echo $custom['left_image']['url']; ?>" class="alignnone size-full wp-image-6722">
        <ul class="applyNowBox">
        <li><a class="apply_now applybtn applyNowBtn" href="<?php echo $custom['add_apply_now_link']; ?>">Apply Now</a></li>
        <li>OR</li>
        <li class="callNowBtn">Call Us on: <a href="tel:80034"><?php echo $custom['add_contact_us_info']; ?></a></li>
        </ul>
        </div>
        <div class="cardCustomRightBox">
          <?php echo $custom['add_right_content']; ?>
          <?php get_applynowform(); ?>
        </div>

        </div>
	

        
        <div class="cardDtlsBox">
        <?php if(!empty($custom['rewards_field']) || !empty($custom['ease_field']) || !empty($custom['protection_field']) || !empty($custom['eligibility_field']) || !empty($custom['required_documents_field'])){ ?>
        <div class="topCardDtlsLink">
          <ul class="nav nav-tabs platinumlisting">
            <?php if(!empty($custom['rewards_field'])){ ?><li class="active"><a href="#tab11" data-toggle="tab">Rewards<br> &amp; Offers</a></li> <?php } ?>
            <?php if(!empty($custom['ease_field'])){ ?><li class=""><a href="#tab12" data-toggle="tab">Ease and<br> Convenience</a></li> <?php } ?>
            <?php if(!empty($custom['protection_field'])){ ?><li class=""><a href="#tab13" data-toggle="tab">Protection<br>&nbsp;<br></a></li> <?php } ?>
            <?php if(!empty($custom['eligibility_field'])){ ?><li class=""><a href="#tab14" data-toggle="tab">Eligibility<br>&nbsp;<br></a></li> <?php } ?>
            <?php if(!empty($custom['required_documents_field'])){ ?><li class=""><a href="#tab15" data-toggle="tab">Required<br> documents</a></li> <?php } ?>
          </ul>
          <div class="tab-content">
            <?php if(!empty($custom['rewards_field'])){ ?>
            <div id="tab11" class="tab-pane active">
              <div class="cardDtlsBoxContent">
              <?php echo $custom['rewards_field']; ?>
              </div>
            </div>
            <?php } ?>
            <?php if(!empty($custom['ease_field'])){ ?>
            <div id="tab12" class="tab-pane">
              <div class="cardDtlsBoxContent">
                <?php echo $custom['ease_field']; ?>
              </div>
            </div>
            <?php } ?>
            <?php if(!empty($custom['protection_field'])){ ?>
            <div id="tab13" class="tab-pane">
              <div class="cardDtlsBoxContent">
                <?php echo $custom['protection_field']; ?>
              </div>
            </div>
            <?php } ?>
            <?php if(!empty($custom['eligibility_field'])){ ?>
            <div id="tab14" class="tab-pane">
              <div class="cardDtlsBoxContent">
                <?php echo $custom['eligibility_field']; ?>
              </div>
            </div>
            <?php } ?>
            <?php if(!empty($custom['required_documents_field'])){ ?>
            <div id="tab15" class="tab-pane">
              <div class="cardDtlsBoxContent">
                <?php echo $custom['required_documents_field']; ?>
              </div>
            </div>
            <?php } ?>
          </div>
        </div>
        <?php } ?>
        <div class="bottomCardDtlsLink">
        <ul class="row">
          <li class="col-md-4 col-sm-4 col-xs-12"><a href="<?php echo $custom['terms_and_conditions_field']['url']; ?>" target="_blank">Terms &amp; Conditions</a></li>
          <li class="col-md-4 col-sm-4 col-xs-12"><a href="<?php echo $custom['faq_content']; ?>" target="_blank">FAQ’s</a></li>
           <?php if(!empty($custom['fees_and_charges_field'])){ ?>
          <li class="col-md-4 col-sm-4 col-xs-12"><a id="fees_charges_a" class="fees_charges" href="#fees_charges">Fees Charges</a></li>
          <?php } ?>
        </ul>
        </div>
		 </div>

 <?php if(!empty($custom['fees_and_charges_field'])){ ?>
                 <div class="fees_container">
              <div class="col-md-12">
                <div class="servicecharges">
                  <?php echo $custom['fees_and_charges_field']; ?>
                </div>
              </div>
            </div>
     
 <?php } ?>



      </div>
      <?php if(!empty($custom['display_credit_cards_field'])){ ?>
      <div class="container-fluid selectedCardDtls">
        <div class="container">
          <div class="row">
            <div class="col-md-5 col-sm-12 col-md-offset-1 col-sm-offset-1 col-xs-12">
            <h4><?php echo $custom['display_credit_cards_field']; ?></h4>
            <p><a href="<?php echo $custom['display_credit_cards_page_link']; ?>">Apply Now</a></p></div>
            <div class="col-md-5 col-sm-12 col-xs-12"><img class="alignnone size-full wp-image-7153" src="<?php echo $custom['display_credit_cards_image']['url']; ?>" alt="titanumBigCard" /></div>
          </div>
        </div>
      </div>
      <?php } ?>
      



        <!--  Three block /services -->
  <?php if(!empty($custom['our_services_field'])){?>
    <div class="container">
    <div class="overviewBoxes">
        <?php echo $custom['our_services_field']; ?>
      <div class="row">
        <?php $counter = 1; while($counter <=3) { ?>
        <div class="col-sm-4 col-md-4 col-xs-4 tblBox tblBoxborder">
          <div class="thumbnail">
            <?php echo $custom['service_tab_'.$counter]; ?>

          </div>
        </div>
        <?php $counter++; } ?>
      </div>
    </div>
    </div>
  <?php } ?>
      
    <?php endwhile; ?>
</section>
 
<?php get_footer(); ?>

