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

/*
(function($) {
    $.fn.drags = function(opt) {

        opt = $.extend({handle:"",cursor:"move"}, opt);

        if(opt.handle === "") {
            var $el = this;
        } else {
            var $el = this.find(opt.handle);
        }

        return $el.css('cursor', opt.cursor).on("mousedown", function(e) {
            if(opt.handle === "") {
                var $drag = $(this).addClass('draggable');
            } else {
                var $drag = $(this).addClass('active-handle').parent().addClass('draggable');
            }
            var z_idx = $drag.css('z-index'),
                drg_h = $drag.outerHeight(),
                drg_w = $drag.outerWidth(),
                pos_y = $drag.offset().top + drg_h - e.pageY,
                pos_x = $drag.offset().left + drg_w - e.pageX;
            $drag.css('z-index', 1000).parents().on("mousemove", function(e) {
                $('.draggable').offset({
                    top:e.pageY + pos_y - drg_h,
                    left:e.pageX + pos_x - drg_w
                }).on("mouseup", function() {
                    $(this).removeClass('draggable').css('z-index', z_idx);
                });
            });
            e.preventDefault(); // disable selection
        }).on("mouseup", function() {
            if(opt.handle === "") {
                $(this).removeClass('draggable');
            } else {
                $(this).removeClass('active-handle').parent().removeClass('draggable');
            }
        });

    }
})(jQuery);

*/
/*
(function ($) {
    $(document).ready(function () {
    
        var prevX = -1;
        $('.carousel-inner .item').draggable({
            containment: "parent",
            axis: "x",
            drag: function(e) {
                $("#myCarousel").carousel('next');
                if(prevX == -1) {
                    prevX = e.pageX;    
                    return false;
                }

                // dragged left
                if(prevX > e.pageX) {
                    $("#myCarousel").carousel('next');
                } else if(prevX < e.pageX) { 
                    // dragged right
                    $("#myCarousel").carousel('previous');
                }
                prevX = e.pageX;
            }
        });

    });
}(jQuery));
*/
/*
( function ($) {
    $(document).ready(function () {
        
        var prevX = -1;
        $('.carousel-inner .item').draggable({
            containment: "parent",
            axis: "x",
            snap: true,
            stop: function(event, ui) {

                //console.log(ui.position);
                //console.log(prevX);
                //console.log(event.pageX);
                
                $("#myCarousel").carousel('next');
                if(prevX == -1) {
                    prevX = event.pageX;    
                    return false;
                }
                
                if(prevX > event.pageX) {
                    $("#myCarousel").carousel('next');  // dragged left
                }
                else if(prevX < event.pageX) { 
                    $("#myCarousel").carousel('previous');  // dragged right
                }
                prevX = event.pageX;
            }
        });

    });
}(jQuery));
*/

$(document).ready(function() {
    $("#myCarousel").swiperight(function() {  
        $("#myCarousel").carousel('prev');
    });
    $("#myCarousel").swipeleft(function() {  
        $("#myCarousel").carousel('next');
    });
});

