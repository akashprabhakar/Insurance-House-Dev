<?php

    session_start();
class SocialFeeds {
  
  public function getData() {
    global $wpdb;

    $sql = "SELECT * FROM fhg_capm_social_feeds";
    $result = $wpdb->get_row($sql);

    return $result;
  }

/**
 * Functions to display the social icons
 */

  public function socialicons($result){
    echo '<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">';
    echo '<div class="slide-out-div1"><img class="ajaxloader" src="'.plugin_dir_url(__FILE__).'/images/ajax-loader.gif" /><a class="handle1" href="#"> </a> <nav class="social">
           <div class="socicons"><ul class="nav-social">';

    if(isset($result->facebook_usr_id) && !empty($result->facebook_usr_id)){
     echo '<li><a href="#" class="facebook" onclick="return false;"><i class="icon-facebook"></i></a></li>';
    }
    if(isset($result->twiter_screen_name) && !empty($result->twiter_screen_name)){
     echo '<li><a href="#" class="twitter" onclick="return false;"><i class="icon-twitter"></i></a></li>';
    }
   
     echo '<li><a href="#" class="youtube" onclick="return false;"><i class="icon-youtube"></i></a></li>';
   
    if(isset($result->linked_in_code) && !empty($result->linked_in_code)){
     echo '<li><a href="#" class="linkedin" onclick="return false;"><i class="icon-linkedin"></i></a></li>';
    }
    if(!empty($result->instagram_usr_id) || !empty($result->instagram_access_tkn)){
     echo '<li><a href="#" class="instagram" onclick="return false;"><i class="icon-instagram"></i></a></li>';
    }
          
    echo  '</ul></div></nav>';
  }

  public function facebookauth($facebook_id, $fb_access_tkn){
    $page_id = $facebook_id;
    $access_token = $fb_access_tkn;
    $json_object = @file_get_contents('https://graph.facebook.com/' . $page_id . '/posts?access_token=' . $access_token.'&fields=id,message,link,created_time');
    $fbdata1 = json_decode($json_object);

    return $fbdata1;

  }

  public function fbdatavalues($post){
    $posts_msg = $post->message;
    $posts_link = $post->link;
    $posts_time = $post->created_time;
    $posts_id = $post->id;
    $img = explode("_", $posts_id);
    $data['imgid'] = $img[1];
    $datefrom = substr($posts_time, 0, 15);
    $datefrom = explode(" ", $datefrom);
    $value = array();
    if (strpos($datefrom[0], '-')) {
      $value = explode("-", $datefrom[0]);
    }
    $post_date = mktime(0, 0, 0, $value[1], $value[2], 0);
    $data['post_time'] = date("F j", $post_date);
    $length = str_word_count($posts_msg);

    if ($length >= 10) {
      $total_words = explode(" ", $posts_msg);
      $data['post_msg'] = implode(" ", array_splice($total_words, 0, 15));
    } else {
      $data['post_msg'] = $posts_msg;
    }

    $data['post_link'] = $post->link;

    return $data;
  }

  function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    if(!empty($string['i'])){

      unset($string['s']);
    }
    if(!empty($string['h'])){

      unset($string['i']);
    }
    
    return $string ? implode(', ', $string) . ' ago' : 'just now';
  }



  function social_facebook($facebook_id, $fb_access_tkn,$nocount) {

  $fbdata = $this->facebookauth($facebook_id, $fb_access_tkn);
  $data = array();
  echo '<div class="container"><div class="soc-content"><div class="feed-facebook"><div class="fb-like-box">';
  foreach ($fbdata->data as $post) {

    $data = $this->fbdatavalues($post);
    echo '<div class="fb_content">';
    echo '<div class="fb_maincontainer">';
    echo '<div class="fb_img"><img src="https://graph.facebook.com/' . $data['imgid'] . '/picture" class="fab"/></div>';
    echo '<div class="fb_right">';
    echo '<p>Finance House</p>';
    echo '<span style="margin-bottom:10px;">' . $data['post_time'] . '</span></div>';
    echo '<div class="fb_message">';
    echo '<p>' . $data['post_msg'] . '</p>';
    echo '<a href="' . $data['post_link'] . '" target="_blank">Read More</a></div>';
    echo '<div class="fb_border"></div></div></div>';

    $count++;
    if ($count == $nocount) {
      break;
    }
  }
    echo '</div></div>';
  }


  function social_facebook_all_feeds($facebook_id, $fb_access_tkn,$nocount) {
    
    $fbdata = $this->facebookauth($facebook_id, $fb_access_tkn);
    echo '<div class="row">';
    foreach ($fbdata->data as $post) {

      $data = $this->fbdatavalues($post);

      echo '<div class="mix category-1 col-sm-6 col-md-4">
       <div class="thumbnail">
       <img src="https://graph.facebook.com/' . $data['imgid'] . '/picture" width="242"  height="200" class="fab"/> 
       <div class="caption">
       <h3>Finance House</h3>
       <p>' . $this->time_elapsed_string(date("Y-m-d H:i:s",strtotime($data['post_time'])),true) . '</p>
       <p>' . $data['post_msg'] . '</p>
       <p><a href="#" onclick="return false;" class="btn btn-primary" role="button">Facebook</a><a href="' . $data['post_link'] . '" class="btn btn-primary" role="button">Read More</a></p>
       </div></div></div>';
      
      $count++;
      if ($count == $nocount) {
        break;
    }
  }
    // echo $posts;
  }


