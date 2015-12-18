<?php
/**
 * Template Name: Videos
 * @package WordPress
 * @subpackage ant-fhg-capm
 * @since 21 Aug 2015
 */
get_header();

/* Start Banner Section */
 get_header_banner_image($post->ID, get_the_title()); 
/*  END Banner Section */
/*  START Breadcrums Container Section */
 get_primary_breadcrumbs(); 
/*  END Breadcrums Container Section */
/*  Main-Content-Start */
$upload_dir = wp_upload_dir();

?>
 <header>
      <div class="container-fluid">
        <div class="row headerRowOne">
          <div class="container headermobileContainer">
            <div id="screen_resolution"></div>
            <div class="socialicons col-md-12 col-sm-13 col-xs-12">
              <!-- <p>
              <a><img src="<?php echo INC_URL_IMG . DS . 'facebook_20.png' ?>" alt="facebook_20"></a> 
              <a><img src="assets/images/twitter_20.png" alt="twitter_20"></a> 
              <a><img src="assets/images/linkedin_20.png" alt="linkedin_20"></a> 
              <a><img src="assets/images/youtube_20.png" alt="youtube_20"></a> 
              <a><img src="assets/images/instagram_20.png" alt="instagram_20"></a> 
              </p>-->            
            </div>
            <div class="headerRightContainer">
              <div class="tabMenu pull-right">
                <aside id="polylang-2">
                  <ul>
                    <li class="lang-item lang-item-15 lang-item-ar"> <?php if (dynamic_sidebar('sidebar')):else:endif; ?></li>
                  </ul>
                </aside>
                <?php include_once(DIR_THEME_ROOT . '/searchform.php'); ?>
              </div>
            </div>
          </div>
        </div>
        <div class="row headerRowTwo">
          <div class="navbar navbar-inverse">
            <div class="container">
              <!-- .navbar-header -->
              <div class="navbar-header"> 
                <a class="navbar-brand" href="<?php echo $siteurl; ?>"><img src="<?php echo INC_URL_IMG . DS . 'logo.png' ?>" alt=""></a>
                <!-- Button for smallest screens -->
                <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle pull-right" type="button">
                  <span class="icon-bar"></span> 
                  <span class="icon-bar"></span> 
                  <span class="icon-bar"></span> 
                </button>
                <!-- Button for smallest screens -->
              </div>
              <!-- /.navbar-header -->
              <!--.nav-collapse --> 

               <div class="navbar-collapse collapse collapseMini">
                 <ul class="nav navbar-nav pull-right">
                   
                   <div class="search_form_mobile">
                   <?php $search_form_action = esc_url(home_url(custom_translate("/", "/ar/"))) ?>
                    <form id="target" role="search_post" method="get" class="search-form-mobile" action="<?php echo $search_form_action; ?>" >
                      <div class="searchPannelMobile">
                        <input type="text"  id="global_search" class="searchtextbox search-field required" value="<?php echo esc_attr(get_search_query()); ?>" placeholder="<?php echo custom_translate('search here...', 'ابحث هنا...') ?>" name="s">
                      </div>
                    </form>
                  </div>
                  <?php custom_menus(); ?>

                  <div class="shareon_menu">
                    <?php echo get_followlinks(); ?>
                  </div>
                 </ul>
               </div>
              <!--/.nav-collapse -->
            </div>
          </div>
        </div>
      </div>
    </header>
 
  <?php 
 echo wp_nav_menu( array(
  'theme_location' => 'primary',
  'sub_menu' => true
) );
  $menu_name = 'primary';
?>

<?php 
//     if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
//   $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );

//   $menu_items = wp_get_nav_menu_items($menu->term_id);
// // echo "<pre>";
// // print_r($menu_items);


// echo "<ul>";
// foreach ( (array) $menu_items as $key => $menu_item ) {
//     if ( $menu_item->menu_item_parent == 0 ) {
//         $title = $menu_item->title;
//         $url = $menu_item->url;
//         $menudata[$key] = $menu_item->ID;
//         $prvid = $menu_item->ID;
//         echo "<li>$menu_item->title</li>";
//         $menu_output .= '<option value="' . $url . '">' . $prefix . $title . '</option>';
//     }else if( $menu_item->menu_item_parent != 0 ) {
//       echo "<ul>";
//       if($menu_item->menu_item_parent == $prvid){
//         echo "<li>$menu_item->title</li>";
//       }
//       echo "</ul>";
//     }
// }
// // echo "</ul>";
// // echo "<pre>";
// // print_r($menu_items);
//   // $menu_list = '<ul id="menu-' . $menu_name . '">';

//   // foreach ( (array) $menu_items as $key => $menu_item ) {
//   //     $title = $menu_item->title;
//   //     $url = $menu_item->url;
//   //     $menu_list .= '<li><a href="' . $url . '">' . $title . '</a></li>';
//   // }
 
