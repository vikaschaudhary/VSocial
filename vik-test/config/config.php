<?php

return array(
    'twitter' => array(
        "consumer_key" => "jKoeQUi4SSTHzc2SHk6cUQ",
        "consumer_secret" => "EyswGEcEKNbbKg5uowsuvy5QGEewqkCRIyGBcbgQAFc",
        "callback_url" => "http://10.2.2.82/vik-test/public/?service=twitter_connect",
    ),
    'facebook' => array(
        /**
         * @user_data_permission
          email,publish_actions,user_about_me,user_actions.books,user_actions.music,
          user_actions.news,user_actions.video,user_activities,user_birthday,
          user_education_history,user_events,user_games_activity,user_groups,user_hometown,
          user_interests,user_likes,user_location,user_notes,user_photos,user_questions,
          user_relationship_details,user_relationships,user_religion_politics,user_status,
          user_subscriptions,user_videos,user_website,user_work_history
         * @friends_data_permission
          friends_about_me,friends_actions.books,friends_actions.music,friends_actions.news,
          friends_actions.video,friends_activities,friends_birthday,friends_education_history,
          friends_events,friends_games_activity,friends_groups,friends_hometown,friends_interests,
          friends_likes,friends_location,friends_notes,friends_photos,friends_questions,
          friends_relationship_details,friends_relationships,friends_religion_politics,
          friends_status,friends_subscriptions,friends_videos,friends_website,
          friends_work_history,
         * @extended_data_permission
          ads_management,create_event,create_note,export_stream,friends_online_presence,
          manage_friendlists,manage_notifications,manage_pages,photo_upload,publish_stream,
          read_friendlists,read_insights,read_mailbox,read_page_mailboxes,read_requests,
          read_stream,rsvp_event,share_item,sms,status_update,user_online_presence,
          video_upload,xmpp_login
         */
        "app_id" => "429266697146489",
        "app_secret" => "fdc165d62cae1b19e2d4e032080e480b",
        #"app_id" => "706738682675039",
        #"app_secret" => "4987aeaa17a8a1a8197e173025c9c112",
        "callback_url" => "http://localhost/vik-test/public/?service=facebook",
        "scope" => "email,publish_actions,user_about_me,user_actions.books,user_actions.music,user_actions.news,user_actions.video,user_activities,user_birthday,user_education_history,user_events,user_games_activity,user_groups,user_hometown,user_interests,user_likes,user_location,user_notes,user_photos,user_questions,user_relationship_details,user_relationships,user_religion_politics,user_status,user_subscriptions,user_videos,user_website,user_work_history,friends_about_me,friends_actions.books,friends_actions.music,friends_actions.news,friends_actions.video,friends_activities,friends_birthday,friends_education_history,friends_events,friends_games_activity,friends_groups,friends_hometown,friends_interests,friends_likes,friends_location,friends_notes,friends_photos,friends_questions,friends_relationship_details,friends_relationships,friends_religion_politics,friends_status,friends_subscriptions,friends_videos,friends_website,ads_management,create_event,create_note,export_stream,friends_online_presence,manage_friendlists,manage_notifications,manage_pages,photo_upload,publish_stream,read_friendlists,read_insights,read_mailbox,read_page_mailboxes,read_requests,read_stream,rsvp_event,share_item,sms,status_update,user_online_presence,video_upload,xmpp_login",
    ),
    'linked_in' => array(
        'api_key' => 'tglltxkw7pso',
        'secret_key' => 'Dcxfo0O8asGadRwL',
        'oauth_user_token' => '54453201-cb03-4647-a137-ddf171f11f6a',
        'oauth_user_secret' => '63ec704f-eda2-4f9b-a5ca-fdb0ccbbccb6',
        "callback_url" => "http://10.2.2.82/vik-test/public/?service=linkedin_connect",
        "scope" => "r_fullprofile r_emailaddress"
    ),
    'linkedin' => array(
        'appKey' => 'tglltxkw7pso',
        'appSecret' => 'Dcxfo0O8asGadRwL',
        'callbackUrl' => null,
    ),
    'instagram' => array(
        'client_id' => '8176debca4de4d8e90521d8fbd0833fa',
        'client_secret' => '83c740c7671d4332bb7198fa7c14c71d',
        'website' => 'http://10.2.2.82',
        'redirect_uri' => 'http://10.2.2.82/vik-test/public/index.php?service=instagram_connect',
    ),
    'pintrest' => array(
        'api_key' => '',
        'api_secret' => '',
    ),
    'google' => array(
        'use_objects' => false,
        'application_name' => '',
        'oauth2_client_id' => '440535774774.apps.googleusercontent.com',
        'oauth2_client_secret' => 'RowFgGefOVoB9Otv9ih1p8I5',
        'oauth2_redirect_uri' => 'http://localhost/vik-test/public/?service=gplus_connect',
        'developer_key' => 'AIzaSyA4T0K7I7t_2Y1FsqYF2A-e0x4gG8B7790',
        'site_name' => 'www.example.org',
        'authClass' => 'OAuth2',
        'cacheClass' => 'File',
        'ioClass' => 'CurlIO',
        'basePath' => 'https://www.googleapis.com',
        'ioFileCache_directory' => dirname(__DIR__) . '/public/cache',
        'services' => array(
//            'analytics' => array('scope' => 'https://www.googleapis.com/auth/analytics.readonly'),
//            'calendar' => array(
//                'scope' => array(
//                    "https://www.googleapis.com/auth/calendar",
//                    "https://www.googleapis.com/auth/calendar.readonly",
//                )
//            ),
//            'books' => array('scope' => 'https://www.googleapis.com/auth/books'),
//            'latitude' => array(
//                'scope' => array(
//                    'https://www.googleapis.com/auth/latitude.all.best',
//                    'https://www.googleapis.com/auth/latitude.all.city',
//                )
//            ),
//            'moderator' => array('scope' => 'https://www.googleapis.com/auth/moderator'),
            'oauth2' => array(
                'scope' => array(
                    'https://www.googleapis.com/auth/userinfo.profile',
                    'https://www.googleapis.com/auth/userinfo.email',
                )
            ),
            'plus' => array('scope' => 'https://www.googleapis.com/auth/plus.login'),
            'youtube' => array(
                'scope' => array(
                    'https://www.googleapis.com/auth/youtube',
                    'https://www.googleapis.com/auth/yt-analytics.readonly',
                )
            )
//            'siteVerification' => array('scope' => 'https://www.googleapis.com/auth/siteverification'),
//            'tasks' => array('scope' => 'https://www.googleapis.com/auth/tasks'),
//            'urlshortener' => array('scope' => 'https://www.googleapis.com/auth/urlshortener')
        )
    ),
);
?>
