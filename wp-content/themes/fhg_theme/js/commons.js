//1360 - global var
var contact_slider_top = '';
    

(function ($) {


    $(document).ready(function () {

//        $(document).on('click','.close',function(){
//	$(this).parents('span').remove();
//
//})
//
//
//
//document.getElementById("resume_filename").onchange = function () {
//    document.getElementById("uploadFile").value = this.value;
//};
//
//document.getElementById('resume_filename').onchange = uploadOnChange;
//    
//function uploadOnChange() {
//    var filename = this.value;
//    var lastIndex = filename.lastIndexOf("\\");
//    if (lastIndex >= 0) {
//        filename = filename.substring(lastIndex + 1);
//    }
//    var files = $('#resume_filename')[0].files;
//    for (var i = 0; i < files.length; i++) {
//     $("#upload_prev").append('<span>'+files[i].name+'<p class="close">X</p></span>');
//    }
//    document.getElementById('uploadFile').value = filename;
//}
       de();

  $("#resume_filename").on("change", function() {



    if ($("#resume_filename").val() != "") {
         $("#delete").attr("style", "display:block");
      //$("input[type=button]").attr("style", "display:block");
    } else {
         $("#resume_filename").attr("style", "display:block");
      de();
    }
  });
  $("#delete").click(function() {
      
    $("#resume_filename").val('');
    $("#uploadFile").val('');
    de();
  })


        $(".mega-menu-item").addClass('mega-hide-arrow');

	
		 
				$("#big-image img:eq(0)").nextAll().hide();
    $("#small-image img").click(function(e){
        var index = $(this).index();
        $("#big-image img").eq(index).show().siblings().hide();
    });		

           
     

  //                  var draggable = document.getElementById('draggable');
  // draggable.addEventListener('touchmove', function(event) {
  //   var touch = event.targetTouches[0];
    
  //   // // Place element where the finger is
  //   // draggable.style.left = touch.pageX-25 + 'px';
  //   // draggable.style.top = touch.pageY-25 + 'px';
  //   event.preventDefault();
  // }, false);
                
var pathname = window.location.pathname;
if (pathname.indexOf('/ar/') > -1) {
	 $('#goToPrevSlide').hide();
     var slider = $("#content-slider").lightSlider({
                loop: false,
                keyPress: true,
                item: 6,
                pager: false,
                controls: false,
                rtl:true,
                responsive: [
                    {
                        breakpoint: 800,
                        settings: {
                            item: 3,
                            slideMove: 1,
                            slideMargin: 6
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            item: 2,
                            slideMove: 1
                        }
                    }
                ],
				onBeforeSlide: function(el) {
					var totalCount = slider.getTotalSlideCount()-5;
					var CurrentCount = el.getCurrentSlideCount();
					if (totalCount <= CurrentCount) {
						 $('#goToNextSlide').hide();
						 return;
					  } else {
						 $('#goToNextSlide').show();      
					  }
				},
				onAfterSlide: function(el) {
					var totalCount = slider.getTotalSlideCount()-5;
					var CurrentCount = el.getCurrentSlideCount();
					if (CurrentCount == 1) {
					$('#goToPrevSlide').hide();      
					 return;
				  } else {
					 $('#goToPrevSlide').show();
				  }
				}
            });
            $('#goToPrevSlide').on('click', function() {
				  slider.goToPrevSlide();
					
            });
            $('#goToNextSlide').on('click', function() {
              slider.goToNextSlide();
			 
            });
}else{
     var slider = $("#content-slider").lightSlider({
                loop: false,
			    keyPress: true,
                item: 6,
                pager: false,
                controls: false,
                rtl:false,
                responsive: [
                    {
                        breakpoint: 800,
                        settings: {
                            item: 3,
                            slideMove: 1,
                            slideMargin: 6
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            item: 2,
                            slideMove: 1
                        }
                    }
                ],
				onBeforeSlide: function(el) {
					var totalCount = slider.getTotalSlideCount()-5;
					var CurrentCount = el.getCurrentSlideCount();
					if (totalCount <= CurrentCount) {
						 $('#goToPrevSlide').hide();
						 return;
					  } else {
						 $('#goToPrevSlide').show();      
					  }
				},
				onAfterSlide: function(el) {
					var totalCount = slider.getTotalSlideCount()-5;
					var CurrentCount = el.getCurrentSlideCount();
					if (CurrentCount == 1) {
					$('#goToNextSlide').hide();      
					 return;
				  } else {
					 $('#goToNextSlide').show();
				  }
				}
				
		    });
			
			$('#goToPrevSlide').on('click', function() {
		          slider.goToNextSlide();
		      });
            $('#goToNextSlide').on('click', function() {
	            slider.goToPrevSlide();
           });
}

     
  //   $("a.mega-menu-link").hover(function(){
  //     alert(this);
  //       $(this).parent('li').removeClass('mega-hide-arrow');
         
  //   }, function() {
  //       $(this).parent('li').addClass('mega-hide-arrow');
  // });		

  //   $("ul.mega-sub-menu").hover(function(){
  //     alert('asdasd');
  //       $(this).parent('li').removeClass('mega-hide-arrow');
        
  //   }, function() {
  //       $(this).parent('li').addClass('mega-hide-arrow');
  // });       

	
        $('.valuehousevideo .videoRight iframe').removeAttr('width');
		$('.valuehousevideo .videoRight iframe').removeAttr('height');
				
		// $(".youtube").colorbox({iframe: true, innerWidth: 640, innerHeight: 390});			   
								
        $('p:empty').remove();
		/* PG - 1623 - Remove P from image tages*/
		$('p > img').unwrap();
		/* PG - 1623 - Remove P from image tages*/
		/*PG - 1623 - Thankyou page highlights contact us */
		if(pagename=='News' || pagename_2 == 'News') {
			  $(".media_center a").addClass('current-menu-item');
		} else if(pagename=='publications' || pagename_2 == 'publications') {
			  $(".media_center a").addClass('current-menu-item');
		} else	if(pagename=='thank-you-contact' || pagename_2 == 'thank-you-contact') {
			  $(".contact_us a").addClass('current-menu-item');
		}
		
		/*PG - 1623 - Thankyou page highlights contact us */	
		
        $('#capm_login_form,#capm_registration_form').submit(function(e){ 
        var captch = jQuery('#g-recaptcha-response').val();
        if(!captch)
        {
            $(".capspan").show();
            e.preventDefault();
        }else{
            //alert(jQuery('#g-recaptcha-response').val());
        }

        });
        $(".innerpageContent img, .fhg-column-group img,.overviewBoxes img,.missionContentBox img,.mediaGallery img,.valusehouseallCardBox img,.valuehousehelpcenter img, .investorrelationCardBox img").wrap( "<div class='img-block'></div>" );
        $('form.wpcf7-form').addClass('jqtransform');
        $('form.maindrop').addClass('jqtransform');
        $('form.jqtransform').jqTransform();
        //$(".valuehousecontainer .leftColmp img:first-child").wrap( "<div class='img-block'></div>" );
		
        //$("#applyformid").hide();
        //  $("#appnowbtn").click(function (){
        //     $("#applyformid").toggle();
        //     return false;
        // });
 
        $(".handle").click(function (){
            $('.formdivs').css("opacity","1");
        });

        $('form.wpcf7-form').addClass('jqtransform');
        $('form.maindrop').addClass('jqtransform');
        $('form.jqtransform').jqTransform();
        // $(".product_listing").wrap("<div class='new'></div>");
        // $(".myclass").wrap("<div class='new'></div>");

        // $("#loginbtn").click(function () {
        //     $("#login_form").show();
        //     $("#register_form").hide();
        //});

        $(".sendecard").hide();
        $(".sendecardbtn").click(function () {
            
            // // jQuery's .attr() method, same but more verbose

            $(".ecardidd").val($(this).attr('id'));
            $(".sendecard").toggle();
            return false;
        });

        $("#resume_filename").change(function () {
            z = $('#resume_filename').val();            
            $('#uploadFile').val(z);
        });
        $(".latestslider > div").addClass("floatright");
        // $(".youtube").colorbox({iframe: true, innerWidth: 640, innerHeight: 390});


        $("a.last").click(function() {
            $(".searchPannel").show();
            /*var search_value = $("#global_search").val();
            
            if (search_value != '' && search_value.length != '') {
                alert(search_value);
                $(".searchPannel").css({ 'display': "block" });
            }*/
        });


        $('.bx-controls-auto').click(function () {
            var v = document.getElementById('video');
            if (v.paused) {
                v.play();
            } else {
                v.pause();
            }
        });

        $("#applynowfrm").hide();
        $(".applybtn").click(function() {
         $("#applynowfrm").toggle();
                    $('html, body').animate({
            scrollTop: $("#formsspace").offset().top
        }, 1000);
  
            
            return false;
        });

        //$('#resume_filename').prop('disabled', true);

        $("#contactformmobile").hide();
        $("#contact_mobile").click(function () {
            $("#contactformmobile").toggle();
            return false;
        });

        // $('#checklegal').change(function(){
        //     if(this.checked)
        //         $('#resume_filename').prop('disabled', false);
        //     else
        //         $('#resume_filename').prop('disabled', true);
        // });
        var numberOfImages = $('.latestslider li').length;
        if (numberOfImages > 1) {
            $('.latestslider').bxSlider({
                minSlides: 1,
                maxSlides: 2,
                auto: true,
                margin: 10,
                infiniteLoop: false
            });
        }

        $("#feedback").hide();
        var pathname = window.location.pathname;
        
        /*added by 1360*/
        var is_front_page = $('#is_front_page').val();
        if(is_front_page == 1){
            contact_slider_top = 840;
        }
        else{
            contact_slider_top = 710;
        }
        /*added by 1360*/
        
		
	   var pathname1 = window.location.pathname;
//console.log(pathname1.indexOf('/ar/'));console.log("in here");

    if (pathname1.indexOf('/ar/') > -1){
        $(".next").click(function(){
            $("#owl-demo2, #investor-relation-slider, #owl-demo-about").trigger('next.owl.carousel');
        });
        $(".prev").click(function(){
            $("#owl-demo2, #investor-relation-slider, #owl-demo-about").trigger('prev.owl.carousel');
        });
		 $(".next_v2").click(function(){
            $("#aboutus-emirates-slider").trigger('next.owl.carousel');
        });
        $(".prev_v2").click(function(){
            $("#aboutus-emirates-slider").trigger('prev.owl.carousel');
        });
		
    }
    else{
        $(".next").click(function(){
            $("#owl-demo2, #investor-relation-slider, #owl-demo-about").trigger('prev.owl.carousel');
         });
        $(".prev").click(function(){
            $("#owl-demo2, #investor-relation-slider, #owl-demo-about").trigger('next.owl.carousel');
        });
		 $(".next_v2").click(function(){
            $("#aboutus-emirates-slider").trigger('prev.owl.carousel');
        });
        $(".prev_v2").click(function(){
            $("#aboutus-emirates-slider").trigger('next.owl.carousel');
        });

    }  
		
        if (pathname.indexOf('/ar/') > -1) {


             // $("#owl-demo").owlCarousel({
             //    autoPlay : 3000,
             //    // navigation : true,
             //    slideSpeed : 300,
             //    paginationSpeed : 400,
             //    singleItem : true,
             //    autoHeight : true,   

             //  });
			 
			 $('.table-responsive').scrollLeft(9999);	
            
            $("#owl-demo").owlCarousel({
                autoPlay: 3000,
                items : 1,
                rtl:true,
                loop: false,
                touchDrag  : true,
                mouseDrag  : true,
                responsiveClass:true,
                responsive:{
                    0:{
                        items:1
                    },
                    1024:{
                        items:1
                    },
                    1152:{
                        items:1
                    }
                }
            });
			
			//Management Team
			
			   $("#owl-demo2").owlCarousel({
            dots:false,
            rtl:true,
            touchDrag  : true,
            mouseDrag  : true,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                1000:{
                    items:5
                }
            }
         });
		 //About Us - Emirates Review
		 	   $("#aboutus-emirates-slider").owlCarousel({
            dots:false,
            rtl:true,
            touchDrag  : true,
            mouseDrag  : true,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:2
                },
                1000:{
                    items:3
                }
            }
         });
		  // About Us - Investor Relation 
		    $("#investor-relation-slider").owlCarousel({
            dots:false,
            rtl:true,
            touchDrag  : true,
            mouseDrag  : true,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:2
                },
                1000:{
                    items:3
                }
            }
         });

            /*1621 footer "Apply .. .."*/
            $("#click_product").click(function () {
                window.location.href = "اتصل-بنا/";
            });

            if (window.location.hash) {                
                getForm('product');
            }

            var urlstring = document.location.href;
            //console.log(document.location.href);
            if (urlstring.search('%d8%a7%d8%aa%d8%b5%d9%84-%d8%a8%d9%86%d8%a7') == -1) {
                if ($('.menu-main-menu-container a').hasClass('childli')) {
                    if ($('.menu-main-menu-container a.childli').hasClass('childli')) {
                        $('.menu-main-menu-container a.childli').addClass('inneractive').parents(".menu-main-menu-container li").children("a").addClass('active');
                    }    
                }
            }

            // CONTACT FORM
            $('.slide-out-div').tabSlideOut({
                tabHandle: '.handle', //class of the element that will become your tab
                // pathToTabImage: base_url + '/wp-content/themes/fhg_theme/images/contactUsHomepage_ar.png', //path to the image for the tab //Optionally can be set using css
                imageHeight: '122px', //height of tab image           //Optionally can be set using css
                imageWidth: '40px', //width of tab image            //Optionally can be set using css
                tabLocation: 'right', //side of screen where tab lives, top, right, bottom, or left
                speed: 300, //speed of animation
                action: 'click', //options: 'click' or 'hover', action to trigger animation
                topPos: contact_slider_top+'px', //position from the top/ use if tabLocation is left or right
                rightPos: '20px', //position from left/ use if tabLocation is bottom or top
                fixedPosition: false                      //options: true makes it stick(fixed position) on scroll
            });

            // SOCIAL FEEDS
            if($( window ).width() >= 1024){
                $('.slide-out-div1').tabSlideOut({
                    tabHandle: '.handle1', //class of the element that will become your tab
                    //pathToTabImage: base_url +'/wp-content/themes/fhg-capm-theme/includes/images/contactUsHomepage_ar.png', //path to the image for the tab //Optionally can be set using css
                    imageHeight: '122px', //height of tab image           //Optionally can be set using css
                    imageWidth: '40px', //width of tab image            //Optionally can be set using css
                    tabLocation: 'left', //side of screen where tab lives, top, right, bottom, or left
                    speed: 300, //speed of animation
                    action: 'click', //options: 'click' or 'hover', action to trigger animation
                    topPos: '400px', //position from the top/ use if tabLocation is left or right
                    rightPos: '20px', //position from left/ use if tabLocation is bottom or top
                    fixedPosition: true                      //options: true makes it stick(fixed position) on scroll
                });
            }
        } else {
             // $("#owl-demo").owlCarousel({
             //    autoPlay : 3000,
             //    // navigation : true,
             //    slideSpeed : 300,
             //    paginationSpeed : 400,
             //    singleItem : true,
             //    autoHeight : true,   

             //  });

            $("#owl-demo").owlCarousel({
                autoPlay: 3000,
                items : 1,
                pagination:true,
                loop: false,
                touchDrag  : true,
                mouseDrag  : true,
                responsiveClass:false,
                responsive:{
                    0:{
                        items:1

                    },
                    1024:{
                        items:1

                    },
                    1152:{
                        items:1
                    }
                }
            });
			//Management Team
			$("#owl-demo2").owlCarousel({
            dots:false,
            touchDrag  : true,
            mouseDrag  : true,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                1000:{
                    items:5
                }
            }
         });
		 
		 // About Us - Investor Relation 
		 $("#investor-relation-slider").owlCarousel({
            dots:false,
            touchDrag  : true,
            mouseDrag  : true,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:2
                },
                1000:{
                    items:3
                }
            }
         });
		 
		  $("#aboutus-emirates-slider").owlCarousel({
            dots:false,
            touchDrag  : true,
            mouseDrag  : true,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:2
                },
                1000:{
                    items:3
                }
            }
         });
         
            /*1621 footer "Apply .. .."*/
            $("#click_product").click(function () {
//                window.location.href = "contact/#form_container";
                window.location.href = "contact";
            });

            if (window.location.hash) {
//                $('.none-class').css('display','none');
//                $('.apply-for-product').css('display','block');                 
                 
                getForm('product');
            }

            var urlstring = document.location.href;
            //console.log(document.location.href);
            if (urlstring.search('contact') == -1) {
                if ($('.menu-main-menu-container a').hasClass('childli')) {
                    if ($('.menu-main-menu-container a.childli').hasClass('childli')) {
                        $('.menu-main-menu-container a.childli').addClass('inneractive').parents(".menu-main-menu-container li").children("a").addClass('active');
                    }    
                }
            }

            /*1621 footer "Apply .. .."*/
            // CONTACT FORM
            $('.slide-out-div').tabSlideOut({
                tabHandle: '.handle', //class of the element that will become your tab
                // pathToTabImage: base_url + '/wp-content/themes/fhg_theme/images/contactUsHomepage.png', //path to the image for the tab //Optionally can be set using css
                imageHeight: '122px', //height of tab image           //Optionally can be set using css
                imageWidth: '40px', //width of tab image            //Optionally can be set using css
                tabLocation: 'left', //side of screen where tab lives, top, right, bottom, or left
                speed: 300, //speed of animation
                action: 'click', //options: 'click' or 'hover', action to trigger animation
                topPos: contact_slider_top+'px', //position from the top/ use if tabLocation is left or right
                leftPos: '20px', //position from left/ use if tabLocation is bottom or top
                fixedPosition: false                      //options: true makes it stick(fixed position) on scroll
            });

            // SOCIAL FEEDS
            if($( window ).width() > 1024){
                $('.slide-out-div1').tabSlideOut({
                    tabHandle: '.handle1', //class of the element that will become your tab
                    //pathToTabImage: base_url +'/wp-content/themes/fhg-capm-theme/includes/images/contactUsHomepage.png', //path to the image for the tab //Optionally can be set using css
                    imageHeight: '132px', //height of tab image           //Optionally can be set using css
                    imageWidth: '40px', //width of tab image            //Optionally can be set using css
                    tabLocation: 'right', //side of screen where tab lives, top, right, bottom, or left
                    speed: 300, //speed of animation
                    action: 'click', //options: 'click' or 'hover', action to trigger animation
                    topPos: '400px', //position from the top/ use if tabLocation is left or right
                    rightPos: '20px', //position from left/ use if tabLocation is bottom or top
                    fixedPosition: true                      //options: true makes it stick(fixed position) on scroll
                });
            }
        }

        // SLIDEOUT FUNCTIONALITY FOR CONTACT FORM AND SOCIAL FEEDS

        $("select").addClass("selectpicker");

        $("#slide0 , #image0").addClass("active");

        
        if($('.wpcf7 form div').hasClass('wpcf7-mail-sent-ok')){
            if (pathname.indexOf('/ar/') > -1) {
                document.location = base_url+'/ar/thank-you-contact/';
            }else{  
                document.location = base_url+'/thank-you-contact/';
            }
        }

        $('.gal_thumbnail li img').on('click', function() {

            var pathname = window.location.pathname;
            var arr = pathname.split('/');
            var ar_lang = arr.indexOf('ar');

            new_src = $(this).attr('src');
            new_title = $(this).attr('alt');
            en_comment = $(this).data('comment');
            ar_desc = $(this).data('arabic-desc');
            ar_comment = $(this).data('arabic-comment');

            $('#big-image img').attr('src', new_src);

            if(ar_lang > -1 ) {

                if(ar_desc){
                    $('div.discription h1').show(0, '', function(){ $(this).html( ar_desc ); });
                }else{
                    $('div.discription h1').hide(0, '', function(){ $(this).html(''); });
                }

                if(ar_comment){
                    $('div.discription p.comment').show(0, '', function(){ $(this).html( ar_comment ); });
                }else{
                    $('div.discription p.comment').hide(0, '', function(){ $(this).html(''); });
                }
            } else { 
                if(new_title){
                    $('div.discription h1').show(0, '', function(){ $(this).html( new_title); } );
                }else{
                    $('div.discription h1').hide(0, '', function(){ $(this).html(''); });
                }

                if(en_comment){
                    $('div.discription p.comment').show(0, '', function(){ $(this).html( en_comment ); });
                }else{
                    $('div.discription p.comment').hide(0, '', function(){ $(this).html(''); });
                }
            }

        });

    });

}(jQuery));