//     } else {
//   $menu_list = '<ul><li>Menu "' . $menu_name . '" not defined.</li></ul>';
//     }

?>
<div class="container-fluid">
  <div class="row">
    <div class="container">
    
    <div class="col-lg-16 col-md-16 col-sm-16 col-xs-16 innerPageheading">
      <h1><?php echo custom_translate('Video Gallery', 'معرض الصور'); ?></h1></div>
    
      
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-16"></div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-16 innerpageContent mediagallery">
        
          <ul class="mediaimage">
              <li>
                  <img src="assets/images/media_gallery/image_gallery1.png">
                    <div class="videowatermark"></div>
                </li>
                <li>
                  <img src="assets/images/media_gallery/image_gallery2.png">
                    <div class="videowatermark"></div>
                </li>
                <li>
                  <img src="assets/images/media_gallery/image_gallery3.png">
                    <div class="videowatermark"></div>
                </li>
                <li>
                  <img src="assets/images/media_gallery/image_gallery4.png">
                    <div class="videowatermark"></div>
                </li>
                <li>
                  <img src="assets/images/media_gallery/image_gallery5.png">
                    <div class="videowatermark"></div>
                </li>
                <li>
                  <img src="assets/images/media_gallery/image_gallery6.png">
                    <div class="videowatermark"></div>
                </li>
            </ul>
              
         </div>
            
            <div class="col-lg-16 col-md-16 col-sm-16 col-xs-16 divpagination">
            <ul class="pagination">
                <li>
                    <a class="prev page-numbers" href="">previous</a>
                    <a class="page-numbers" href="">1</a>
                    <a class="page-numbers" href="">2</a>
                    <a class="page-numbers" href="">3</a>
                    <a class="next page-numbers" href="">next</a>
                </li>
            </ul>
        </div>
        </div>
          
            
  
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-16"></div>
         </div>
        <div class="container">
    <div class="col-lg-16 col-md-16 col-sm-16 col-xs-16 innerpage_divider"><img src="assets/images/innerPagedivider.jpg"></div>
   
   
    </div>
  </div>



<div class="container-fluid">
  <div class="row">
    <div class="container VideogalleryContainer">
     <!--  <?php get_videos(); ?> -->
      <div class="galleryMainContainer">
        <?php
        if (check_arabic()) {
          $lang = "arabic";
        } else {
          $lang = "english";
        }

        $page = get_query_var('page', 1);
        $total_per_page = 6;

        if (empty($page)) {
          $page = 1;
        } else {
          $page;
        }

        $start_from = ($page - 1) * $total_per_page;
        $results = oQeyVideo($lang, $start_from, $total_per_page);

        if(isset($_GET['month']) || isset($_GET['yr'])){
          if(isset($_GET['month'])){
            $results = oQeyVideosortmonth($lang, $start_from, $total_per_page, $_GET['month']);
          }

          if(isset($_GET['yr'])){
            $results = oQeyVideosortyear($lang, $start_from, $total_per_page, $_GET['yr']);
          }
        }

        get_video_thumbs($results);

        $total_Record = count(oQeyVideoPagiCount($lang));
        $total_pages = ceil($total_Record / $total_per_page);
        $next = $page + 1;
        if ($next > $total_pages) {
          $class = 'class="disabled"';
          $next = "#";
        } else {
          $class = '';
          $next;
        }

        $previous = $page - 1;

        if ($previous == 0) {
          $classpr = 'class="disabled"';
          $previous = "#";
        } else {
          $classpr = '';
          $previous;
        }
        ?>
      </div>
      <!-- end -->
    </div>
    <div class="pastEvtConloadmore">
      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-16"></div>
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-16">
        <div class="pagination-centered">
          <?php if ($total_pages > 1) { ?>
            <ul class="pagination setactive">
              <li <?php echo $classpr; ?>>
                <a href="<?php echo get_permalink($post->ID); ?>/?page=<?php echo $previous; ?>" aria-label="Previous">
                  <span aria-hidden="true">previous</span>
                </a>
              </li>
              <?php
              for ($i = 1; $i <= $total_pages; $i++) {
                if ($i == $page) {
                  $class = "current";
                } else {
                  $class = "";
                }
                ?>
                <li><a class="<?php echo $class; ?>" href="<?php echo get_permalink($post->ID); ?>/?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php } ?>
              <li <?php echo $class; ?>>
                <a href="<?php echo $next; ?>" aria-label="Next">
                  <span aria-hidden="true">next</span>
                </a>
              </li>
            </ul>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- START Mid Container Section -->

<!--Main-Content-End-->
<?php get_footer(); ?>