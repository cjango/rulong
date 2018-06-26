<?php

namespace RuLong\Panel\Controllers;

use Illuminate\Http\Request;
use RuLong\Panel\Models\Admin;
use RuLong\Panel\Models\Menu;
use RuLong\Panel\Models\Role;
use RuLong\Panel\Requests\RoleRequest;

class RoleController extends Controller
{

    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $roles = Role::when($keyword, function ($query) use ($keyword) {
            return $query->where('name', 'like', "%{$keyword}%");
        })->paginate();
        return view('RuLong::roles.index', compact('roles'));
    }

    public function create()
    {
        return view('RuLong::roles.create');
    }

    public function store(RoleRequest $request)
    {
        if (Role::create($request->all())) {
            return $this->success();
        } else {
            return $this->error();
        }
    }

    public function edit(Role $role)
    {
        return view('RuLong::roles.edit', compact('role'));
    }

    public function update(RoleRequest $request, role $role)
    {
        if ($role->update($request->all())) {
            return $this->success();
        } else {
            return $this->error();
        }
    }

    public function destroy(Role $role)
    {
        if ($role->delete()) {
            return $this->success();
        } else {
            return $this->error();
        }
    }

    public function menus(Request $request, Role $role)
    {
        if ($request->isMethod('post')) {
            $result = $role->update([
                'rules' => $request->rules,
            ]);
            if ($result) {
                return $this->success('菜单授权成功', admin_url('roles'));
            } else {
                return $this->error();
            }
        } else {
            $menus = Menu::with(['children'])->where('parent_id', 0)->orderBy('sort', 'asc')->get();
            return view('RuLong::roles.menus', compact('menus', 'role'));
        }
    }

    public function users(Request $request, Role $role)
    {
        if ($request->isMethod('post')) {
            $username = $request->username;
            if (empty($username)) {
                return [];
            }
            return Admin::select(['id', 'username', 'nickname'])
                ->whereDoesntHave('roles', function ($query) use ($role) {
                    return $query->where('role_id', $role->id);
                })
                ->where('username', 'like', "%{$username}%")
                ->get();
        } else {
            $admins = $role->users()->paginate();
            return view('RuLong::roles.users', compact('admins', 'role'));
        }
    }

    public function auth(Role $role, Admin $admin)
    {
        try {
            $admin->roles()->attach($role);
            return $this->success();
        } catch (\Exception $e) {
            return $this->error();
        }
    }

    public function remove(Role $role, Admin $admin)
    {
        try {
            $role->users()->detach($admin);
            return $this->success();
        } catch (\Exception $e) {
            return $this->error();
        }
    }

}
