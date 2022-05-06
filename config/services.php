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
            'clinical_trials' => 'https://hooks.slack.com/services/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',
            'patents' => 'https://hooks.slack.com/services/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',
            'research' => 'https://hooks.slack.com/services/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',
            'organizations' => 'https://hooks.slack.com/services/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',
            'people' => 'https://hooks.slack.com/services/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',
            'investors' => 'https://hooks.slack.com/services/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',
            'events' => 'https://hooks.slack.com/services/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',
            'jobs' => 'https://hooks.slack.com/services/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',
            'courses' => 'https://hooks.slack.com/services/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',
            'article' => 'https://hooks.slack.com/services/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',
            'google_alerts' => 'https://hooks.slack.com/services/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',
            'news' => 'https://hooks.slack.com/services/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',
            'books' => 'https://hooks.slack.com/services/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',
            'podcasts' => 'https://hooks.slack.com/services/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',
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
