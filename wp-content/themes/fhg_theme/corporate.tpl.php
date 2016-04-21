<?php
/**
 * Template Name: Corporate Pages 
 * @package WordPress
 * @subpackage custom-theme
 * @since custom-theme
 */
get_header();

/* Start Banner Section */
get_header_banner_image($post->ID, get_the_title());
/* END Banner Section */

/* START Breadcrums Container Section */
get_post_breadcrumbs();
wp_reset_query();
/* END Breadcrums Container Section */
?>


<section id="recent-works">
  <div class="container" id="content-area">
    <div class="credit_cards corporate_credit_cards">
      <div class="tabMenu">
        <?php get_cf_tabs(); ?>
      </div>
    </div>
    <!--/.row--> 

  <!--/.container-->

<?php 
    while (have_posts()) : the_post(); 
    $custom = get_fields(); //print_r($custom);?>
     
        <div class="row valuehousecontainer">
          <?php the_content();
		    getProductContactForm();?>
        </div>
     <?php wp_reset_postdata(); endwhile; ?>

	 <?php if((!empty($custom['show_hide_title_1'])) || (!empty($custom['show_hide_title_2'])) || (!empty($custom['show_hide_title_3']))){ ?>
	 <div class="cardDtls corporate-pages-tab">
<ul class="nav nav-tabs corporate-pages">
<li class="active"><a href="#tab11" data-toggle="tab"><?php echo $custom['show_hide_title_1'] ?></a></li>
<li class=""><a href="#tab12" data-toggle="tab"><?php echo $custom['show_hide_title_2'] ?></a></li>
<li class=""><a href="#tab13" data-toggle="tab"><?php echo $custom['show_hide_title_3'] ?></a></li>
</ul>
<div class="tab-content">
<div id="tab11" class="tab-pane active">
<div class="cardBoxContent">
<?php echo $custom['show_hide_content_1'] ?>
</div>
</div>
<div id="tab12" class="tab-pane">
<div class="cardBoxContent">
<?php echo $custom['show_hide_content_2'] ?>
</div>
</div>
<div id="tab13" class="tab-pane">
<div class="cardBoxContent">
<?php echo $custom['show_hide_content_3'] ?>
</div>
</div>
</div>
</div>
	 <?php } ?>
	 
	 
      <?php if(!empty($custom['terms_and_conditions_content'])) {?>
        <div class="footerCardFaqLink pf_financeFaqcontainer">
          <div class="row">
          <?php $contenturl = $custom['terms_and_conditions_content']; setup_postdata($contenturl);?>
            <div class="col-md-4 col-sm-4 col-xs-12 col-md-offset-2 col-sm-offset-2"><a href="<?php echo $custom['terms_and_conditions_content']?>" target="_blank">Terms &amp; Conditions</a></div>
            <div class="col-md-4 col-sm-4 col-xs-12 col-md-pull-2 col-sm-pull-2"><a href="<?php echo $custom['faq_content']; ?>" target="_blank">FAQ’s</a></div>

            <!--Fees and Charges-->
          </div>
        </div>
         <div class="cardDtls pf_cardDtls"></div>
      <?php wp_reset_postdata(); }?>

        
      <?php if(!empty($custom['commercial_services_content'])) {?>
      <div class="valueHouseCC pf_valueHouseCC">
          <?php echo $custom['commercial_services_content'];?>
        </div>
        <div class="allCardBox cor_allCardBox">
      <div class="row">
        <?php $counter=1; while($counter <= 3){ ?>
        <?php $content1 = $custom['commercial_service_tab_'.$counter]; setup_postdata($content1);?>
        <div class="col-sm-12 col-md-4 col-xs-12">
          <div class="thumbnail commercialpadding">
          <?php echo $content1; ?>
          </div>
        </div>
        <?php wp_reset_postdata(); $counter++; }?>
      </div>
    </div>
    </div>
    <?php }?>
     
    
</section>
 
<?php get_footer(); ?>



