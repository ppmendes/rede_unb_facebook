<?php
    //facebook application configuration -mahmud
    $fbconfig['appid' ] = "270690013026753";
    $fbconfig['secret'] = "cb42ad20986f53032123d0039ae16d66";
    $fbconfig['baseUrl']    =   "https://redeunbteste.herokuapp.com/";// "http://thinkdiff.net/demo/newfbconnect1/iframe/sdk3";
    $fbconfig['appBaseUrl'] =   "http://apps.facebook.com/rede_unbteste";
    $fbconfig['scope']      =  //permissoes para coleta de dados dos amigos do usuário do app
    'friends_about_me, friends_activities, friends_birthday, friends_checkins, friends_education_history, friends_events,'.
    'friends_games_activity, friends_groups, friends_hometown, friends_interests, friends_likes,  friends_location,';
    'friends_notes, friends_online_presence, friends_photo_video_tags, friends_photos, friends_questions, friends_relationship_details,'.
    'friends_relationships, friends_religion_politics, friends_status, friends_subscriptions, friends_videos, friends_website, friends_work_history,'.
    //permissoes para coleta de dados do usuário do app
    'user_about_me, user_activities, user_birthday, user_checkins, user_education_history, user_events,'.
    'user_games_activity, user_groups, user_hometown, user_interests, user_likes,  user_location,'.
    'user_notes, user_online_presence, user_photo_video_tags, user_photos, user_questions, user_relationship_details,'.
    'user_relationships, user_religion_politics, user_status, user_subscriptions, user_videos, user_website, user_work_history,'.
    //permissoes extendidas para coleta de dados do usuário do app
    'export_stream, manage_notifications, offline_access, photo_upload, publish_actions,'.
    'publish_stream, read_stream, share_item, status_update';

    
    /* 
     * If user first time authenticated the application facebook
     * redirects user to baseUrl, so I checked if any code passed
     * then redirect him to the application url 
     * -mahmud
     */
     
    if (isset($_GET['code'])){
        header("Location: " . $fbconfig['appBaseUrl']);
        exit;
    }
    
    //
    if (isset($_GET['request_ids'])){
        //user comes from invitation
        //track them if you need
    }
    
    $user            =   null; //facebook user uid
    try{
        include_once "facebook.php";
    }
    catch(Exception $o){
        echo '<pre>';
        print_r($o);
        echo '</pre>';
    }
    // Create our Application instance.
    $facebook = new Facebook(array(
      'appId'  => $fbconfig['appid'],
      'secret' => $fbconfig['secret'],
      'cookie' => true,
    ));

    //Facebook Authentication part
    $user       = $facebook->getUser();
    // We may or may not have this data based 
    // on whether the user is logged in.
    // If we have a $user id here, it means we know 
    // the user is logged into
    // Facebook, but we don�t know if the access token is valid. An access
    // token is invalid if the user logged out of Facebook.
    
    $loginUrl   = $facebook->getLoginUrl(
            array(
                'scope'         => $fbconfig['scope']
            )
    );

    if ($user) {
      try {
        // Proceed knowing you have a logged in user who's authenticated.
        $user_profile = $facebook->api('/me');
      } catch (FacebookApiException $e) {
        //you should use error_log($e); instead of printing the info on browser
        d($e);  // d is a debug function defined at the end of this file
        $user = null;
      }
    }

    if (!$user) {
        echo "<script type='text/javascript'>top.location.href = '$loginUrl';</script>";
        exit;
    }
    
    //get user basic description
    $userInfo           = $facebook->api("/$user");

    function d($d){
        echo '<pre>';
        print_r($d);
        echo '</pre>';
    }
?>