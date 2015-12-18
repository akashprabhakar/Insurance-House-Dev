<?php
/**
 * The template for displaying search results pages.
 *
 * @package CAPM
 */
get_header();

/* Start Banner Section */
get_header_banner_image(58, custom_translate('Search', 'بحث'));
/* END Banner Section */

/* START Breadcrums Container Section  */
get_post_breadcrumbs();
/* END Breadcrums Container Section */
?>

<div class="container-fluid">
  <!-- row -->
  <div class="row">
    <!-- container -->
    <div class="container">
       <?php if (have_posts()) : ?>
      <div class="col-lg-16 col-md-16 col-sm-16 col-xs-16 innerPageheading"><h1><?php
            echo custom_translate('Search Results for: ', 'نتائج البحث عن: ');
            echo '<span>' . get_search_query() . '</span>';
            ?></h1></div>
			
      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-16"></div>
      <!-- .innerpageContent -->
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-16 innerpageContent"><?php
        /* Start the Loop */
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $args = array(
            'posts_per_page' => 5,
            'paged' => $paged,
            's' => $s
        );

        $search = new WP_Query($args);
        if ($search->have_posts()) : while ($search->have_posts()) : $search->the_post();
            $search_result = $search->posts[0];
            ?>
            <h3 class="page-title searchresult"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <div class="searchresult"><?php the_excerpt(); ?></div>
            <?php
          endwhile;
        endif;
      else :
        get_template_part('content', 'none');
      endif;

      /* START PAGINATION */
      global $wp_query;
      $big = 999999999;
      echo paginate_links(array(
          'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
          'format' => '?paged=%#%',
          'current' => max(1, get_query_var('paged')),
          'total' => $wp_query->max_num_pages
      ));
      /* END PAGINATION */
      ?></div>
      <!-- .innerpageContent -->
      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-16"></div>    
    </div>
 <!-- container -->
    <div class="container">
      <div class="col-lg-16 col-md-16 col-sm-16 col-xs-16 innerpage_divider">
        <img src="<?php echo INC_URL_IMG . DS . 'innerPagedivider.jpg' ?>">
      </div>
    </div>
  </div>
  <!-- row -->
</div>


<?php
get_footer();
?>