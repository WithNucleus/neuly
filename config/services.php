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

    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => env('APP_URL') . '/login/google/callback',
    ],

    'facebook' => [
        'client_id' => env('FACEBOOK_CLIENT_ID'),
        'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
        'redirect' => env('APP_URL') . '/login/facebook/callback',
    ],

    'twitter' => [
        'client_id' => env('TWITTER_CLIENT_ID'),
        'client_secret' => env('TWITTER_CLIENT_SECRET'),
        'redirect' => env('APP_URL') . '/login/twitter/callback',
    ],

    'linkedin' => [
        'client_id' => env('LINKEDIN_CLIENT_ID'),
        'client_secret' => env('LINKEDIN_CLIENT_SECRET'),
        'redirect' => env('APP_URL') . '/login/linkedin/callback',
    ],

    'slack' => [
        'admin_notifications_enabled' => env('SLACK_ADMIN_NOTIFICATIONS_ENABLED', false),
        'webhooks' => [
            'notifications' => 'https://hooks.slack.com/services/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',
            'metrics' => 'https://hooks.slack.com/services/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',
            'metrics_change' => 'https://hooks.slack.com/services/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',
            'duplicate_media' => 'https://hooks.slack.com/services/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',
            'sales_pipeline' => 'https://hooks.slack.com/services/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'
        ],
    ],

    'serpapi' => [
        'private_api_key' => env('SERPAPI_PRIVATE_API_KEY'),
    ],

    'opencage' => [
        'api_key' => env('OPENCAGE_API_KEY'),
        'requests_per_day' => env('OPENCAGE_REQUESTS_PER_DAY', 2500),
    ],

];
