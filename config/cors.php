<?php

return [
    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

    // Comma-separated list in .env, e.g.
    // CORS_ALLOWED_ORIGINS=https://studentclearance31.vercel.app,http://localhost:5173
    'allowed_origins' => array_filter(array_map(
        'trim',
        explode(',', env('CORS_ALLOWED_ORIGINS', 'http://localhost:5173'))
    )),

    // Allows Vercel preview deployments too
    'allowed_origins_patterns' => ['#^https://[a-z0-9-]+\.vercel\.app$#'],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false,
];
