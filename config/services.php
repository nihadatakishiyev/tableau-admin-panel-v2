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

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'tableau' => [
        'user_egov' => env('TABLEAU_USER_EGOV'),
        'user_asan' => env('TABLEAU_USER_ASAN'),
        'address' => env('TABLEAU_ADDRESS'),
        'params' => env('TABLEAU_REQUEST_PARAMS')
    ],

    'tableau_restapi' => [
       'url' => env('TABLEAU_RESTAPI_LOGIN_URL'),
       'username' => env('TABLEAU_RESTAPI_USERNAME'),
       'password' => env('TABLEAU_RESTAPI_PASSWORD')
    ],

];
