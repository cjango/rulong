<?php

function admin_path($file = null)
{
    return app_path('Admin') . (!is_null($file) ? '/' . ltrim($file, '/') : '');
}

function admin_assets($file)
{
    return asset('assets/rulong/' . $file);
}

function admin_url($path = '')
{
    $prefix = '/' . trim(config('rulong.route.prefix'), '/');
    $prefix = ($prefix == '/') ? '' : $prefix;
    return $prefix . '/' . trim($path, '/');
}
