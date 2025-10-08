<?php

return [
    'default' => env('FILESYSTEM_DISK', 'local'),

    'disks' => [

        'local' => [
            'driver' => 'local',
            // O disco 'local' é para arquivos que não precisam ser acessíveis publicamente.
            'root' => storage_path('app'), 
            'throw' => false,
        ],

        'public' => [
            'driver' => 'local',
            // ESTA É A CONFIGURAÇÃO PADRÃO E CORRETA.
            // O Laravel salvará os arquivos em /app/storage/app/public
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
            'throw' => false,
        ],

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

    'links' => [
        // O comando `storage:link` usará esta configuração para criar o link simbólico.
        public_path('storage') => storage_path('app/public'),
    ],
];