function onYouTubeIframeAPIReady() {
//        console.log('IframeAPI = Ready');
        // var $activeSlide  = $('.carousel').find('.item.active'),
        // $player       = $('iframe[src*=youtube]', $activeSlide );
        // if($player.attr('id')){
        //     var player = new YT.Player($player.attr('id'), {
        //         events: {
        //             'onReady': onPlayerReady,
        //             'onStateChange': onPlayerStateChange,
        //             'onError': onPlayerError,
        //         }
        //     });
        // }

        // $(".carousel").on('slid.bs.carousel', function () {
        //     var $activeSlide  = $('.carousel').find('.item.active'),
        //     $player       = $('iframe[src*=youtube]', $activeSlide );
        //     if($player.attr('id')){
        //         var player = new YT.Player($player.attr('id'), {
        //             events: {
        //                 'onReady': onPlayerReady,
        //                 'onStateChange': onPlayerStateChange
        //             }
        //         });
        //     }
        // });
    }

    

    function onPlayerReady(event) {
       
    }

    function onPlayerStateChange(event) {
        // if (event.data == YT.PlayerState.PAUSED) {
        //      $('.carousel').carousel();
        // }

        // if (event.data == YT.PlayerState.PLAYING) {
        //      $('.carousel').carousel('pause');
        // }

        // if (event.data == YT.PlayerState.ENDED) {
        //    $('.carousel').carousel(); 
        // }
    }

    function onPlayerError(event)
    {
    //call next video function  
    //nextvideo(event);
   
    }

