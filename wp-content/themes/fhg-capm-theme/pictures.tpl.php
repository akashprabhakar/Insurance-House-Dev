<?php
/**
 * Template Name: Pictures
 * @package WordPress
 * @subpackage fhg-capm-theme
 * @since fhg-capm-theme
 */
get_header();

/* Start Banner Section */
get_header_banner_image($post->ID, get_the_title());
/* END Banner Section */
/* START Breadcrums Container Section */
get_primary_breadcrumbs();
/* END Breadcrums Container Section */
?>
<!--Main-Content-Start-->
<!--1621 Image gallery code starts-->
<?php
$locale = get_locale();
if (!empty($locale) && $locale == 'en_US') {
  $locale = '/pictures';
} else {
  $locale = '/ar/الصور/';
}


if (!isset($_GET['id'])) {
  
  /*-----sorting module base on month and year (1846) ------------------- */
  if(isset($_GET['month']) || isset($_GET['yr'])){
    
    if(isset($_GET['month'])){
       $query = queryGallery('month',$_GET['month']);    
    }


    if(isset($_GET['yr'])){
       $query = queryGallery('year',$_GET['yr']);
    }
  }else{
    $query = queryGallery('nosort','');
  }

  $image_gallery_array = json_decode(galleryPaginate($query, 'oQeyGallery'));
  
  $image_gallery = $image_gallery_array->result;

  ?>

  <div class="container-fluid">
    <div class="row">
      <div class="container">
        <div class="col-lg-16 col-md-16 col-sm-16 col-xs-16 innerPageheading">
          <h1><?php echo custom_translate('Image Gallery', 'معرض الصور'); ?></h1>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-16"></div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-16 innerpageContent mediagallery">
      
        <!--<div class='dropdownpastevent'>
          <div class='dropdownContainer'>
            <?php //get_sort_dropdowns('picgallery'); ?>
          </div>
           
        </div>
        
        </div>
         <div class="galleryMainContainer">-->
         <ul class="mediaimage">
        <?php
        $flag = 0;
        foreach ($image_gallery as $key => $image_gal) {

          $description = $image_gal->title;
          $locale1 = get_locale();
          if (!empty($locale1) && $locale1 == 'ar') {
            $description = $image_gal->arabic_title;
          }

          $query = queryImages($image_gal->id,'nosort','');
          $gal_images = oQeyImage(1, $query);
          $mod = $key % 3;
          if ($mod == 0 || $key == 0) {
            $flag = $key - 1;
            ?>
           
            <?php } ?>
            <li>
                <div class="item hover-grid-item"><a  href="<?php echo SITE_URL . $locale . "?id=" . $image_gal->id; ?>" > <img title="gallery_img4" alt="my image" src="<?php echo $gal_images[0]->title; ?>">
                    <div style="display: none;" class="caption">
                      <h2><?php echo $description; ?></h2>                                        
                    </div>
                </div></a>
              </li>
           
            
            <?php
            $mod1 = ($key + 1) % 3;
            if ($mod1 == 0) {
              ?>
             
           
            <?php
          }
        }
        ?>
         </div>
        <div class="pastEvtConloadmore">
          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-16"></div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-16">
            <div class="pagination-centered">
              <?php echo $paginate_html = $image_gallery_array->paginate; ?>
              <div class="col-lg-2 col-md-2 col-sm-2 col-xs-16"></div></div>
          </div>

        </div>
      </div>
    <?php } else if (isset($_GET['id'])) { ?>
      <div class="container-fluid">
        <div class="row">
          <div class="container">
            <div class="col-lg-16 col-md-16 col-sm-16 col-xs-16 innerPageheading">
              <h1><?php custom_translate('Image Gallery', 'معرض الصور'); ?></h1>
            </div>
              <div class="picgalleryMainContainer">
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-16"></div>
                <div class='col-lg-12 col-md-12 col-sm-12 col-xs-16 dropdownpastevent'>
                  <div class='dropdownContainer'>
                    <?php get_sort_dropdowns('picgallery'); ?>
                  </div>
                    <div class='col-lg-2 col-md-2 col-sm-2 col-xs-16'></div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-16"></div>
              </div>
            <?php
            $gal_id = stripslashes_deep(urldecode($_GET['id']));
            /*-----sorting module base on month and year (1846) ------------------- */
            if(isset($_GET['month']) || isset($_GET['yr'])){
              
              if(isset($_GET['month'])){
                 $query = queryImages($gal_id,'month',$_GET['month']);    
              }


              if(isset($_GET['yr'])){
                 $query = queryImages($gal_id,'year',$_GET['yr']);
              }
            }else{
              $query = queryImages($gal_id,'nosort','');
            }
            
            $gal_images_array = json_decode(galleryPaginate($query, 'oQeyImage'));

            $gal_images = $gal_images_array->result;
            foreach ($gal_images as $key => $image_gal) {
              $description = $image_gal->alt;
              $comments = $image_gal->comments;
              $locale = get_locale();
              if (!empty($locale) && $locale == 'ar') {
                $description = $image_gal->arabic_description;
                $comments = $image_gal->arabic_comments;
              }
              $mod = $key % 3;
              if ($mod == 0 || $key == 0) {
                $flag = $key - 1;
                ?>
                <div class="picgalleryMainContainer">
                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-16"></div>
                <?php } ?>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-16 gallerypadContainer">
                  <div class="galleryhoverBox hover-grid">
                    <div class="item hover-grid-item"><a  href="<?php echo $image_gal->title; ?>" data-lightbox="pictures" data-title="<?php echo $description; ?>" > <img title="gallery_img4" alt="my image" src="<?php echo $image_gal->title; ?>">
                        <div style="display: none;" class="caption">
                          <h2><?php echo $description; ?></h2>
                          <p><?php echo $comments; ?></p>
                        </div>
                    </div></a>
                  </div>
                </div>

                <?php
                $mod1 = ($key + 1) % 3;
                if ($mod1 == 0) {
                  ?>
                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-16"></div>
                </div>
                <?php
              }
            }
            ?>
            <div class="col-lg-16 col-md-16 col-sm-16 col-xs-16 divpagination"><?php echo $paginate_html = $gal_images_array->paginate; ?></div>
          </div>
          <div class="container">
            <div class="col-lg-16 col-md-16 col-sm-16 col-xs-16 innerpage_divider"><img src="<?php echo INC_URL_IMG . DS . 'innerPagedivider.jpg' ?>"></div>
    
          </div>
        </div>

      </div>

    <?php } ?>
    <!--Main-Content-End-->
  </div>
  <?php get_footer(); ?>