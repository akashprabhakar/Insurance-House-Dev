<div class="top-bar">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="topMenu">
            <?php echo header_topnav_menu(); ?>
            <!-- <ul class="social-share">
              <li><a href="#">Home</a></li>
              <li><a href="#">Media</a></li>
              <li><a href="#">Blog</a></li>
              <li><a href="#">Careers</a></li>
              <li><a href="#">Help Center</a></li>
              <li><a href="#">Contact Us</a></li>
            </ul> -->
            <div class="call-srch">
              <!-- <div class="call-bttn pull-left">
                            Call Us: 80034
                        </div>-->
              <aside class="widget widget_polylang" id="polylang-3">
                <ul>
                  <li class="lang-item lang-item-15 lang-item-ar"> <?php if (dynamic_sidebar('language-switcher')):else:endif; ?></li>
                </ul>
              </aside>
              <div class="search_form">
                <?php $search_form_action = esc_url(home_url(custom_translate("/", "/ar/"))) ?>
                <?php echo search_form('desktopsearch'); ?>
                    
              </div>
              <a class="last" href="#"><img width="19" height="18" alt="icon-search" src="<?php echo INC_URL_IMG . DS . 'icon-search.png' ?>"> </a>
              <!-- <div class="online-banking"> <a href="#"><img alt="icon-online-banking" src="<?php// echo INC_URL_IMG . DS . 'online_bank_icon.png' ?>"><span>Online Banking</span></a> </div> -->
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--/.container-->
  </div>
  <!--/.top-bar-->
   <div class="shareon_menu"><?php //echo get_followlinks(); ?></div>
             