/*Google Maps*/
var myCenter=new google.maps.LatLng(24.466193, 54.3113088);

function initialize()
{
var mapProp = {
  center:myCenter,
  scrollwheel: false,
  zoom:7,
  mapTypeId:google.maps.MapTypeId.ROADMAP
  };

var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

var marker=new google.maps.Marker({
  position:myCenter,
  icon: img_path + '/fh_map_icon.png'
  });

var cntn1 = '<h4>Finance House</h4>'+'<p>Orjowan Tower Building</p><p>Zayed 1st Street, Khalidiya Area</p><p>P.O.Box: 7878 Abu Dhabi, U.A.E.</p>';

var infowindow1 =  new google.maps.InfoWindow({
  content: cntn1
});

marker.addListener('click', function() {
    infowindow1.open(map, marker);
  });

 // dubai branch 25.186134, 55.254799
    var marker2 = new google.maps.Marker({
      position: new google.maps.LatLng(25.151747, 55.226639),
      map: map,
       icon: img_path + '/fh_map_icon.png'
  });

    var cntn2 = '<h4>Finance House Dubai</h4>'+'<p>Sh. Zayed Road, Al Quz Area</p><p>3rd Interchange Towards Dubai</p><p>P.O.Box 124100, Dubai, U.A.E.</p>';

    var infowindow2 =  new google.maps.InfoWindow({
        content: cntn2
});

marker2.addListener('click', function() {
    infowindow2.open(map, marker2);
  });

    // sharjah branch
    var marker3 = new google.maps.Marker({
      position: new google.maps.LatLng(25.319532, 55.374816), 
      map: map,
       icon: img_path + '/fh_map_icon.png'
  });

    var cntn3 = '<h4>Finance House Sharjah</h4>'+'<p>Al Khan Corniche Street</p><p>P.O.Box 31004, Sharjah, U.A.E.</p>';

    var infowindow3 =  new google.maps.InfoWindow({
        content: cntn3
});

marker3.addListener('mouseover', function() {
    infowindow3.open(map, marker3);
  });
marker3.addListener('mouseout', function() {
    infowindow3.close();
});

    marker.setMap(map);
    marker2.setMap(map);
    marker3.setMap(map);
}

