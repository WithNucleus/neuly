<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Content Security Policy Header Options
    |--------------------------------------------------------------------------
    |
    | This values configure the 'Content-Security-Policy' header
    |
    */

    'enable_content_security_policy' => true,
    'content_security_policy_value' => "default-src *  data: blob: filesystem: about: ws: wss: 'unsafe-inline' 'unsafe-eval' 'unsafe-dynamic'; script-src * data: blob: 'unsafe-inline' 'unsafe-eval'; connect-src * data: blob: 'unsafe-inline'; img-src * data: blob: 'unsafe-inline'; frame-src * data: blob: ; style-src * data: blob: 'unsafe-inline'; font-src * data: blob: 'unsafe-inline';",

    /*
    |--------------------------------------------------------------------------
    | Except CT Header Options
    |--------------------------------------------------------------------------
    |
    | This values configure the 'Except-CT' header
    |
    */

    'enable_except_ct' => true,
    'except_ct_value' => 'max-age=2147483648',

    /*
    |--------------------------------------------------------------------------
    | Feature Policy Header Options
    |--------------------------------------------------------------------------
    |
    | This values configure the 'FeaturePolicy' header
    |
    */

    'enable_feature_policy' => true,
    'feature_policy_value' => "accelerometer 'self'; ambient-light-sensor 'self'; autoplay 'self'; battery 'self'; camera 'self'; display-capture 'self'; document-domain *; encrypted-media 'self'; execution-while-not-rendered *; execution-while-out-of-viewport *; fullscreen 'self'; geolocation 'self'; gyroscope 'self'; layout-animations 'self'; legacy-image-formats 'self'; magnetometer 'self'; microphone 'self'; midi 'self'; navigation-override 'self'; oversized-images *; payment 'self'; picture-in-picture *; publickey-credentials 'self'; sync-xhr *; unoptimized-images 'self'; unsized-media *; usb 'self'; wake-lock 'self'; xr-spatial-tracking 'self'",

    /*
    |--------------------------------------------------------------------------
    | X-Frame-Options Header Options
    |--------------------------------------------------------------------------
    |
    | This values configure the 'X-Frame-Options' header
    |
    */

    'enable_x_frame_options' => true,
    'enable_x_frame_options_prefix' => [
        '/embeds',
        '/api/embeds'
    ],

    /*
    |--------------------------------------------------------------------------
    | HSTS Header Options
    |--------------------------------------------------------------------------
    |
    | This values configure the 'Strict-Transport-Security' header
    |
    */

    'enable_hsts' => true,
    'hsts_value' => 'max-age=31536000',
];
