<?php

namespace RuLong\Panel;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class Admin
{

    public function user()
    {
        return Auth::guard('rulong')->user();
    }

    public function guest()
    {
        return Auth::guard('rulong')->guest();
    }

    public function id()
    {
        return Auth::guard('rulong')->id();
    }

    public function attempt($certificates)
    {
        return Auth::guard('rulong')->attempt($certificates);
    }

    public function logout()
    {
        return Auth::guard('rulong')->logout();
    }

    public function registerRoutes()
    {
        Route::middleware(config('rulong.route.middleware'))
            ->prefix(config('rulong.route.prefix'))
            ->name('RuLong.')
            ->namespace('RuLong\Panel\Controllers')
            ->group(function ($router) {
                $router->get('auth/login', 'AuthController@login');
                $router->post('auth/login', 'AuthController@login');
                $router->get('auth/logout', 'AuthController@logout');
                $router->get('/', 'IndexController@index');
                $router->get('password', 'IndexController@password');

                $router->resource('admins', 'AdminController');
                $router->match(['get', 'post'], 'menus/{pid}/sort', 'MenuController@sort')->name('menus.sort');
                $router->resource('menus', 'MenuController');
                $router->resource('roles', 'RoleController');
                $router->resource('permissions', 'PermissionController');
                $router->get('logs', 'LogController@index');
            });
    }
}