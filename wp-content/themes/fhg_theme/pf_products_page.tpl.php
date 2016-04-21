<?php
/**
 * Template Name: PF - Products Page
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
<div class="container">
    <?php get_pf_tabs(); ?>

    <?php 
    while (have_posts()) : the_post(); 
      if (strpos(get_permalink(get_the_id()), 'credit-cards') !== false) {
        if (shortcode_exists('shrt_credit_cards_comparison_content')) {
          echo do_shortcode('[shrt_personal_finance_credit_cards]');
        }
      }

    ?>
  </div>
       <!--  <h1 class='content_header'><?php// echo the_title(); ?></h1>  -->
        <?php 
          if (has_shortcode(get_the_content(), 'shrt_credit_cards_comparison_content')) {
            the_content();
            get_applynowform_product();
          } else {
          
            the_content();
            get_applynowform();
            get_applynowform_product();
           
          }
        ?>
    <?php endwhile; // end of the loop.  ?> 
  </div>
</section>
<!-- END Mid Container Section --> 
<?php get_footer(); ?>