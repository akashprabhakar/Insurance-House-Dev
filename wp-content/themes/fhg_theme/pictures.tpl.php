<?php
/**
 * Template Name: Pictures
 * @package WordPress
 * @subpackage custom-theme
 * @since custom-theme
 * @update on 21/03/2016
 */
get_header();

/* Start Banner Section */
get_header_banner_image($post->ID, get_the_title());
/* END Banner Section */
/* START Breadcrums Container Section */
get_topnav_breadcrumbs();
/* END Breadcrums Container Section */
?>
<!--Main-Content-Start-->
<!--1621 Image gallery code starts-->



<?php
if (!isset($_GET['id'])) {

  /* -----sorting module base on month and year (1846) ------------------- */
  if (isset($_GET['month']) || isset($_GET['yr'])) {

    if (isset($_GET['month'])) {
      $query = queryGallery('month', $_GET['month']);
    }
    if (isset($_GET['yr'])) {
      $query = queryGallery('year', $_GET['yr']);
    }
  } else {
    $query = queryGallery('nosort', '');
  }

  $image_gallery_array = json_decode(galleryPaginate($query, 'oQeyGallery'));

  $image_gallery = $image_gallery_array->result;
  
  ?> <!-- Content Area Start -->
  <section id="image-gallery">
    <div class="container">
      <div class="row">
        <div class="innerpage">

            <h1 class="content_header"><?php echo custom_translate('Image Gallery', 'معرض الصور'); ?></h1>

              <?php get_sort_dropdowns('picgallery'); ?>
    

          <div class="media-image-gallery">
            
            <div class="mediaGallery">
              <ul>
                <?php
                $flag = 0;
                foreach ($image_gallery as $key => $image_gal) {

                  $query = queryImages($image_gal->id, 'nosort', '');
                  $gal_images = oQeyImage(1, $query);
                  $mod = $key % 3;
                  if ($mod == 0 || $key == 0) {
                    $flag = $key - 1;
                    ?>

                  <?php } ?>

                  <li><a href="<?php echo SITE_URL . custom_translate('/pictures', '/ar/الصور/') . "?id=" . $image_gal->id; ?>"><img alt="" src="<?php echo $gal_images[0]->title; ?>">
                      <div class="imgwatermark"></div>
                      <div class="mediaInformation">
                        <div class="innerContainer">
                          <h2><?php echo custom_translate($image_gal->title, $image_gal->arabic_title); ?></h2>
                          <p><?php echo custom_translate($image_gal->eng_desc, $image_gal->arab_desc); ?></p>
                          <div class="totalMedia">
                            <span>Total Photos - <?php echo imagecount($image_gal->id); ?></span>
                          </div>
                        </div>
                      </div>
                    </a></li>
                  <?php
                  $mod1 = ($key + 1) % 3;
                  if ($mod1 == 0) {
                    
                  }
                }
                ?>
              </ul>
              <?php echo $paginate_html = $image_gallery_array->paginate; ?>
            </div>           
          </div>

          <hr class="hr-ruller">

        </div>
      </div>
    </div>
  </section>          




<?php } else if (isset($_GET['id'])) { ?>

  <?php
  $gal_id = stripslashes_deep(urldecode($_GET['id']));
  /* -----sorting module base on month and year (1846) ------------------- */
  if (isset($_GET['month']) || isset($_GET['yr'])) {

    if (isset($_GET['month'])) {
      $query = queryImages($gal_id, 'month', $_GET['month']);
    }


    if (isset($_GET['yr'])) {
      $query = queryImages($gal_id, 'year', $_GET['yr']);
    }
  } else {
    $query = queryImages($gal_id, 'nosort', '');
  }

  $gal_images_array = json_decode(galleryPaginate($query, 'oQeyImage'));

  $gal_images = $gal_images_array->result;
  ?>

  <!-- Content Area Start -->
  <section id="image-gallery">
    <div class="container">
      <div class="row">
        <div class="innerpage">
        
            <h1 class="content_header"><?php echo custom_translate('Image Gallery', 'معرض الصور'); ?></h1>
          

          <div class="media-image-gallery image-gallery-inner">
          
            <div class='dropdowncontainer' style="margin-bottom: 15px;">
              <?php //get_sort_dropdowns('picgallery'); ?>
            </div>
            
            <div id="big-image">
              <?php /*
                foreach ($gal_images as $key => $image_gal2) {
                  $mod = $key % 3;
                  if ($mod == 0 || $key == 0) {
                    $flag = $key - 1;
                  }  */?>
                  <img title="gallery_img4" alt="<?php echo $gal_images[0]->alt; ?>" width="400" height="400" src="<?php echo $gal_images[0]->title; ?>">
              <?php  //} ?>
            </div>

            <div class="small-images">
              <div class="image_overflow" >
                <ul class="gal_thumbnail">
                    <?php
                      $i = 1;
                      foreach ($gal_images as $key => $image_gal1) {
                        $mod = $key % 3;
                         
                        if ($mod == 0 || $key == 0) {
                          $flag = $key - 1;

                        } ?>
                      <li data-count="<?php echo $i++;?>" >
                        <img src="<?php echo $image_gal1->title; ?>" alt="<?php echo $image_gal1->alt; ?>" />
                      </li>
                    <?php } ?>
                </ul>
              </div>
              <div class="arrows">
                <ul>
                  <li class="pre_arrow"><a href="javascript:void(0);" rel="<?php echo $gal_id; ?>" class="pre_a"> &nbsp; </a></li>
                  <li class="nxt_arrow"><a href="javascript:void(0);" rel="<?php echo $gal_id; ?>" class="nxt_a"> &nbsp; </a></li>
                </ul>
            </div>
            <div class="contentDisplay" style="display: block"></div>
<?php /* ?>
            <div class="mediaGallery">
              <ul>


                <?php
                foreach ($gal_images as $key => $image_gal) {
                  $mod = $key % 3;
                  if ($mod == 0 || $key == 0) {
                    $flag = $key - 1;
                    ?>

    <?php } ?>
                  
                  <li><a  href="<?php echo $image_gal->title; ?>" data-lightbox="pictures" data-title="<?php echo $description; ?>" > <img title="gallery_img4" alt="my image" src="<?php echo $image_gal->title; ?>">
                      <div class="imgwatermark"></div>
                      <div class="mediaInformation">
                        <div class="innerContainer">
                          <h2><?php echo custom_translate($image_gal->alt, $image_gal->arabic_description); ?></h2>
                          <p><?php echo custom_translate($image_gal->comments, $image_gal->arabic_comments); ?></p>
                          <div class="totalMedia">
                            <span></span>
                          </div>
                        </div>
                      </div>
                    </a></li>

                  <?php
                  $mod1 = ($key + 1) % 3;
                  if ($mod1 == 0) {
                    
                  }
                }
                ?>
              </ul>
  <?php echo $paginate_html = $gal_images_array->paginate; ?>
            </div>  <?php */ ?>         
          </div>

          <hr class="hr-ruller">

        </div>
      </div>
    </div>
  </section>


<?php }
?>
<!--Main-Content-End-->


