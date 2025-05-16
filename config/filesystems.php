<?php

return [

    /*
    |----------------------------------------------------------------------
    | Default Filesystem Disk
    |----------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application for file storage.
    |
    */

    'default' => env('FILESYSTEM_DISK', 'public'),  // Menggunakan 'public' sebagai default disk

    /*
    |----------------------------------------------------------------------
    | Filesystem Disks
    |----------------------------------------------------------------------
    |
    | Below you may configure as many filesystem disks as necessary, and you
    | may even configure multiple disks for the same driver. Examples for
    | most supported storage drivers are configured here for reference.
    |
    | Supported drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        // Disk untuk menyimpan file secara lokal
        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),  // Menyimpan file di dalam 'storage/app'
            'throw' => false,
        ],

        // Disk untuk menyimpan file di folder 'storage/app/public' dan dapat diakses publik
        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),  // Menyimpan file di dalam 'storage/app/public'
            'url' => env('APP_URL').'/storage',  // URL untuk akses file publik
            'visibility' => 'public',  // Set file agar dapat diakses publik
            'throw' => false,
        ],

        // Konfigurasi untuk penyimpanan di Amazon S3 (jika menggunakan cloud storage)
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

    ],

    /*
    |----------------------------------------------------------------------
    | Symbolic Links
    |----------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),  // Menautkan folder 'storage/app/public' ke 'public/storage'
    ],

];
