<?php
/**
 * Template Name: Single Landing Page 2
 * @package WordPress
 * @subpackage FHG FH Theme
 * @since FHG FH Theme 1.0
 */
get_header();

/* Start Banner Section */
get_header_banner_image($post->ID, get_the_title());
/* END Banner Section */

/* START Breadcrums Container Section */
get_post_breadcrumbs();
wp_reset_query();
/* END Breadcrums Container Section */
$custom = get_fields();//print_r($custom);
// $count = 1;
while (have_posts ()) : the_post(); ?>

<section id="recent-works">
  <div class="container corporate_commercial_finance">
  <div class="center"><h1 class="content-header"><?php echo get_the_title(); ?></h1><?php echo get_the_content(); ?></div>
<?php endwhile; // end of the loop.
?>
    <?php if(!empty($custom['left_image']['url'])){ ?>
    <div class="row">
        <div class="cardLeftBox">
        <img alt="" src="<?php echo $custom['left_image']['url']; ?>" class="alignnone size-full wp-image-6722">
        <ul class="applyNowBox">
        <?php if(!empty($custom['add_apply_now_link'])){
          $link = $custom['add_apply_now_link'];
        } else if(!empty($custom['refer_a_friend'])){
          $link = $custom['refer_a_friend'];
        }
        ?>
        <li><a class="apply_now applybtn applyNowBtn" href="<?php echo $link; ?>"><?php echo custom_translate('Apply Now', 'قدم الآن');?></a></li>
        <li>OR</li>
        <li class="callNowBtn">Call Us on: <a href="tel:<?php echo $custom['add_contact_us_info']; ?>"><?php echo $custom['add_contact_us_info']; ?></a></li>
        </ul>
        </div>
        <div class="cardCustomRightBox">
          <?php echo $custom['add_right_content']; ?>
          <?php get_applynowform(); ?>
        </div>

    </div>
    <?php } ?>
  <!--  Three block /services -->
  <?php if(!empty($custom['add_services_content'])){?>
    <div class="overviewBoxes">
        <?php echo $custom['add_services_content']; ?>
      <div class="row">
        <?php $counter = 1; while($counter <=2) { ?>
        <div class="col-sm-6 col-md-6 col-xs-6 tblBox tblBoxborder">
          <div class="thumbnail">
            <?php echo $custom['two_content_block_'.$counter]; ?>

          </div>
        </div>
        <?php $counter++; } ?>
      </div>
    </div>
  <?php } ?>

    <!--  Two block /services -->
  <?php if(!empty($custom['add_services_content2'])){?>
    <div class="overviewBoxes">
        <?php echo $custom['add_services_content2']; ?>
      <div class="row">
        <?php $counter = 1; while($counter <=2) { ?>
        <div class="col-sm-6 col-md-6 col-xs-6 tblBox tblBoxborder customarrow">
          <div class="thumbnail">
            <?php echo $custom['two_2content_block_'.$counter]; ?>

          </div>
        </div>
        <?php $counter++; } ?>
      </div>
    </div>
  <?php } ?>


 

       <?php if(!empty($custom['rewards_field']) || !empty($custom['ease_field']) || !empty($custom['protection_field']) || !empty($custom['eligibility_field']) || !empty($custom['required_documents_field']) || !empty($custom['terms_and_conditions_field']['url']) || !empty($custom['faq_content']) || !empty($custom['fees_and_charges_field'])){ ?>
       <div class="cardDtlsBox">
        <?php if(!empty($custom['rewards_field']) || !empty($custom['ease_field']) || !empty($custom['protection_field']) || !empty($custom['eligibility_field']) || !empty($custom['required_documents_field'])){ ?>
        <div class="topCardDtlsLink">
          <ul class="nav nav-tabs platinumlisting">
            <?php if(!empty($custom['rewards_field'])){ ?><li class="active"><a href="#tab11" data-toggle="tab">Rewards<br> &amp; Offers</a></li> <?php } ?>
            <?php if(!empty($custom['ease_field'])){ ?><li class=""><a href="#tab12" data-toggle="tab">Ease and<br> Convenience</a></li> <?php } ?>
            <?php if(!empty($custom['special_privileges_content'])){ ?><li class=""><a href="#tab13" data-toggle="tab">Special<br>Privileges<br></a></li> <?php } ?>
            <?php if(!empty($custom['protection_field'])){ ?><li class=""><a href="#tab14" data-toggle="tab">Protection<br>&nbsp;<br></a></li> <?php } ?>
            <?php if(!empty($custom['eligibility_field'])){ ?><li class=""><a href="#tab15" data-toggle="tab">Eligibility<br>&nbsp;<br></a></li> <?php } ?>
            <?php if(!empty($custom['required_documents_field'])){ ?><li class=""><a href="#tab16" data-toggle="tab">Required<br> documents</a></li> <?php } ?>
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
            <?php if(!empty($custom['special_privileges_content'])){ ?>
            <div id="tab12" class="tab-pane">
              <div class="cardDtlsBoxContent">
                <?php echo $custom['special_privileges_content']; ?>
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
          <?php if(!empty($custom['terms_and_conditions_field']['url']) || !empty($custom['terms_and_conditions_page_link'])){ ?>
          <?php if(!empty($custom['terms_and_conditions_field']['url'])){
            $terms = $custom['terms_and_conditions_field']['url'];
          } else if(!empty($custom['terms_and_conditions_page_link'])){
            $terms = $custom['terms_and_conditions_page_link'];
          }
          ?>
          <li class="col-md-4 col-sm-4 col-xs-12"><a href="<?php echo $terms; ?>" target="_blank">Terms &amp; Conditions</a></li>
          <?php } ?>
          <?php if(!empty($custom['faq_content'])){ ?>
          <li class="col-md-4 col-sm-4 col-xs-12"><a href="<?php echo $custom['faq_content']; ?>" target="_blank">FAQ’s</a></li>
          <?php } ?>
          <?php if(!empty($custom['fees_and_charges_field'])){ ?>
          <li class="col-md-4 col-sm-4 col-xs-12"><a id="fees_charges_a" class="fees_charges" href="#fees_charges">Fees Charges</a></li>
          <?php } ?>
        </ul>
        </div>
     </div>
     <?php } ?>

    <!--  Three block /services -->
  <?php if(!empty($custom['our_services_field'])){?>
    <div class="overviewBoxes">
        <?php echo $custom['our_services_field']; ?>
      <div class="row">
        <?php $counter = 1; while($counter <=4) { ?>
        <div class="col-sm-3 col-md-3 tblBox fourBox">
          <div class="thumbnail">
            <?php echo $custom['service_tab_'.$counter]; ?>
          </div>
        </div>
        <?php $counter++; } ?>
      </div>
    </div>
  <?php } ?>
<!-- End Section 4 --> 
  </div>     <!-- end of container -->

      <?php if($custom['two_1image_block_1']!=""){ ?> 
       <div class="container-fluid">
    <div class="row share-registrar">
      <div class="col-md-12 col-sm-12 customercontainer">
        <div class="container ">
          <div class="row">
    
          <div class="ccf_commonPage">    
            <div class="col-md-6 col-sm-12 col-xs-12 customercontainerimg">
              <a class="readmore" href="<?php echo $custom['two_1page_link_block_1'];?>"><img class="alignnone size-full wp-image-6916" src="<?php echo $custom['two_1image_block_1']['url']; ?>" alt="RegistrarIPO_image"></a>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12">
            <h1><a class="readmore" href="<?php echo $custom['two_1page_link_block_1'];?>"><?php echo $custom['two_1title_block_1'];?></a></h1>
            <?php echo $custom['two_1content_block_1'];?>
            <div class="ccf_commonPage_readmore"><a class="readmore" href="<?php echo $custom['two_1page_link_block_1'];?>"> Read More</a></div>
          </div>
        </div>
      </div>
    </div>
  </div> 
    </div>
    </div>
       <?php } ?>
</section>


<!--/#feature-->

<!-- END Mid Container Section --> 
<?php get_footer(); ?>