/*Google Maps*/


function initialize_invcontact() {
    var mapProp = {
        center: myCenter,
        disableDefaultUI: false,
        scrollwheel: false,
        zoom: 15,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    var map = new google.maps.Map(document.getElementById("googleMap_invcon"), mapProp);
    var marker = new google.maps.Marker({
        position: myCenter,
        icon: img_path + '/fh_map_icon.png'
    });
    
   marker.setMap(map);
}


function virtualtourzoom(){
     // Disable scroll zooming and bind back the click event
  var onMapMouseleaveHandler = function (event) {
    var that = $(this);

    that.on('click', onMapClickHandler);
    that.off('mouseleave', onMapMouseleaveHandler);
    that.find('iframe').css("pointer-events", "none");
  }

  var onMapClickHandler = function (event) {
    var that = $(this);

    // Disable the click handler until the user leaves the map area
    that.off('click', onMapClickHandler);

    // Enable scrolling zoom
    that.find('iframe').css("pointer-events", "auto");

    // Handle the mouse leave event
    that.on('mouseleave', onMapMouseleaveHandler);
  }

  // Enable map zooming with mouse scroll when the user clicks the map
  $('.virtualtourContainer').on('click', onMapClickHandler);
}

function getForm(fromval) {
    if (fromval === 'product') {
        $("#feedback").hide();
        $("#apply-for-product").show();
    } else if (fromval === 'feedback') {
        $("#apply-for-product").hide();
        $("#feedback").show();
    } else {
        $("#feedback").hide();
    }
}

$(document).on("click", ".blockOverlay", function () {
    popup_close();
});

function data_popup(closeImagePath, videourl) {
    $(document.body).append('<div id="popup_container" style="background-color: white;"></div>');
    $("#popup_container").html('<iframe class="fancybox" width="410px" height="360px" frameborder="0" style="background-color: white !important;" allowfullscreen="" src="' + videourl + '"></iframe>');
    $.blockUI({
        theme: false,
        message: $('#popup_container'),
        clickUnblock: true
    });
}

function popup_close() {
    $.unblockUI({
        onUnblock: function () {
            $('#popup_container').remove();
        }
    });
}

// SSS 1620
// START MENU ITEMS FUNCTIONALITY
// function subMenuEffects() {
//     // ACTIVE FUNCTIONALITY
//     $(".current-menu-ancestor, .current-menu-item").children("a").addClass('active');
//     // ACTIVE FUNCTIONALITY
//     var menus = $(".nav ul#menu-main-menu");

//     menus.children("li").each(function () {
//         // if(){
//         //     $(".current-menu-ancestor, .current-menu-item").children("a").addClass('active');
//         // }
//         // HOVER CLASS FUNCTIONALITY
//         $(this).hover(
//                 function () {
//                     $(".current-menu-ancestor, .current-menu-item").children("a").removeClass('active');
//                     $(this).children("a").addClass('active');
//                     // HIDEOUT EXTRA DIV FOR SUBMENU
//                     $internal_div = $(this).children("div");
//                     if ($internal_div.children('ul.sub-menu').length <= 0) {
//                         $internal_div.hide();
//                     }
//                     // HIDEOUT EXTRA DIV FOR SUBMENU
//                     $(".hoverLightBox").show();
//                 },
//                 function () {
//                     $(this).children("a").removeClass('active');
//                     $(".current-menu-ancestor, .current-menu-item").children("a").addClass('active');

//                     $(".hoverLightBox").hide();
//                 }
//         );
//         // HOVER CLASS FUNCTIONALITY
//     });
    
//     //1360 - Added to show the dropdown menu on hover
//     $(".arrow_hover").hover(function(){
//         //$(this).children("ul").show();
//         //alert('test');
//     });
    
    
// }

// function drag(ev) {
//     $("#myCarousel").carousel('next');
// }
function subMenuEffects() {
     
     // var current_item = $( "a[href='"+window.location.href+"']" );
     // if(current_item.length > 0){
     //    current_item.addClass( "current-menu-item" );
     // }else{
        current_item = $('a.current-menu-item');
     // }

     if(current_item.hasClass('current-menu-item')){
        current_item.closest("li.dropdown").addClass("current-menu-ancestor");
     }

    $(".main-menu-fhs").find(".current-menu-ancestor a:first, .current-menu-item").addClass('active');

    var activelink = $(".main-menu-fhs").find('.current-menu-ancestor');
    var homeicon_li = $('ul.breadcrumb').find('a.homeicon').parent("li");
    if(activelink.length == 0){
        if(homeicon_li.length>0){
            var current_section = homeicon_li.next().next("li");
            if(current_section.length>0){
                current_section.addClass("current-menu-ancestor");
                var current_menu = current_section.next().next("li").children('a');
                if(current_menu.length>0){
                    current_menu.addClass("current-menu-item");
                    var citem = $(".main-menu-fhs").find( "a[href='"+ current_menu.attr('href') +"']" );
                    if(citem.length){
                        citem.addClass( "current-menu-item" ).addClass("active");
                        citem.closest("li.dropdown").addClass("current-menu-ancestor").children('a').addClass("active");
                    }
                }                
            }            
        }
    }
    if(homeicon_li.length>0){
        var last_bitem = $('ul.breadcrumb li').last('li');
        if( (last_bitem != homeicon_li) && ( $("ul.breadcrumb li").length > 1) ){
            last_bitem.addClass('currentlink');
            var bitem_name = last_bitem.children("a").text();
            last_bitem.html("<span>"+bitem_name+"</span>");
        }
    }

    // ACTIVE FUNCTIONALITY
    var menus = $(".main-menu-fhs");
    menus.children("li").each(function () {
        // HOVER CLASS FUNCTIONALITY
        $(this).hover(
                function () {
                    $(this).closest('ul').find(".current-menu-ancestor a:first, .current-menu-item").removeClass('active');
                    $(this).children("a").addClass('active');
                    $(this).children('.dropdown-menu, .bubble', this).fadeIn("fast");
                    // HIDEOUT EXTRA DIV FOR SUBMENU
                    // $internal_div = $(this).children("div");
                    // if ($internal_div.children('ul.sub-menu').length <= 0) {
                    //     $internal_div.hide();
                    // }
                    // HIDEOUT EXTRA DIV FOR SUBMENU
                    // $(".hoverLightBox").show();
                },
                function () {
                    $(this).children("a").removeClass('active');
                    $(this).closest('ul').find(".current-menu-ancestor a:first, .current-menu-item").addClass('active');
                    $(this).children('.dropdown-menu, .bubble', this).fadeOut("fast");
					// $(".hoverLightBox").hide();
                }
        );
        // HOVER CLASS FUNCTIONALITY
    });
}
// END MENU ITEMS FUNCTIONALITY

// START GO TO TOP BUTTON FUNCTIONALITY
function goToTop() {
    $(".topBtn a").on('click', function () {
        $("html, body").animate({scrollTop: 0}, 600);
        return false;
    });
}
// END GO TO TOP BUTTON FUNCTIONALITY

// START NUMBER VALIDATION
function number_validation() {
    $(".wpcf7-validates-as-tel,input[type=tel]").keydown(function (e) {
        /* Allow: backspace, delete, tab, escape, enter and . */
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                /* Allow: Ctrl+A, Command+A */
                        (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                        /* Allow: home, end, left, right, down, up */
                                (e.keyCode >= 35 && e.keyCode <= 40)) {
                    /* let it happen, don't do anything */
                    return;
                }
                /* Ensure that it is a number and stop the keypress */
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });

}
// END NUMBER VALIDATION

// SSS 1620

$(".setactive li a").on('click', function () {
    $(this).addClass('current');
});

function home_page_carousel() {
    // if ($('.carousel').length > 0) {
    //     $('.carousel').carousel({
    //         interval: 3000,
    //         cycle: true
    //     });
    // }


}

function font_resizer_hover_functionality() {
    var fontresizer = $("img#plus").parent();
    fontresizer.children("img").each(function () {
        // HOVER CLASS FUNCTIONALITY
        $(this).hover(
        function () {
            $(this).attr('src', $(this).attr('src').replace(".png", "_hover.png"));
        },
        function () {
            $(this).attr('src', $(this).attr('src').replace("_hover.png", ".png"));
        }
        );
        // HOVER CLASS FUNCTIONALITY
    });
}

function get_job_url() {
	
    if ((pagename_3 == 'careers-description') && (pathname_ar !== null)) {
		
        var hfref_val = $('[hreflang="ar"]').attr('href');
        var hfref_val2 = hfref_val + '?' + pathname_ar;
        $('[hreflang="ar"]').attr('href', hfref_val2);
    }

    if ((pagename_3 == 'careers-description-ar') && (pathname_ar !== null))  {

        var hfref_val_en = $('[hreflang="en"]').attr('href');
        var hfref_val2_en = hfref_val_en + '?' + pathname_ar;
        $('[hreflang="en"]').attr('href', hfref_val2_en);

    }

    if ((pagename == 'job-application') && (pathname_ar !== null)) {
        var hfref_val = $('[hreflang="ar"]').attr('href');
        var hfref_val2 = hfref_val + '?' + pathname_ar;
        $('[hreflang="ar"]').attr('href', hfref_val2);
    }

    if ((pagename_2 == '%D8%B7%D9%84%D8%A8-%D9%88%D8%B8%D9%8A%D9%81%D8%A9') && (pathname_ar !== null))
    {
        var hfref_val_en = $('[hreflang="en"]').attr('href');
        var hfref_val2_en = hfref_val_en + '?' + pathname_ar;
        $('[hreflang="en"]').attr('href', hfref_val2_en);
    }

    if( (pagename == 'en') && (pagename_3 == 'submit-your-cv') ) {
        var hfref_val = $('[hreflang="ar"]').attr('href');
        var hfref_val2 = hfref_val + '?' + pathname_ar;
        $('[hreflang="ar"]').attr('href', hfref_val2);
    }
    
    if( (pagename == 'ar') && (pagename_3 == 'submit-your-cv') ) {

        var hfref_val = $('[hreflang="en"]').attr('href');
        var hfref_val2 = hfref_val + '?' + pathname_ar;
        $('[hreflang="en"]').attr('href', hfref_val2);

    }

}

function scroll_fixed_footer_effect() {
    $('.scroll-fix').scrollToFixed({
        bottom: 0,
        limit: $('.fixedFooter').offset().top,
        preFixed: function () {
            $(this).find('div.fixedFooter').css('display', 'block');
        },
        postFixed: function () {
            $(this).find('div.fixedFooter').css('display', 'none');
        }
    });
}

/*1360 - Temp code for testing purpose to be deleted before live*/
function get_show_resolution(obj,set_element){
    var p_height = obj.outerHeight();
    var p_width = obj.outerWidth();
    var text_resolution = 'Browser Resolution (W x H): ' + p_width + 'x' + p_height;
    
    set_element.html(text_resolution);
}
/*1360 - Temp code for testing purpose to be deleted before live*/

function careers_validation(){
    if($("#careersvalform").length > 0){
        $("#careersvalform").validate({
            rules: {
                firstname: "required",
                lastname: "required",
                email: {
                    required: true,
                    email: true
                },
                mobileno: {
                    required: true,
                    maxlength: 10
                },
                experience:  {
                    required: true,
                    maxlength: 2
                },
                education:  {
                    required: true
                }
            },
            messages: {
                agree: "Please accept our policy",
                topic: "Please select at least 2 topics"
            }
        });
    }
}


function cards_equal_height(){
    equalheight = function(container){

    var currentTallest = 0,
         currentRowStart = 0,
         rowDivs = new Array(),
         $el,
         topPosition = 0;
     $(container).each(function() {

       $el = $(this);
       $($el).height('auto')
       topPostion = $el.position().top;

       if (currentRowStart != topPostion) {
         for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
           rowDivs[currentDiv].height(currentTallest);
         }
         rowDivs.length = 0; // empty the array
         currentRowStart = topPostion;
         currentTallest = $el.height();
         rowDivs.push($el);
       } else {
         rowDivs.push($el);
         currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
      }
       for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
         rowDivs[currentDiv].height(currentTallest);
       }
     });
    }

    if ($.browser.msie  && parseInt($.browser.version, 10) === 8) {
   
    } else {
      

        $(window).load(function() {
          equalheight('.overviewBoxes .row .tblBox');
          equalheight('.missionContentBox');
          equalheight('.dmbs-footer #bottom .column');
        });


        $(window).resize(function(){
          equalheight('.overviewBoxes .row .tblBox');
          equalheight('.missionContentBox ');
          equalheight('.dmbs-footer #bottom .column');
        });
    }
}

