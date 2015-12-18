<!--              <div class="navbar-collapse collapse collapseMini">
                <ul class="nav navbar-nav pull-right">
                  <li><a class="active" href="<?php //SITE_URL; ?>">Home</a></li>
                  <li class="dropdownmegamenu-fw"> 
                    <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" href="<?php echo SITE_URL . DS. 'about';?>">About CAPM</a>
                    <div class="hoverBox dropdown-menu megamenu-content" role="menu">
                      <div class="boxcontent box">
                        <div class="heading">About CAPM</div>
                        <p>CAPM Investment P.S.C (CAPM) is a Central Bank of the UAE-regulated and licensed investment company headquartered in Abu Dhabi, UAE.</p>
                        <p class="readMore"><a href="<?php //echo SITE_URL . DS. 'about';?>">Read More</a></p>
                      </div>
                      <div class="box">
                        <ul>
                          <li><a href="<?php //echo SITE_URL . DS. 'overview';?>">Overview</a></li>
                          <li><a href="<?php //echo SITE_URL . DS. 'mission';?>">Vision/Mission</a></li>
                          <li><a href="<?php //echo SITE_URL . DS. 'managing-directors-message';?>">Managing Director’s Message</a></li>
                          <li><a href="<?php //echo SITE_URL . DS. 'management';?>">Board of Directors and Senior Management</a></li>
                          <li><a href="<?php //echo SITE_URL . DS. 'corporate-governance';?>">Corporate Governance</a></li>
                        </ul>
                      </div>
                      </div>
                  </li>
                  <li>
                    <a href="<?php //echo SITE_URL . DS. 'what-we-do';?>">What we do</a> 
                    </li>
                  <li><a href="#">Media Center</a></li>
                  <li><a href="<?php //echo SITE_URL . DS. 'careers';?>">Careers</a></li>
                  <li><a href="<?php //echo SITE_URL . DS. 'contact';?>">Contact Us</a></li>
                </ul>
              </div>-->
<?php $items = wp_get_nav_menu_items( 'primary' ); print_r($items);?>

<?php
  
  $menu_name = 'primary';

    if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
  $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );

  $menu_items = wp_get_nav_menu_items($menu->term_id);

  // $menu_list = '<ul id="menu-' . $menu_name . '">';

  // foreach ( (array) $menu_items as $key => $menu_item ) {
  //     $title = $menu_item->title;
  //     $url = $menu_item->url;
  //     $menu_list .= '<li><a href="' . $url . '">' . $title . '</a></li>';
  // }
  $menu_list .= '</ul>';
    } else {
  $menu_list = '<ul><li>Menu "' . $menu_name . '" not defined.</li></ul>';
    }

?>
<div class="mobile_menu_container">
 <div class="navbar-collapse collapse collapseMini">
    <ul class="nav navbar-nav pull-right">
      <div class="menu-main-menu-container">
        <ul id="menu-main-menu" class="menu nav navbar-nav pull-right">
          <li id="menu-item-262" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-147 current_page_item"><a href="<?php echo SITE_URL.DS; ?>" class="active">Home</a></li>
          <li id="menu-item-994" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children"><a href="<?php echo SITE_URL.DS; ?>about/" class="">About CAPM</a>
          <span class="arrow_box1"></span>
            <ul class="sub-menu arrow_box1">
              <li id="menu-item-1353" class="menu-item menu-item-type-post_type menu-item-object-page"><a href="<?php echo SITE_URL.DS; ?>about/">About CAPM</a><p>CAPM Investment P.S.C (CAPM) is a Central Bank of the UAE-regulated and licensed investment company headquartered in Abu Dhabi, UAE.</p> <p class="readMore"><a href="<?php echo SITE_URL.DS; ?>about/"><!--&gt;&gt;-->Read More</a></p></li>
                <li>
                  <ul class="sub-menu1">
                      <li class="menu-item menu-item-type-post_type menu-item-object-page"><a href="<?php echo SITE_URL.DS; ?>overview">Overview</a></li>
                      <li class="menu-item menu-item-type-post_type menu-item-object-page"><a href="<?php echo SITE_URL.DS; ?>mission">Vision</a></li>
                      <li class="menu-item menu-item-type-post_type menu-item-object-page"><a href="<?php echo SITE_URL.DS; ?>managing-directors-message/">Managing Director's Message</a></li>
                      <li class="menu-item menu-item-type-post_type menu-item-object-page"><a href="<?php echo SITE_URL.DS; ?>management/">Board of Director & Senior Management</a></li>
                      <li class="menu-item menu-item-type-post_type menu-item-object-page"><a href="<?php echo SITE_URL.DS; ?>corporate-governance/">Corporate Goverance</a></li>
                  </ul>
              </li>
            </ul>
          </li>
          
          <li id="menu-item-326" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children"><a href="<?php echo SITE_URL.DS; ?>what-we-do/" class="">What We Do</a>
          <span class="arrow_box1"></span>
            <ul class="sub-menu arrow_box1">
              <li class="menu-item menu-item-type-post_type menu-item-object-page"></li>
                <li class="menu-item menu-item-type-post_type menu-item-object-page">
                  <ul class="sub-menu1">
                        <li id="menu-item-129" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children"><a href="<?php echo SITE_URL.DS; ?>servicedetails/2/">Investment Banking</a>
                          <ul class="sub-menu2">
                              <li id="menu-item-132" class="menu-item menu-item-type-post_type menu-item-object-page"><a href="<?php echo SITE_URL.DS; ?>equity-capital-markets/">Equity Capital Markets</a></li>
                              <li id="menu-item-131" class="menu-item menu-item-type-post_type menu-item-object-page"><a href="<?php echo SITE_URL.DS; ?>debt-capital-markets/">Debt Capital Markets</a></li>
                              <li id="menu-item-130" class="menu-item menu-item-type-post_type menu-item-object-page"><a href="<?php echo SITE_URL.DS; ?>advisory/">Advisory</a></li>
                          </ul>
                        </li>
                        <li id="menu-item-134" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children"><a href="<?php echo SITE_URL.DS; ?>servicedetails/5/">Asset Management</a>
                          <ul class="sub-menu2">
                            <li id="menu-item-133" class="menu-item menu-item-type-post_type menu-item-object-page"><a href="<?php echo SITE_URL.DS; ?>client-management/">Client Management</a></li>
                          </ul>
                        </li>
                  </ul>
              </li>
            </ul>
          </li>

          <li id="menu-item-531" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children"><a href="<?php echo SITE_URL.DS; ?>media-center/" class="">Media Center</a>
          <span class="arrow_box1"></span>
            <ul class="sub-menu arrow_box1">
              <li class="menu-item menu-item-type-post_type menu-item-object-page"></li>
              <li id="menu-item-198" class="menu-item menu-item-type-post_type menu-item-object-page"><a href="<?php echo SITE_URL.DS; ?>news/">Press Releases</a></li>
              <li id="menu-item-1041" class="menu-item menu-item-type-post_type menu-item-object-page"><a href="<?php echo SITE_URL.DS; ?>publications/">Publications</a></li>
            </ul>
          </li>
          <li id="menu-item-1209" class="menu-item menu-item-type-post_type menu-item-object-page"><a href="<?php echo SITE_URL.DS; ?>careers/">Careers</a></li>
          <li id="menu-item-200" class="menu-item menu-item-type-post_type menu-item-object-page"><a href="<?php echo SITE_URL.DS; ?>contact/" class="">Contact Us</a></li>
        </ul>

      </div>                 

    </ul>
  </div>
  </div>
              <!--/.nav-collapse --> 

