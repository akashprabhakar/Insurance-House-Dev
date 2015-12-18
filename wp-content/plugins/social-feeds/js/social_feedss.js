$ = jQuery.noConflict();

$(window).load(function () {

      $('.feed-facebook').show();
    $('.feed-twitter').hide();
    $('.feed-linkedin').hide();
    $('.feed-youtube').hide();
    $('.feed-instagram').hide();

 
  $('a.facebook').hover(function() {
           
    $('.feed-facebook').show();
    $('.feed-twitter').hide();
    $('.feed-linkedin').hide();
    $('.feed-youtube').hide();
    $('.feed-instagram').hide();

});
  
  $('a.twitter').hover(function() {
     
    $('.feed-facebook').hide();
    $('.feed-twitter').show();
    $('.feed-linkedin').hide();
    $('.feed-youtube').hide();
    $('.feed-instagram').hide();
});
  $('a.linkedin').hover(function(){
   
         $('.feed-facebook').hide();
                $('.feed-twitter').hide();
                $('.feed-linkedin').show();
                $('.feed-youtube').hide();
                 $('.feed-instagram').hide();
  }); 
   $('a.youtube').hover(function() {
      
             $('.feed-facebook').hide();
                $('.feed-twitter').hide();
                $('.feed-linkedin').hide();
                $('.feed-youtube').show();
                 $('.feed-instagram').hide();
        });
   $('a.instagram').hover(function(){
          
          $('.feed-facebook').hide();
                $('.feed-twitter').hide();
                $('.feed-linkedin').hide();
                $('.feed-youtube').hide();
                 $('.feed-instagram').show();
  });



    socialFeedsAjax();
   // allsocialFeedsAjax();

    
});


function socialFeedsAjax() {
    
    $.ajax({
        url: base_url+'/wp-content/plugins/social-feeds/social-feeds.ajax.php',
        data: 'type=get_data',
        type: 'POST',
        success: function (data) {
            $('.ajaxloader').hide();
            $('.slide-out-div1').append(data);

        }

    });


}

function allsocialFeedsAjax(){

  $.ajax({
        url: base_url+'/wp-content/plugins/social-feeds/social-feeds.ajax.php',
        data: 'type=get_data_social',
        type: 'POST',
        success: function (data) {
            $('.ajaxloader').hide();
            $('.containersocial').append(data);

        }

    });


}