$(document).ready(function () {
    $('.headerRowOne1').hide();
    cards_equal_height();
    contactmaps();
    $(window).load(function () {
        // scroll_fixed_footer_effect();
        //get_fixed_header_footer();
        /*1360 - Temp code for testing purpose to be deleted before live*/
        var parent_obj = $(window);
        var set_element = $('div#screen_resolution');
        
		//1360 - Commented as it is no longer need.
        //get_show_resolution(parent_obj, set_element);
        
        // $(window).resize(function() {
			//1360 - Commented as it is no longer need.
            //get_show_resolution(parent_obj, set_element);
        // });
        /*1360 - Temp code for testing purpose to be deleted before live*/
        
        /*1360 - To make sticky contact us*/
        $(window).scroll(function() {
            var scroll_height = $(window).scrollTop();
            var contact_fixed_top = 175;
            if(scroll_height  > (contact_slider_top-180) ) {  
                $('.slide-out-div').css({
                    'position': 'fixed',
                    'top': contact_fixed_top+'px'
                });                
            }
            if(scroll_height  < (contact_slider_top-180) ) {  
                $('.slide-out-div').css({
                    'position': 'absolute',
                    'top': contact_slider_top+'px'
                });                
            }
        });
        /*1360 - To make sticky contact us*/
        
         /*Global Search box filled the vaule if exists*/
        /* var search_value = $("#global_search").val();
            
            if (search_value != '' && search_value.length != '') {
                //alert(search_value);
                $(".searchPannel").css({ 'display': "block" });
            }*/
        
    });

    // check_image_parent();
    $('.owl-dot:first').addClass('currentfilter');
    $('.owl-dot').click(function(){  
        $(this).addClass('currentfilter');
        $(this).siblings().removeClass('currentfilter');
    });
    number_validation();
	removeActiveOnHover();
    get_job_url();
    subMenuEffects();
	virtualtourzoom();
    goToTop();
	toggle_fees();
    toggle_nav_tabs('nav-tabs-faq');
    toggle_nav_tabs('nav-tabs-service');
    toggle_nav_tabs('nav-tabs-servicecc'); 
	toggle_nav_tabs('nav-tabs-inv');
	//menuHoverEffect();
	
    
    font_resizer_hover_functionality();
    //home_page_carousel();
    careers_validation();
    // $('video').on('playing', function (e) {
    //         // do something
    //         $('.carousel').carousel('pause');
    //     });

    //  $('video').on('pause', function (e) {
    //         // do something
    //         $('.carousel').carousel();
    //     });

    if ($("#googleMap").length > 0) {
        google.maps.event.addDomListener(window, 'load', initialize);
		 if($( window ).width() <= 1024){
		$('#googleMap').css('pointer-events','none');
		 }
    }

     if ($("#googleMap_invcon").length > 0) {
        google.maps.event.addDomListener(window, 'load', initialize_invcontact);
         if($( window ).width() <= 1024){
        $('#googleMap_invcon').css('pointer-events','none');
         }
    }


    dropdowneffect();
    // bcurrent_item = $(".breadcrumb").find("a.current-menu-item");
    // bcurrent_item.replaceWith( "<span class='current-menu-item'>"+bcurrent_item.text()+"</span>" );
storedWindowsWidth();
    imageGalleryFN();
});

