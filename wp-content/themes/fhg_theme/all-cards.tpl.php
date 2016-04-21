<?php
/**
 * Template Name: All Cards Pages
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
            <?php echo do_shortcode('[shrt_personal_finance_credit_cards]');?>
          </div>
      </div>
    </div>
    <!--/.row--> 
  </div>
  <!--/.container-->

<?php 
    while (have_posts()) : the_post(); 
      the_content();
  
    endwhile;
?>
<div class="container-fluid">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 customercontainer">
        <div class="container ">
          <div class="row">
      
          <div class="ccf_commonPage"><div class="col-md-6 col-sm-12 col-xs-12 customercontainerimg"><img alt="" src="http://61.16.194.220:8080/finance_house_v2/wp-content/uploads/2015/10/Customer_Referral_Program_image.jpg"></div>
                    <div class="col-md-6 col-sm-12 col-xs-12"><h1><a href="http://61.16.194.220:8080/finance_house_v2/en/section/personal-finance/credit-cards/customer-referral-program">Customer Referral Program</a></h1><p>Refer credit card customers to Finance House and earn 1% of their total card spend ‎credited to your account.
The customer your refer will benefit from:‎</p>
<ul>
<li>Free for life credit card</li>
<li>No annual fees</li>
<li>Best balance transfer with 5% Guaranteed Cashback</li>
<li>Highest grace period in the UAE of up</li></ul>
                    <div class="ccf_commonPage_readmore"><a href="http://61.16.194.220:8080/finance_house_v2/en/section/personal-finance/credit-cards/customer-referral-program" class="readmore"> Read More</a></div></div> </div>           
                </div>
        </div>
      </div>
    </div>
  </div>

</section>
 
<?php get_footer(); ?>