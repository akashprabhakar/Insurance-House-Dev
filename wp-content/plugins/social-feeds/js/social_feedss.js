$ = jQuery.noConflict();

$(window).load(function () {
  $(".closeBtn").hide();
  $('.mobilesocialicons').hide();
      $('.feed-facebook').show();
    $('.feed-twitter').hide();
    $('.feed-linkedin').hide();
    $('.getYoutube').hide();
    $('.feed-instagram').hide();

 
  $('a.facebook').hover(function() {           
    $('.feed-facebook').show();
    $('.feed-twitter').hide();
    $('.feed-linkedin').hide();
    $('.getYoutube').hide();
    $('.feed-instagram').hide();

});
  
  $('a.twitter').hover(function() {     
    $('.feed-facebook').hide();
    $('.feed-twitter').show();
    $('.feed-linkedin').hide();
    $('.getYoutube').hide();
    $('.feed-instagram').hide();
});
  $('a.linkedin').hover(function(){
   
         $('.feed-facebook').hide();
                $('.feed-twitter').hide();
                $('.feed-linkedin').show();
                $('.getYoutube').hide();
                 $('.feed-instagram').hide();
  }); 
   $('a.youtube').hover(function() {
      
             $('.feed-facebook').hide();
                $('.feed-twitter').hide();
                $('.feed-linkedin').hide();
                $('.getYoutube').show();
                 $('.feed-instagram').hide();
        });
   $('a.instagram').hover(function(){
          
          $('.feed-facebook').hide();
                $('.feed-twitter').hide();
                $('.feed-linkedin').hide();
                $('.getYoutube').hide();
                 $('.feed-instagram').show();
  });
  if($( window ).width() > 1024){
  $(".fa").click(function (){
    socialFeedsAjax();
  });
  

} else {
  $('.mobilesocialicons').show();
  socialFeedsAjax();
  $(".social-anchor").click(function (){

    if(!$( ".socialmediafeed_container .slide-out-div1" ).hasClass( "open" )) {
      $('.socialmediafeed_container .slide-out-div1').toggle();
       // allsocialFeedsAjax();
      $('.socialmediafeed_container .slide-out-div1').addClass('open');
      $(".closeBtn").show();
    }
  });

  $(".closeBtn").click(function (){

    if($( ".socialmediafeed_container .slide-out-div1" ).hasClass( "open" )) {
      $('.socialmediafeed_container .slide-out-div1').hide();
      $(".closeBtn").hide();
      $('.slide-out-div1').removeClass('open');
    }
  });

}


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