function check_image_parent() {
    div = $("img.alignnone").parent("p");

    if (div.children().length == 1) {
        div.css("padding-bottom", "0px");
    }
}


function get_fixed_header_footer(){
    //Fixed Header and Footer
    $(".footer").show();
    $(window).scroll(function(){
        var sticky = $('.fixed-top');
        var scroll = $(window).scrollTop();
        if (scroll >= 48) {
            sticky.addClass('fixed').fadeIn(300);
            $('.headerRowOne1').show();
			 $(".searchPannel").show();
			
        } else {
            sticky.removeClass('fixed');
            $('.headerRowOne1').hide();
			 $(".searchPannel").hide();
        }
    });

    $('.headerRowOne1').scrollToFixed();
    $('.scroll-fix').scrollToFixed({
        bottom: 0,
        limit: $('.fixedFooter').offset().top,
        preFixed: function () {
            $(this).find('div.fixedFooter').css('display', 'block');
        },
        postFixed: function () {
            $(this).find('div.fixedFooter').css('display', 'none');
        }
    });
}

function dropdowneffect(){
    // $(".dropdown").hover(
    //     function() { 
    //         $('.dropdown-menu, .bubble', this).fadeIn("fast");
    //         // $(this).closest("li").children('a:first').addClass("active");
    //     },
    //     function() { 
    //         $('.dropdown-menu, .bubble', this).fadeOut("fast");
    //         // $(this).closest("ul").find('a.active').removeClass("active");
    //   });

    var dropdowns = $('.dropdown');
    menu_click_fn(dropdowns);    
    $( window ).resize(function() {
        var dropdowns = $('.dropdown');
        menu_click_fn(dropdowns);
    });
}

function menu_click_fn(dropdowns){
    var href = "";
    if($( window ).width() <= 1024){
        dropdowns.each(function () {
            if($(this).find('ul').length > 0){
                href = $(this).children('a:first').attr("href");
                if($(this).find("input#input-" + $(this).attr('id') ).length == 0 ){
                    $(this).children('a').after("<input id='input-" + $(this).attr('id') + "' type='hidden' value='"+href+"' />");
                    $(this).children('a:first').attr("href", '#');
                }    
            }            
        });
    }else{
        dropdowns.each(function () {
            if($(this).find('ul').length > 0){
                href = $(this).children('a:first').attr("href");
                if(href=="#"){
                    if($(this).find("input#input-" + $(this).attr('id') ).length > 0 ){
                        var a = $(this).children('a:first');
                        a.attr("href", a.next("input").val());
                        a.next("input").remove();
                    }       
                }
                 
            }            
        });
    }

    
        // $(".megamenuToggleBar").click(function(){
        //     if(!$(this).hasClass('menu-open')){
            
        //     $(this).addClass("menu-open");
            
        //     }else{
                
        //         $(this).removeClass("menu-open");
               
        //     }
        // });

}

//EXCLUSIVE TO FH THEME

function toggle_nav_tabs(section){
      $('.'+ section +' > li > a').click(function(event){
        event.preventDefault();//stop browser to take action for clicked anchor
        
        //get displaying tab content jQuery selector
        var active_tab_selector = $('.'+ section +' > li.active > a').attr('href');                  
        
        //find actived navigation and remove 'active' css
        var actived_nav = $('.'+ section +' > li.active');
        actived_nav.removeClass('active');
        
        //add 'active' css into clicked navigation
        $(this).parents('li').addClass('active');
        
        //hide displaying tab content
        $(active_tab_selector).removeClass('active');
        $(active_tab_selector).addClass('hide');
        
        //show target tab content
        var target_tab_selector = $(this).attr('href');
        $(target_tab_selector).removeClass('hide');
        $(target_tab_selector).addClass('active');
    });
}

function toggle_fees(){
$(".fees_charges").on('click', function() {
$(".fees_container").toggle('slow');
});
}

function removeActiveOnHover() {
	 var menus = $(".mega-menu-main_menu");
    menus.children("li").each(function () {
	$(this).hover(
	                function () {
                    $(this).closest('ul').find(".current-menu-ancestor a:first, .current-menu-item").removeClass('active');
					}
					);
});
}



//PG-1986
/*
function get_gal_thumb( gal_id ) {

    var ajaxURL = site.ajaxurl,
        total_thumbnails = $('ul.gal_thumbnail').children().length;

    $.ajax({
        type: 'POST',
        url: ajaxURL,
        data: { action: 'fhg_gal_thumbs',
                gal_id: gal_id,
                total_thumbnails: total_thumbnails 
              },
        success: function(response) {
            $('ul.gal_thumbnail').append(response);

            return false;
        }
    });
}

(function ($) {
    $(document).ready(function () {

        $('.gal_thumbnail li img').on('click', function() {
            $new_src = $(this).attr('src');
            $('#big-image img').attr('src', $new_src);
        });                                
        
    });
}(jQuery));

//PG-1986
*/
function contactmaps(){
    $('.panel:first').find('.panel-heading').addClass('contactactive');
    $('.panel').on('shown.bs.collapse', function (e) {
        $('.panel').find('.panel-heading').removeClass('contactactive');
        $(this).find('.panel-heading').addClass('contactactive');
    });
}

/*-------------------- added on 23/03/2016 -------------------*/

