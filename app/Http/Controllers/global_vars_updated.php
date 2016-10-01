<?php 
//include_once(base_path().'/app/Libraries/lib.php');
return [
   /* 'PUSH_NOTIFICATION_USER_CHECK' => 'http://192.168.0.80:8000/users/###/associations',
    'PUSH_NOTIFICATION_SEND' => 'http://192.168.0.80:8000/send',*/
/*
     'PUSH_NOTIFICATION_USER_CHECK' => 'http://54.217.218.72:8000/users/###/associations',
    'PUSH_NOTIFICATION_SEND' => 'http://54.217.218.72:8000/send',
*/
/*http://54.217.218.72:8000/ */
    /* for live */
    'PUSH_NOTIFICATION_USER_CHECK' => 'http://localhost:8000/users/###/associations',
    'PUSH_NOTIFICATION_SEND' => 'http://localhost:8000/send',
    'ADMIN_NAME' => 'Couch Tomato',
    'ADMIN_PROFILEPIC' => '/img/ct-profile-pic.png',
    'SHARE_URL' => '/api/share-test',
    'TRENIND_LIMIT' => 5,
    'PUSH_NOTIFICATION_TITLE' => 'Couch Tomato',
    'BLUR_AMOUNT' => 80,
    'BLUR_CODE' => 'b',
    'PAGINATION_LIMIT' => 10,
    'COMMENT_LIMIT' => 8,
    'FEED_PAGINATION_LIMIT' => 9,
    'FEED_DESC_LIMIT' => 500,
    'SHORT_FEED_DESC_LIMIT' => 300,
	'POST_MSG_LIMIT_ADMIN' => 300,
    'SHORT_FEED_DESC_LIMIT_ADMIN' => 80,
    'REGIONAL_FEED_LIMIT' => 5,
    'FILE_UPLOAD_MAX_LIMIT' => 100000,
	'DEAL_WEB_LIMIT' => 6,
    'PATH'             => '',
    'IMAGE_PATH' => base_path()."/public/data",
    'IMAGE_POST_CODE' => 'post',
    'IMAGE_REVIEW_CODE' => 'review',
    'IMAGE_DEAL_CODE' => 'deal',    
    'USER_PHOTO_CODE' => 'userPhoto',    
    'IMAGE_PROFILE_CODE' => 'profile',
	'IMAGE_PROFILE_PAGE_CODE'=>'profilepage',
	'IMAGE_PROFILE_SMALL_CODE'=>'profilesmall',
	'IMAGE_COVER_CODE' => 'cover',
    'POST_IMAGE_DIMENSIONS' => [["width" => 350, 'height' => 293, 'code' => 's1'],["width" => 820, 'height' => 686, 'code' => 'm1']],
    'REVIEW_IMAGE_DIMENSIONS' => [["width" => 280, 'height' => 293, 'code' => 's1']],
    'DEAL_IMAGE_DIMENSIONS'=> [["width" => 626, 'height' => 415, 'code' => 's1']],
    'USER_PHOTO_IMAGE_DIMENSIONS'=> [["width" => 640, 'height' => 384, 'code' => 's1']],
    //'USER_PROFILE_IMAGE_DIMENSIONS'=> [["width" => 640, 'height' => 426, 'code' => 's1'],["width" => 1500, 'height' => 1000, 'code' => 'm1']],
    'USER_PROFILE_IMAGE_DIMENSIONS'=> [["width" => 1500, 'height' => 1000, 'code' => 'm1'],["width" => 640, 'height' => 426, 'code' => 's1']],

    'USER_TYPE' => ['user'=>'U','vendor'=>'V'],
    'EVENT_TYPE' => ['event'=>'E','appointment'=>'A','quote'=>'Q'],
	'EVENT_TYPES' => ['work'=>'W','personal'=>'P'],
  //  'TIME_SPAN_FOR_APPOINTMENT_SHOW'=>Lib::getSettings('time_span_for_appointment_show') , // in days
    //'TIME_SPAN_FOR_REMINDER_SHOW'=> Lib::getSettings('time_span_for_reminder_show'), // in days
    //'CAL_TIME_INTERVAL'=> Lib::getSettings('cal_time_interval'), // in min
    'POST_DEFAULT_IMAGE' => 'postDefault.png',
    'DEFAULT_IMAGE_PATH' => base_path()."/public",
    'DEFAULT_IMAGE' => 'chrome.png',
    'PROFILE_DEFAULT_IMAGE' => 'profileDefault.jpg',
	'PROFILE_DEFAULT_IMAGE_BG' => 'user-profilebg.jpg',
	'PROFILE_DEFAULT_IMAGE_SMALL' => 'small-profilebg.jpg',
	'PROFILE_DEFAULT_IMAGE_PAGE' => 'medium-userprofile.jpg',
    'DEAL_DEFAULT_IMAGE' => 'profileDefault.jpg',
    'ENABLE_SSL' => 1, //0:disabled; 1:enabled
    'PASSWORD_MIN' => 5,
    'USER_QUOTE_STATUS' => array('0'=>'Pending','1'=>'Expired','2'=>'Awaiting Response','3'=>'Response Received'),
    'VENDOR_QUOTE_STATUS' => ['1'=>'Pending','2'=>'Responded','3'=>'Expired'],
    'QUOTE_REMINDER' => 'Quote Reminder',
	'SPHINX'=> ['HOST'=>'127.0.0.1','PORT'=>'9306'],
	'EMAIL_LOGO'=> 'img/ct_logo.jpg',
    'IMAGE_EXTENSION' => 'jpeg',
    'vendor_search_limit' => 30,
    'WEEKDAY_FOR_USER_WORKING_HRS'=>['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'],
    'ICON_FOR_PENDING_APT'=>'pending_yellow.png',
    'ICON_FOR_CONFIRM_APT'=>'confirmed.png',
    'RESCHEDULE_REQUEST_SENT'=>'(Your reschedule request sent)',
    'RESCHEDULE_REQUEST_REC'=>'(Reschedule request received)',
    'MSG_APT_FROM'=>'Appointment request from ',
    'MSG_APT_WITH'=>'Appointment with ',
    'RESCHEDULE_OPTION_COUNT'=>3,
    //'MENU_APPOINTMENT_DISPLAY_LIMIT'=> Lib::getSettings('menu_appointment_display_limit'),
   // 'MENU_EVENT_DISPLAY_LIMIT'=>Lib::getSettings('menu_event_display_limit'),
    'DATE_FORMAT'=>'d/m/y',
	'DATETIME_FORMAT'=>'d/m/y h:i A',
    'TIME_FORMAT'=>'h:i A',
   // 'MAXIMUM_APT_DAY_CAP'=> Lib::getSettings('maximum_apt_day_cap'), // in days
    //'VENDOR_QUOTE_EXPIRY_CUTOFF_DAYS' => Lib::getSettings('maximum_apt_day_cap'),
    'CATEGORIES'=>['1'=>'Food','2'=>'Design','3'=>'Wellness'],
    'GOOGLE_FLAG'=> 1,
	'ADMIN_USER_ID'=>232,
    'ADMIN_EMAIL' => 'ctadmin@yopmail.com',
    'CONTACTUS_EMAIL' => 'ctadmin@yopmail.com',

    'SIGNUP_SOURCE' => [
        'W' => 'Web',
        'G' => 'Gmail',
        'F' => 'Facebook',
        'M' => 'Mobile',
    ],
    'BASE_DATA' => [
        'LAT' => 19.054399,
        'LONG' => 72.840599,
        'AREA' => 'Mumbai',
    ],
	'FB' =>['CLIENTID'=>'646597132109204'//'972311302806888'//441130049393016'
	],
	'GPLUS' =>['CLIENTID'=>'857558762949-1v6k3e44tb3mgbnj0tj8c9eg7q3nl4ks.apps.googleusercontent.com','KEY' => 'pVDtFyGjTs62a9RelhU7yeNp'//441130049393016'
	],
    'QUOTE_SUBJECT' => 'Reminder for quote',
    'REQUEST_QUOTE_72HRS_OFFSET' => 72*60*60,
];

?>
