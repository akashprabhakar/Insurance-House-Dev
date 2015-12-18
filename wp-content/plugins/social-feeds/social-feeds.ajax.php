<?php

require_once('../../../wp-load.php');
require_once('class-social-feeds.php');
$socialobj = new SocialFeeds;
$type = $_POST['type'];


switch ($type) {
    case 'facebook':


        break;
    case 'get_data':

        $result = $socialobj->getData();
        if (!empty($result)) {
            $facebook_id = $result->facebook_usr_id;
            $fb_access_tkn = $result->facebook_access_tkn;
            /* Instagram */
            $insta_usr_id = $result->instagram_usr_id;
            $insta_tkn = $result->instagram_access_tkn;
            $twiter = $result->twiter_code;
            $twiter_widget = $result->twiter_widget_id;
            $youtube = $result->youtube_url;
        } else {

            $id = "";
            $facebook_id = "";
            $fb_access_tkn = "";
            $insta_usr_id = "";
            $insta_tkn = "";
            $twiter = "";
            $twiter_widget = "";
            $youtube = "";
        }

        /* limked in */
        /* ================================================== */
        $linkedin = stripslashes($result->linked_in_code);
        /* =================================================== */


        //$socialobj->socialicons($result);
        $socialobj->social_facebook($facebook_id, $fb_access_tkn,2);
        $socialobj->linked_in($linkedin);
        $socialobj->twitter($twiter, $twiter_widget);
        $socialobj->youtube($youtube,2,'home');
        $socialobj->instagram($insta_usr_id, $insta_tkn);

        break;
     case 'get_data_social':

        $result = $socialobj->getData();
        if (!empty($result)) {
            $facebook_id = $result->facebook_usr_id;
            $fb_access_tkn = $result->facebook_access_tkn;
            /* Instagram */
            $insta_usr_id = $result->instagram_usr_id;
            $insta_tkn = $result->instagram_access_tkn;
            $twiter = $result->twiter_code;
            $twiter_widget = $result->twiter_widget_id;
            $youtube = $result->youtube_url;
        } else {

            $id = "";
            $facebook_id = "";
            $fb_access_tkn = "";
            $insta_usr_id = "";
            $insta_tkn = "";
            $twiter = "";
            $twiter_widget = "";
            $youtube = "";
        }

        /* limked in */
        /* ================================================== */
        $linkedin = stripslashes($result->linked_in_code);
        /* =================================================== */


        //$socialobj->socialicons($result);
        $socialobj->linked_in_all_feeds($linkedin);
        $socialobj->social_facebook_all_feeds($facebook_id, $fb_access_tkn,4);
      
        $socialobj->twitter_all_feeds($twiter, $twiter_widget);
        $socialobj->youtube($youtube,4,'social');
        $socialobj->instagram_all_feeds($insta_usr_id, $insta_tkn);
        
        break;
    case $value:


        break;

    default:
        break;
}
