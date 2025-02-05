<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Здесь вы можете настроить доступ для кросс-доменных запросов.
    |
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie', '/*'], // Разрешаем доступ ко всем путям

    'allowed_methods' => ['*'], // Разрешаем все HTTP-методы

    'allowed_origins' => [
        'http://localhost:5173',          // для разработки через Vite Dev Server
        'http://127.0.0.1:5173',          // альтернативный вариант
        'http://my-laravel-project.loc',  // домен, если вы используете его
    ],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'], // Разрешаем все заголовки

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true, // Поддержка cookies и авторизации
];