<!-- Content Area End -->
<style type="text/css">
.small-images {
  overflow: hidden;
}
#image-gallery .media-image-gallery .small-images ul.gal_thumbnail {
  position: relative;
  margin-left: 0;
  padding: 0 ;
}
#image-gallery .media-image-gallery .small-images ul.gal_thumbnail li {
  display: inline-block;
  float: left;
}
.arrows ul li{
  width: 10px;
}
.arrows a{
  display: inline-block;
  width: 100%;
}
.image_overflow{
  overflow:hidden;
  width:98%;
}

<?php /*
  .small-images {
    width: 54%;
    height: 102px;
    margin: 0 auto;
    position: relative;
    overflow: hidden;
  }

  ul.gal_thumbnail {
    list-style: none;
    margin: 0;
    padding: 0;
    position: absolute;
  }
  ul.gal_thumbnail li{
    float: left;
    margin-right: 5px;
  }

  .arrows {
    margin: 0;
    padding: 0 10px;
    position: relative;
    width: 100%;
    height: auto;
    z-index: 40;
  }
  .arrows ul {
    margin: 0;
    padding: 0;
    list-style: none;
    position: absolute;
  }

  .arrows ul li {
    display: block;
  }

  li.nxt_arrow {
    float: right;
  }
  li.pre_arrow {
    float: left;
  }

  .arrows a {
    color: red;
      font-size: larger;
      font-weight: bold;
  }

 */ ?>
</style>
<?php get_footer(); ?>