<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'pusher' => [
        'beams_instance_id' => env('BEAMS_INSTANCE_ID'),
        'beams_secret_key' => env('BEAMS_SECRET_KEY'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'google' => [
        'client_id' => env('G_OAUTH_CLIENT_ID', 'client_id'),
        'client_secret' => env('G_OAUTH_CLIENT_SECRET', 'client_secret'),
        'redirect' => env('G_OAUTH_CALLBACK_URL', 'http://localhost/oauth/google/callback'),
    ],

    'firebase' => [
        'api_key' => env('FIREBASE_API_KEY', 'api_key'),
        'sender_id' => env('FIREBASE_SENDER_ID', 'sender_id'),
        'app_id' => env('FIREBASE_APP_ID', 'app_id'),
        'measurement_id' => env('FIREBASE_MEASUREMENT_ID', 'measurement_id'),
        'web_platform_key' => env('FIREBASE_PLATFORM_WEB_KEY', 'web_platform_key'),
    ],

    'getlaunchlist' => [
        'form' => [
            'url' => env('GETLAUNCHLIST_FORM_URL', 'https://getlaunchlist.com/s/'),
            'code' => env('GETLAUNCHLIST_FORM_CODE', 'o9XnPe'),
        ]
    ],

    'beehiiv' => [
        'url' => env('BEEHIIV_URL','https://api.beehiiv.com/v2/publications/'),
        'api_key' => env('BEEHIIV_API_KEY', ''),
        'api_v1' => [
            'publication_id' => env('BEEHIIV_V1_PUB', '30b60b55-f0b6-493c-b327-91186dfe6cef'),
        ],
        'api_v2' => [
            'publication_id' => env('BEEHIIV_V2_PUB', 'pub_30b60b55-f0b6-493c-b327-91186dfe6cef'),
        ]
    ],

    'make' => [ // https://make.com
        'webhook_url' => env('MAKE_WEBHOOK_URL', ''),
    ],

];
