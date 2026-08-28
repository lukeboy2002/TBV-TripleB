<?php

return [
    'name' => env('APP_NAME'),
    'short_name' => 'TripleB',
    'description' => 'TBV-TripleB app',
    'start_url' => '/',
    'id' => '/',
    'display' => 'standalone',
    'orientation' => 'portrait',
    'background_color' => '#1C2634',
    'theme_color' => '#EA570C',

    'icons' => [
        [
            'src' => '/icons/logo_192.png',
            'sizes' => '192x192',
            'type' => 'image/png',
            'purpose' => 'any',
        ],
        [
            'src' => '/icons/logo_512.png',
            'sizes' => '512x512',
            'type' => 'image/png',
            'purpose' => 'any',
        ],
    ],

    'screenshots' => [
        [
            'src' => '/screenshots/mobile.png',
            'sizes' => '978x1456',
            'type' => 'image/png',
            'form_factor' => 'narrow',
        ],
        [
            'src' => '/screenshots/desktop.png',
            'sizes' => '3346x2344',
            'type' => 'image/png',
            'form_factor' => 'wide',
        ],
    ],

    'categories' => [
        'social',
        'games',
    ],

];
