<?php

/**
 * 后台默认配置
 */
return [

    'version'   => '1.0.1',

    'title'     => 'R.Admin',

    'directory' => app_path('Admin'),

    'route'     => [
        'prefix'     => 'admin',
        'middleware' => ['web', 'rulong'],
        'namespace'  => 'App\\Admin\\Controllers',
    ],

    'auth'      => [
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

    'logs'      => [
        'enable' => true,
        'except' => [
            '/',
            'dashboard',
            'password',
            'ueditor',
            'logs*',
        ],
    ],
];
