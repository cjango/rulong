<?php

/**
 * 后台默认配置
 */
return [

    'title'      => 'R.Admin',

    'directory'  => app_path('Admin'),

    'route'      => [
        'prefix'     => 'admin',
        'middleware' => ['web', 'rulong'],
        'namespace'  => 'App\\Admin\\Controllers',
    ],

    'auth'       => [
        'guards'    => [
            'rulong' => [
                'driver'   => 'session',
                'provider' => 'rulong',
            ],
        ],

        'providers' => [
            'rulong' => [
                'driver' => 'eloquent',
                'model'  => RuLong\Panel\Models\Admin::class,
            ],
        ],
    ],

    'logs'       => [
        'enable' => true,
        'except' => [
            '/',
            'dashboard',
            'password',
            'logs*',
        ],
    ],
    'permission' => [
        'except' => [
            '/',
            'auth*',
            'dashboard',
            'password',
        ],
    ],
];
