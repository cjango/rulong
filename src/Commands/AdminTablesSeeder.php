<?php

namespace RuLong\Panel\Commands;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use RuLong\Panel\Models\Admin;
use RuLong\Panel\Models\Menu;

class AdminTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create a user.
        Admin::truncate();
        Admin::create([
            'username' => 'root',
            'password' => '111111',
            'nickname' => 'Rooter',
        ]);

        // add default menus.
        Menu::truncate();

        $menus = [
            ['id' => 1, 'parent_id' => 0, 'title' => '系统管理', 'icon' => 'fa-cogs', 'sort' => 99, 'uri' => null],
            ['id' => 10, 'parent_id' => 1, 'title' => '用户管理', 'icon' => 'fa-user', 'sort' => 1, 'uri' => 'admins'],
            ['id' => 20, 'parent_id' => 1, 'title' => '角色管理', 'icon' => 'fa-group', 'sort' => 2, 'uri' => 'roles'],
            ['id' => 30, 'parent_id' => 1, 'title' => '权限管理', 'icon' => 'fa-object-group', 'sort' => 3, 'uri' => 'permissions'],
            ['id' => 40, 'parent_id' => 1, 'title' => '菜单管理', 'icon' => 'fa-bars', 'sort' => 4, 'uri' => 'menus'],
            ['id' => 50, 'parent_id' => 1, 'title' => '系统日志', 'icon' => 'fa-list', 'sort' => 5, 'uri' => 'logs'],
        ];
        foreach ($menus as $menu) {
            Menu::create($menu);
        }

        Db::statement('alter table `admin_menus` auto_increment = 100');
    }
}
