<?php get_header(); 

/* Start Banner Section */
get_header_banner_image(1296, custom_translate('Page not found','الصفحة غير موجودة'));
/* END Banner Section */

/* START Breadcrums Container Section */
get_post_breadcrumbs();
/* END Breadcrums Container Section */
?>

<!-- START Mid Container Section --> 
<section id="recent-works">
  <div class="container">
    <h1 class='content_header'><?php echo custom_translate('Sorry!', 'عذرًا!');  ?></h1> 
	    <p><?php echo custom_translate('The page you are looking for is no longer here, or never existed.', 'لم يتم العثور على الصفحة التي تبحث عنها'); ?></p>
        <p><?php echo custom_translate('You can try searching for what you are looking for by using our <a href=' . home_url() . '>home page<a/> ', 'يرجى إعادة المحاولة أو تفضل بزيارة <a href=' . home_url() . '>الصفحة الرئيسية</a>.'); ?>        </p>
 </div>
</section>
<!-- END Mid Container Section --> 
<?php get_footer(); ?>