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
                $router->any('password', 'IndexController@password');

                $router->resource('admins', 'AdminController')->except('show');
                $router->match(['get', 'post'], 'menus/{pid}/sort', 'MenuController@sort')->name('menus.sort');
                $router->resource('menus', 'MenuController')->except('show');

                $router->any('roles/{role}/menus', 'RoleController@menus')->name('roles.menus');
                $router->any('roles/{role}/users', 'RoleController@users')->name('roles.users');
                $router->get('roles/{role}/{admin}/auth', 'RoleController@auth')->name('roles.auth');
                $router->get('roles/{role}/{admin}/remove', 'RoleController@remove')->name('roles.remove');
                $router->resource('roles', 'RoleController')->except('show');

                $router->get('logs', 'LogController@index')->name('logs.index');
            });
    }
}