function linked_in($linkedin) {
  // $link ="https://www.linkedin.com/pub/annet-ptest/b9/b23/313";
  echo '<div class="feed-linkedin" style="display:none;">';
  echo '<script src="//platform.linkedin.com/in.js" type="text/javascript"></script>';
  echo '<script type="IN/CompanyProfile" data-id="' . $linkedin . '" data-format="inline" data-width="200"></script>';
  echo '</div>';
}

 

function linked_in_all_feeds($linkedin) {

    define('API_KEY',      '75ab08b4iqiqny'                                          );
    define('API_SECRET',   'JwY9QRtzAEi0XCn5'                                       );
    // You must pre-register your redirect_uri at https://www.linkedin.com/secure/developer
    define('REDIRECT_URI', 'http://devphp.annetsite.intranet/finance_house/social');
    define('SCOPE',        'r_basicprofile r_emailaddress'                              );
     

     
    function fetch($method, $resource, $body = '') {
       
        $opts = array(
            'http'=>array(
                'method' => $method,
                'header' => "Authorization: Bearer AQU7F2QwlesouAhm709VwHk3fTloHGZ17eMGiBYhaPDIV9gRFiEZHV-2qyESGsaxN2gOpiS8fTpMsuRKb7pAfqFYjI7joBVoADBIU2JBTmhs67fs806Femzl8_QTTTwZ9pv0t2QJD1UrdxZx0XxDy6P4YzxprkVvj0BTOlGicuxHho-VZpQ \r\n" . "x-li-format: json\r\n"
            )
        );
     
        // Need to use HTTPS
        $url = 'https://api.linkedin.com' . $resource;
     
        // Append query parameters (if there are any)
        if (count($params)) { $url .= '?' . http_build_query($params); }
     
        // Tell streams to make a (GET, POST, PUT, or DELETE) request
        // And use OAuth 2 access token as Authorization
        $context = stream_context_create($opts);
     
        // Hocus Pocus
        $response = file_get_contents($url, false, $context);
     
        // Native PHP object, please
        return json_decode($response);
    }
     

     
    // Congratulations! You have a valid token. Now fetch your profile 
    // $user = fetch('GET', 'https://api.linkedin.com/v1/people/~/network/updates?scope=self');
    $user = fetch('GET', '/v1/people/~:(id,firstName,lastName)');
    print_r($user);
     
   ob_end_flush(); 
}

// <script src="//platform.linkedin.com/in.js" type="text/javascript"></script>
// <script type="IN/CompanyProfile" data-id="448684" data-format="inline"></script>

function twitter($twiter, $twiter_widget) {
  echo '<div class="feed-twitter" style="display:none;">';
  echo '<a class="twitter-timeline"  href="https://twitter.com/' . $twiter . '" data-widget-id="' . $twiter_widget . '">Tweets by @' . $twiter . '</a>';
  echo '<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?"http":"https";if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>';
  echo '</div>';
}

public function twitter_all_feeds($twiter, $twiter_widget){

  $ch = curl_init();
   
  //set the endpoint url
  curl_setopt($ch,CURLOPT_URL, 'https://api.twitter.com/oauth2/token');
  // has to be a post
  curl_setopt($ch,CURLOPT_POST, true);
  $data = array();
  $data['grant_type'] = "client_credentials";
  curl_setopt($ch,CURLOPT_POSTFIELDS, $data);
  // here's where you supply the Consumer Key / Secret from your app:
  $consumerKey = 'KBp2lfSzeLNndKhDL48AS2SvN';
  $consumerSecret = 'iS0Fqotvb9mkxQ3WczGvVSnPVeEeu0Z4dQ1o4YiYI5Ii6MhDBB';           
  curl_setopt($ch,CURLOPT_USERPWD, $consumerKey . ':' . $consumerSecret);
   
  curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
   
  //execute post
  $result = curl_exec($ch);
   
  //close connection
  curl_close($ch);
   
  // show the result, including the bearer token (or you could parse it and stick it in a DB)       
  $bearer = json_decode($result);
  $bearer_token = $bearer->access_token;

  // error_reporting( 0 ); // don't let any php errors ruin the feed
  $username = 'MyFinanceHouse';
  $number_tweets = 4;
  $feed = "https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name={$username}&count={$number_tweets}&include_rts=1";
    $bearer = $bearer_token;
    $context = stream_context_create(array(
      'http' => array(
        'method'=>'GET',
        'header'=>"Authorization: Bearer " . $bearer
        )
    ));
    
  $json = file_get_contents( $feed, false, $context );
  $data = json_decode($json);
 //  echo "<pre>";
 // print_r($data);
 // echo "</pre>";

   foreach ($data as $tweet){
      echo '<div class="mix category-1 col-sm-6 col-md-4">';
      echo '<div class="thumbnail">';
      echo '<img src="'. $tweet->entities->media[0]->media_url . '" width="242"  height="200" class="fab"/>  ';
      echo'<div class="caption">';
      echo'<h3>'.$tweet->user->name.'</h3>';
      echo'<p><a href="https://twitter.com/MyFinanceHouse">@' . $tweet->user->screen_name . '</a></p>';
      echo'<p>' . $this->time_elapsed_string(date("Y-m-d H:i:s",strtotime($tweet->created_at)),true) . '</p>';
      echo'<p>' . $tweet->text . '</p>';
      echo'<p><a href="#" onclick="return false;" class="btn btn-primary" role="button">Twitter</a><a href="https://twitter.com/MyFinanceHouse/status/' . $tweet->id_str . '" class="btn btn-primary" role="button">Read More</a></p>';
      echo'</div></div></div>';
    }
  
}



