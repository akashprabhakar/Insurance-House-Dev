<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package FHG CAPM Theme
 */

get_header();

/* Start Banner Section */
get_header_banner_image(28, 'Page not Found');
/* END Banner Section */

/* START Breadcrums Container Section */
get_404_breadcrumbs();
/* END Breadcrums Container Section */
?>

<!-- START Mid Container Section -->
<div class="container-fluid">
  <!-- row -->
  <div class="row">
    <!-- container -->
    <div class="container">
       <div class="col-lg-16 col-md-16 col-sm-16 col-xs-16 innerPageheading">
       <h1 class="text-center"><?php echo custom_translate('Sorry! We can not find what you were looking for.', 'آسف! ونحن لا يمكن أن تجد ما تبحث عنه.' ); ?></h1>
       </div>
       <div class="col-lg-2 col-md-2 col-sm-2 col-xs-16"></div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-16 innerpageContent">
     	  <p><?php echo custom_translate( 'It looks like nothing was found. Maybe try with something different.', 'يبدو وجد شيئا. ربما تحاول مع شيء مختلف.' ); ?></p>
     	 <p><?php echo custom_translate( 'Alternatively,', 'بدلا من ذلك,' ); ?></p>
            <p><?php echo custom_translate( 'You can visit our <a href='. home_url(). '>home page<a/> ', 'يمكنك زيارة <a href=' . home_url() .'>الصفحة الرئيسية </a>لدينا' ); ?>
            </p>
            </div>
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
<!-- END Mid Container Section -->
<?php get_footer(); ?>