function get_gal_thumb( event, init_count ) {
	var ajaxURL = site.ajaxurl;
    var total_thumbnails = $('ul.gal_thumbnail').children().length;
	var gal_id = $('li.nxt_arrow').children('a.nxt_a').attr('rel');
	var total_image = $('ul.gal_thumbnail li:last-child').data('final');
	var width_window = window.innerWidth
			|| document.documentElement.clientWidth
			|| document.body.clientWidth;
	
    var new_count = $('ul.gal_thumbnail li:last-child').data('count');    
	$.ajax({
	type: 'POST',
	url: ajaxURL,
	data: { action: 'fhg_gal_thumbs',
			gal_id: gal_id,
			total_thumbnails: total_thumbnails, 
			new_count: new_count,
			width_window: width_window		
		  },
    	success: function(response) {

    		var li_split = response.split('|');
    		var imgWidth = $('ul.gal_thumbnail li img').width();
    		$flag = 0;
    		if(li_split[0] == 0){
    			$('.small-images ul.gal_thumbnail').animate({ left: 0 }, 'slow');
    			
    			var licounter=1;
    			$('.small-images ul.gal_thumbnail li').each(function(){
    				if($(this).attr('data-count')){
    					licounter++;
    				}
    			});

    			for(var i=7; i<licounter; i++){
    				//$('.small-images ul.gal_thumbnail li[data-count="'+ i +'"]').remove();
    			}
    		} else {
    			// console.log(imgWidth);
    			$('ul.gal_thumbnail').append(li_split[1]).fadeIn('slow');;
    			//$('.small-images ul.gal_thumbnail').animate({ left: '0' }, 'slow');
				//alert($( 'ul.gal_thumbnail' ).css( "left" ));
    		}
			
		//$("#count_galimgs_left").val($( 'ul.gal_thumbnail' ).css( "left" ));
    	   
    	}, 
    	complete: function (jqXHR, status) {
			
        	$('.gal_thumbnail li img').on('click', function() {
               
                var pathname = window.location.pathname;
                var arr = pathname.split('/');
                var ar_lang = arr.indexOf('ar');

                new_src = $(this).attr('src');
                new_title = $(this).attr('alt');
                en_comment = $(this).data('comment');
                ar_desc = $(this).data('arabic-desc');
                ar_comment = $(this).data('arabic-comment');

                $('#big-image img').attr('src', new_src);

                if(ar_lang > -1 ) {

                    if(ar_desc){
                        $('div.discription h1').show(0, '', function(){ $(this).html( ar_desc ); });
                    }else{
                        $('div.discription h1').hide(0, '', function(){ $(this).html(''); });
                    }

                    if(ar_comment){
                        $('div.discription p.comment').show(0, '', function(){ $(this).html( ar_comment ); });
                    }else{
                        $('div.discription p.comment').hide(0, '', function(){ $(this).html(''); });
                    }
                } else { 
                    if(new_title){
                        $('div.discription h1').show(0, '', function(){ $(this).html( new_title); } );
                    }else{
                        $('div.discription h1').hide(0, '', function(){ $(this).html(''); });
                    }

                    if(en_comment){
                        $('div.discription p.comment').show(0, '', function(){ $(this).html( en_comment ); });
                    }else{
                        $('div.discription p.comment').hide(0, '', function(){ $(this).html(''); });
                    }
                }

            });

			
    	}    	
    });
				
				
     return false;
}

function imageGalleryFN(){

    if($('ul.gal_thumbnail').length > 0){
        var imgWidth = $('ul.gal_thumbnail li').width();
        var count_galimgs = $("#count_galimgs").val();
        var loaded_imgs = $("ul.gal_thumbnail li").length;
        var data_final =  $('ul.gal_thumbnail li:last-child').data('final');

        $('ul.gal_thumbnail').width( ( $('ul.gal_thumbnail li').length ) * ( $('.small-images').width() ) );

        $('.gal_thumbnail li img').on('click', function() {
            $new_src = $(this).attr('src');
            $('#big-image img').attr('src', $new_src);
        });

        var i = 1;
        $('.arrows ul li.pre_arrow').on('click', function(event) {

            var data_final =  $('ul.gal_thumbnail li:last-child').data('final');
            var windowWid = $('.small-images').width();
            var init_count = $('ul.gal_thumbnail li:last-child').data('count');
            $('ul.gal_thumbnail').width( data_final * windowWid );
            event.preventDefault();
            loaded_imgs = $("ul.gal_thumbnail li").length;
            if(loaded_imgs < count_galimgs){
                get_gal_thumb( event, init_count );    
            }

            var cssval1 = $( '#count_galimgs_left' ).val();
            var setpre = $("#count_galimgs_total").val();

            if(setpre > 0){	
                var total_pages = Math.round(data_final/6);
                var setpre1 = parseInt(setpre) - 1;
                var next_page = parseInt(setpre);
                
                $('ul.gal_thumbnail li[title="'+setpre+'"]').show();		
                $('ul.gal_thumbnail li[title="'+setpre1+'"]').hide();
                
                if(next_page < total_pages){
                    $("#count_galimgs_total").val( parseInt(setpre) + 1);
                    $("#count_galimgs_left").val(parseInt(setpre) - 1);
                }else{
                    $("#count_galimgs_left").val(parseInt(setpre) - 1);
                }
            }

            if(loaded_imgs < count_galimgs){
                var attr = $('ul.gal_thumbnail li:visible').attr('title');
                if (typeof attr !== typeof undefined && attr !== false) {
                }else{
                    $('ul.gal_thumbnail li:visible').attr('title',i);
                }

                $('ul.gal_thumbnail li').hide();				
                $("#count_galimgs_left").val(i);
            }

            i++;
        });

        $('.arrows ul li.nxt_arrow').on('click', function(event) {
            loaded_imgs = $("ul.gal_thumbnail li").length;
            var valshow = $("#count_galimgs_left").val();
            
            if(loaded_imgs > 6 && valshow > 0){
                var attr = $('ul.gal_thumbnail li:visible').attr('title');
                
                if (typeof attr !== typeof undefined && attr !== false) {
                }else{
                    $('ul.gal_thumbnail li:visible').attr('title',parseInt(valshow) + 1);
                }
                $('ul.gal_thumbnail li').hide();	
                $('ul.gal_thumbnail li[title="'+valshow+'"]').show();
                $("#count_galimgs_left").val(parseInt(valshow) - 1);
                $("#count_galimgs_total").val(parseInt(valshow) + 1);
            }
        });
    }

}

function storedWindowsWidth(){
	var ajaxURL = site.ajaxurl;
	var width_window = window.innerWidth
			|| document.documentElement.clientWidth
			|| document.body.clientWidth;
	$.ajax({
        type: "POST",
        url: ajaxURL ,
        data: { action: 'fhg_gal_thumbs_windows_width',
			width_window: width_window		
		  },       
        dataType: "json",
        success: function (data)
        {
           
        }
    });
}

(function ($) {
    $(window).load(function () { 

        menuHoverEffect();
        urlCheckAR();// added on 11/04/2016

        pfcc_AR();// added on 12/04/2016
    });


}(jQuery));