public function youtubedata($youtube){
  //echo $youtube;
  //UCL54wvyyHcOi4Dxmy-9pXGA
  $json_object = @file_get_contents('https://www.googleapis.com/youtube/v3/search?key=AIzaSyB2HU2tUifye3KIZdMNga7Rmx53_CsuYOA&channelId='.$youtube.'&part=snippet,id&order=date');
  $fbdata1 = json_decode($json_object);
  return $fbdata1->items;
}

public function youtube($youtube,$vidcount,$page) {
  $data = $this->youtubedata($youtube);
  //echo count($data);
  foreach($data as $vid){
    $url = $vid->id->videoId;
    //echo $url;
    if($page == 'home') {
      echo '<div class="feed-youtube" style="display:none;">';
      echo '<iframe width="200" height="150" src="https://www.youtube.com/embed/' . $url . '?autoplay=0" frameborder="0" allowfullscreen></iframe>';
      echo '</div>';
    }else if($page == 'social'){
      echo '<div class="mix category-2 col-sm-6 col-md-4">';
      echo '<div class="thumbnail">';
      echo '<iframe width="200" height="180" src="https://www.youtube.com/embed/' . $url . '?autoplay=0" frameborder="0" allowfullscreen></iframe>';
      echo '<div class="caption">';
      echo '<p><a href="#" onclick="return false;" class="btn btn-primary" role="button">Youtube</a><a href="' . $post->link . '" class="btn btn-primary" role="button">Read More</a></p>';
      echo '</div></div></div>';
    }
    $count++;
    if ($count == $vidcount) {
      break;
    }
  }

}


public function instagramauth($insta_usr_id, $insta_tkn){
  $userid = $insta_usr_id;
  $accessToken = $insta_tkn;

  function fetchData($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
  }

  // Pulls and parses data.
  $result = fetchData("https://api.instagram.com/v1/users/{$userid}/media/recent/?access_token={$accessToken}");
  $result = json_decode($result);

  return $result;

}

public function instagram($insta_usr_id, $insta_tkn) {
  
  $result= $this->instagramauth($insta_usr_id, $insta_tkn);
  echo '<div class="feed-instagram" style="display:none;">';
  $instcount = 0;
  foreach ($result->data as $instagram) {
    $url = $instagram->images->standard_resolution->url;
    $imge = $instagram->images->thumbnail->url;
    echo '<a class="group" rel="group1" href="' . $url . '"><img style="display:block;position:relative;z-index:999;height:80px; width:80px; margin-right:10px; border:2px solid #309ccc;" src="' . $imge . '"</a>';
    $instcount++;
    if($instcount==9){
      break;
    }
  }
   echo '</div></div>';
  echo '</div></div>'; 
}

public function instagram_all_feeds($insta_usr_id, $insta_tkn) {
    $result= $this->instagramauth($insta_usr_id, $insta_tkn);
    foreach ($result->data as $instagram) {
      $url = $instagram->images->standard_resolution->url;
      $imge = $instagram->images->thumbnail->url;
      echo '<div class="mix category-2 col-sm-6 col-md-4">';
      echo '<div class="thumbnail">';
      echo '<a class="group" rel="group1" href="' . $url . '"><img src="' . $imge . '"</a>';
      echo '<div class="caption">';
      echo '<p><a href="#" onclick="return false;" class="btn btn-primary" role="button">Instagram</a><a href="' . $post->link . '" class="btn btn-primary" role="button">Read More</a></p>';
      echo '</div></div></div>';
    }
    echo '</div>';
   
  }

  
}

?>