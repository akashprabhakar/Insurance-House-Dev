<?php
/**
 * Template Name: PF Product Pages Internal
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
      </div>
    </div>
    <!--/.row--> 
  </div>
  <!--/.container-->

 <?php 
    while (have_posts()) : the_post(); 
      if (strpos(get_permalink(get_the_id()), 'credit-cards') !== false) {
        if (shortcode_exists('shrt_credit_cards_comparison_content')) {
          echo do_shortcode('[shrt_personal_finance_credit_cards]');
        }
      }

  the_content();     
        ?>
    <?php endwhile; // end of the loop.  ?> 

</section>
 
<?php get_footer(); ?>