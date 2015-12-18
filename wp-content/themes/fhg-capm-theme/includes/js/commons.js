//1360 - global var
var contact_slider_top = '';

(function ($) {
    $(document).ready(function () {
       
        var tag = document.createElement('script');
        tag.src = "https://www.youtube.com/iframe_api";
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

        $("#register_form").hide();
        $("#registerbtn").click(function () {
            $("#register_form").show();
            $("#login_form").hide();
        });

        $('form.wpcf7-form').addClass('jqtransform');
        $('form.maindrop').addClass('jqtransform');
        $('form.jqtransform').jqTransform();
        

        $(".careersApplyFormMainCont").hide();
         $("#appnowbtn").click(function (){
            $(".careersApplyFormMainCont").toggle();
            return false;
        });
 
        $(".handle").click(function (){
            $('.formdivs').css("opacity","1");
        });

        $('form.wpcf7-form').addClass('jqtransform');
        $('form.maindrop').addClass('jqtransform');
        $('form.jqtransform').jqTransform();
        // $(".product_listing").wrap("<div class='new'></div>");
        // $(".myclass").wrap("<div class='new'></div>");

        $("#loginbtn").click(function () {
            $("#login_form").show();
            $("#register_form").hide();
        });

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
        $('.galleryhoverBox').hoverGrid();

        $(".youtube").colorbox({iframe: true, innerWidth: 640, innerHeight: 390});

        $('.bxslider').bxSlider({
            video: true,
            useCSS: false,
            responsive: true
        });

        $(".last").click(function() {
            $(".searchPannel").toggle();
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
            return false;
        });

        $('#resume_filename').prop('disabled', true);

        $("#contactformmobile").hide();
        $("#contact_mobile").click(function () {

            $("#contactformmobile").toggle();

            return false;
        });

        $('#checklegal').change(function(){
            if(this.checked)
                $('#resume_filename').prop('disabled', false);
            else
                $('#resume_filename').prop('disabled', true);
        });
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
        
        if (pathname.indexOf('/ar/') > -1) {
            
            $("#owl-demo").owlCarousel({
                autoPlay: true,
                autoPlay: 7000,
                items : 2,
                dots:true,
                rtl:true,
                responsiveClass:true,
                responsive:{
                    0:{
                        items:1,

                    },
                    1024:{
                        items:1,

                    },
                    1152:{
                        items:2,

                    }
                },
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
                pathToTabImage: base_url + '/wp-content/themes/fhg-capm-theme/includes/images/contactUsHomepage_ar.png', //path to the image for the tab //Optionally can be set using css
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
        } else {

            $("#owl-demo").owlCarousel({
                autoPlay: true,
                autoPlay: 7000,
                items : 2,
                pagination:true,
                responsiveClass:false,
                responsive:{
                    0:{
                        items:1,

                    },
                    1024:{
                        items:1,

                    },
                    1152:{
                        items:2,
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
                pathToTabImage: base_url + '/wp-content/themes/fhg-capm-theme/includes/images/contactUsHomepage.png', //path to the image for the tab //Optionally can be set using css
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

        // SLIDEOUT FUNCTIONALITY FOR CONTACT FORM AND SOCIAL FEEDS

        $("select").addClass("selectpicker");

        $("#slide0 , #image0").addClass("active");

        


    });

}(jQuery));

function onYouTubeIframeAPIReady() {
//        console.log('IframeAPI = Ready');
        var $activeSlide  = $('.carousel').find('.item.active'),
        $player       = $('iframe[src*=youtube]', $activeSlide );
        if($player.attr('id')){
            var player = new YT.Player($player.attr('id'), {
                events: {
                    'onReady': onPlayerReady,
                    'onStateChange': onPlayerStateChange,
                    'onError': onPlayerError,
                }
            });
        }

        $(".carousel").on('slid.bs.carousel', function () {
            var $activeSlide  = $('.carousel').find('.item.active'),
            $player       = $('iframe[src*=youtube]', $activeSlide );
            if($player.attr('id')){
                var player = new YT.Player($player.attr('id'), {
                    events: {
                        'onReady': onPlayerReady,
                        'onStateChange': onPlayerStateChange
                    }
                });
            }
        });
    }

    

    function onPlayerReady(event) {
       
    }

    function onPlayerStateChange(event) {
        if (event.data == YT.PlayerState.PAUSED) {
             $('.carousel').carousel();
        }

        if (event.data == YT.PlayerState.PLAYING) {
             $('.carousel').carousel('pause');
        }

        if (event.data == YT.PlayerState.ENDED) {
           $('.carousel').carousel(); 
        }
    }

    function onPlayerError(event)
    {
    //call next video function  
    //nextvideo(event);
    alert("Adasdasd");
    }

var myCenter = new google.maps.LatLng(24.479324, 54.354453);

function initialize() {
    var mapProp = {
        center: myCenter,
        scrollwheel: false,
        zoom: 15,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
    var marker = new google.maps.Marker({
        position: myCenter,
    });

    marker.setMap(map);
}

function getForm(fromval) {
    if (fromval === 'product') {
        $("#feedback").hide();
        $("#apply-for-product").show();
    } else if (fromval === 'feedback') {
        $("#apply-for-product").hide();
        $("#feedback").show();
    } else {
        $("#apply-for-product").hide();
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
function subMenuEffects() {
     // $(".current-menu-ancestor, .current-menu-item").children("a").addClass('active');
    // ACTIVE FUNCTIONALITY
    var menus = $(".nav ul#menu-main-menu");
    // menus.children("li").each(function () {
    //     // HOVER CLASS FUNCTIONALITY
    //     $(this).hover(
    //             function () {
    //                 $(".current-menu-ancestor, .current-menu-item").children("a").removeClass('active');
    //                 $(this).children("a").addClass('active');
    //                 // HIDEOUT EXTRA DIV FOR SUBMENU
    //                 $internal_div = $(this).children("div");
    //                 if ($internal_div.children('ul.sub-menu').length <= 0) {
    //                     $internal_div.hide();
    //                 }
    //                 // HIDEOUT EXTRA DIV FOR SUBMENU
    //                 $(".hoverLightBox").show();
    //             },
    //             function () {
    //                 $(this).children("a").removeClass('active');
    //                 $(".current-menu-ancestor, .current-menu-item").children("a").addClass('active');
				// 	 $(".hoverLightBox").hide();
    //             }
    //     );
    //     // HOVER CLASS FUNCTIONALITY
    // });
    
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
    if ($('.carousel').length > 0) {
        $('.carousel').carousel({
            interval: 3000,
            cycle: true
        });
    }


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

    if ((pagename == 'careers-description') && (pathname_ar !== null))
    {
        var hfref_val = $('[hreflang="ar"]').attr('href');
        var hfref_val2 = hfref_val + '?' + pathname_ar;
        $('[hreflang="ar"]').attr('href', hfref_val2);
    }

    if ((pagename_2 == '%d9%85%d9%87%d9%86-%d9%88%d9%8a%d8%b1%d8%af-%d9%88%d8%b5%d9%81') && (pathname_ar !== null))
    {

        var hfref_val_en = $('[hreflang="en"]').attr('href');
        var hfref_val2_en = hfref_val_en + '?' + pathname_ar;
        $('[hreflang="en"]').attr('href', hfref_val2_en);

    }

    if ((pagename == 'job-application') && (pathname_ar !== null))
    {
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

$(document).ready(function () {
    $('.headerRowOne1').hide();

    $(window).load(function () {
        // scroll_fixed_footer_effect();
        //get_fixed_header_footer();
        /*1360 - Temp code for testing purpose to be deleted before live*/
        var parent_obj = $(window);
        var set_element = $('div#screen_resolution');
        
		//1360 - Commented as it is no longer need.
        //get_show_resolution(parent_obj, set_element);
        
        $(window).resize(function() {
			//1360 - Commented as it is no longer need.
            //get_show_resolution(parent_obj, set_element);
        });
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
        
    });

    // check_image_parent();
    $('.owl-dot:first').addClass('currentfilter');
    $('.owl-dot').click(function(){  
        $(this).addClass('currentfilter');
        $(this).siblings().removeClass('currentfilter');

    });
    number_validation();
    get_job_url();
    subMenuEffects();
    goToTop();
    font_resizer_hover_functionality();
    home_page_carousel();
    $('video').on('playing', function (e) {
            // do something
            $('.carousel').carousel('pause');
        });

     $('video').on('pause', function (e) {
            // do something
            $('.carousel').carousel();
        });

    if ($("#googleMap").length > 0) {
        google.maps.event.addDomListener(window, 'load', initialize);
    }



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
