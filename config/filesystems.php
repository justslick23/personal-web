<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
            'throw' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
            'throw' => false,
        ],

        // You can keep this 's3' disk if you have other S3 needs,
        // but your 'b2' disk below will be configured for B2's S3 compatibility.
        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
        ],

        // This is your 'b2' disk, now configured to use the 's3' driver
        // for Backblaze B2's S3-compatible API.
        'b2' => [
            'driver'                 => 's3', // Changed from 'b2' to 's3'
            'key'                    => env('AWS_ACCESS_KEY_ID'), // Uses AWS_ variables
            'secret'                 => env('AWS_SECRET_ACCESS_KEY'), // Uses AWS_ variables
            'region'                 => env('AWS_DEFAULT_REGION'), // Placeholder, B2 doesn't use regions like AWS
            'bucket'                 => env('AWS_BUCKET'), // Uses AWS_ variables
            'endpoint'               => env('AWS_ENDPOINT'), // CRUCIAL: Backblaze B2 S3 endpoint
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', true), // Often required for S3-compatible storage
            'throw'                  => false,
            // 'url' => env('AWS_URL'), // If you have a custom domain/CDN for public access
        ],

    ], // Closing bracket for 'disks' array

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];