function menuHoverEffect() {

    var pathname = window.location.pathname;
    var path_splt_arr = pathname.split('/');
    arr = path_splt_arr[path_splt_arr.length-1];
    //*--------------For Arabic menu ------------------*
    $("#mega-menu-main_menu li a").each(function(){
        var currhref = $(this).attr("href");
        var spl_val = currhref.split("/");
        arr2 = spl_val[spl_val.length-1];

        if(arr == arr2){
            $(this).parent().addClass("current-menu-item");
            $(this).closest('#mega-menu-main_menu li.mega-menu-megamenu').addClass("mega-current_page_item");
        }
    });

    $("#mega-menu-header_top_menu li a").each(function(){
        var currhref = $(this).attr("href");
        var spl_val = currhref.split("/");
        var ar_lang = spl_val.indexOf('ar');
        arr2 = spl_val[spl_val.length-1];
       
        if(arr == arr2){
            $(this).parent().parent().parent().addClass("mega-current_page_item");
            $(this).closest('#mega-menu-header_top_menu li').addClass("mega-current_page_item");
        }

        if(pagename == 'News' || pagename_2 == 'News' || pagename == 'events' || pagename_2 == 'events' || pagename == 'media' || pagename_2 == 'media' ) {
            $("#mega-menu-header_top_menu li").removeClass('mega-current_page_item');
            $(".fhg-media").addClass('mega-current_page_item');
            if(ar_lang > -1) {
                $(".mega-media").addClass('mega-current_page_item');
            }
        } else if(pagename == 'blog' || pagename_2 == 'blog') {
            $("#mega-menu-header_top_menu li").removeClass('mega-current_page_item');
            $(".fhg-blog").addClass('mega-current_page_item');
            if(ar_lang > -1) {
                $(".mega-blog").addClass('mega-current_page_item');
            }
        }else if(pagename == 'careers-2' || pagename_2 == 'careers') {
             $("#mega-menu-header_top_menu li").removeClass('mega-current_page_item');
            $(".fhg-careers").addClass('mega-current_page_item');
            if(ar_lang > -1) {
                $(".mega-careers").addClass('mega-current_page_item');
            }
        }

    }); 

    $("#mega-menu-main_menu li").mouseover(function(){
        $("#mega-menu-main_menu li").removeClass('mega-current_page_item');
        $(this).addClass('mega-current_page_item');

        if( $(this).hasClass('mega-current-page-ancestor') ) {
            $("#mega-menu-main_menu li").removeClass('mega-current-page-ancestor'); 
            $(this).addClass('mega-current-page-ancestor'); 
        }
        
    });
    $("#mega-menu-main_menu li").mouseout(function(){
        $("#mega-menu-main_menu li").removeClass('mega-current_page_item'); 
        
       if( $(this).hasClass('mega-current-page-ancestor') ) {
            $("#mega-menu-main_menu li").removeClass('mega-current-page-ancestor'); 
        }
    });

    $("#mega-menu-header_top_menu li").mouseover(function(){
        $("#mega-menu-header_top_menu li").removeClass('mega-current_page_item');
        $(this).addClass('mega-current_page_item');

        if( $(this).hasClass('mega-current-page-ancestor') ) {
            $("#mega-menu-header_top_menu li").removeClass('mega-current-page-ancestor'); 
            $(this).addClass('mega-current-page-ancestor'); 
        }

    });
    $("#mega-menu-header_top_menu li").mouseout(function(){
        $("#mega-menu-header_top_menu li").removeClass('mega-current_page_item'); 

         if( $(this).hasClass('mega-current-page-ancestor') ) {
            $("#mega-menu-header_top_menu li").removeClass('mega-current-page-ancestor'); 
        }
    });


    $("#mega-menu-main_menu").mouseout(function(){
        var pathname = window.location.pathname;
        var ar = pathname.split('/');
        var ar_lang = ar.indexOf('ar');
        ar = ar[ar.length-1];

        $("#mega-menu-main_menu li a").each(function(){
            var currhref = $(this).attr("href");
            var spl_val = currhref.split("/");
            arr2 = spl_val[spl_val.length-1];

            if(ar == arr2){
                $(this).parent().addClass("mega-current_page_item");
                $(this).closest('#mega-menu-main_menu li.mega-menu-megamenu').addClass("mega-current-menu-item");
            }
        });
    });


    $("#mega-menu-header_top_menu li").mouseout(function(){
        var pathname = window.location.pathname;
        var en = pathname.split('/');
        var en_lang = en.indexOf('en');
        var ar_lang = en.indexOf('ar');
        en = en[en.length-1];

        $("#mega-menu-header_top_menu li a").each(function(){
            var currhref = $(this).attr("href");
            var spl_val = currhref.split("/");
            var last_index = currhref.lastIndexOf("/");
            var arrtp;

            if(last_index == -1){ 
                var arrtp = spl_val[spl_val.length-2];
            } else {
                var arrtp = spl_val[spl_val.length-1];
            }
            if(en == arrtp){
                $(this).parent().parent().parent().addClass("mega-current_page_item");
                $(this).closest('#mega-menu-header_top_menu li').addClass("mega-current-menu-item");
            }

            if(pagename == 'News' || pagename_2 == 'News' || pagename == 'events' || pagename_2 == 'events' || pagename == 'media' || pagename_2 == 'media' ) {
                $("#mega-menu-header_top_menu li").removeClass('mega-current_page_item');
                $(".fhg-media").addClass('mega-current_page_item');
                if(en_lang == -1) {
                    $(".mega-media").addClass('mega-current_page_item');
                }
            } else if(pagename == 'blog' || pagename_2 == 'blog') {
                $("#mega-menu-header_top_menu li").removeClass('mega-current_page_item');
                $(".fhg-blog").addClass('mega-current_page_item');

                if(ar_lang > -1) {
                    $(".mega-blog").addClass('mega-current_page_item');
                }
            } else if(pagename == 'careers-2' || pagename_2 == 'careers') {
                $("#mega-menu-header_top_menu li").removeClass('mega-current_page_item');
                $(".fhg-careers").addClass('mega-current_page_item');
                
                if(ar_lang > -1) {
                    $(".mega-careers").addClass('mega-current_page_item');
                }
            }

        }); 

    });

/*
	$("#mega-menu-header_top_menu li.mega-menu-item-has-children ul.mega-sub-menu li a").each(function(){
		var pathname = window.location.pathname;
		var split_arr_pathname = pathname.split('/');

		var last_pathname = split_arr_pathname[split_arr_pathname.length-1];
		console.log(last_pathname);

		var currenthref = $(this).attr("href");
		var splt_href_arr = currenthref.split("/");

		var last_currenthref = splt_href_arr[splt_href_arr.length-1];
		console.log(last_currenthref);

		if(last_pathname == last_currenthref ){
			$(this).parent('li').addClass("mega-current-menu-item");
		}

	});
*/

}//End of menuHoverEffect
/*-------------------- added on 23/03/2016 -------------------*/

/*-------------------- added on 11/04/2016 -------------------*/
function urlCheckAR(){
    var splt_url =  window.location.href;
    var url_count =  splt_url.split('/');

    var ar_lang = url_count.indexOf('ar');

    if( ar_lang > -1){
        if(url_count[4] == url_count[5]){
            window.location = splt_url.replace('ar/ar', 'ar');
        }

    }
}

function de() {
    $("#resume_filename").attr("style", "display:block");
     //$('#resume_filename').css("opacity","1");
  $("#delete").attr("style", "display:none");
  //$("input[type=button]").attr("style", "display:none");
}
/*-------------------- added on 11/04/2016 -------------------*/


/*-------------------- added on 12/04/2016 -------------------*/
function pfcc_AR() {
    var pathname = window.location.pathname;
    var ar = pathname.split('/');
    var ar_lang = ar.indexOf('ar');
    var ar_url = ar[ar.length-1];

    if( ar_lang > -1 ){
        
        $("#menu-personal-finance-credit-cards-ar li a").each(function(){
            var currhref = $(this).attr("href");
            var spl_val = currhref.split("/");
            arr2 = spl_val[spl_val.length-1];

            if(ar_url == arr2 ){
                $('#menu-personal-finance-credit-cards-ar li').removeClass("current_page_item active");
                $(this).parent('li').addClass("current_page_item active");
            }
        });

    }

}



/*-------------------- added on 12/04/2016 -------------------*/




$(document).ready(function(){
    $(".megamenuToggleBar").click(function(){
        $(".megamenuToggleBar").toggleClass("menu-open");
    });
});
