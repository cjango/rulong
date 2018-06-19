<?php

namespace RuLong\Panel\Controllers;

use Illuminate\Http\Request;
use RuLong\Panel\Models\Permission;
use RuLong\Panel\Requests\PermissionRequest;

class PermissionController extends Controller
{

    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $permissions = Permission::when($keyword, function ($query) use ($keyword) {
            return $query->where('name', 'like', "%{$keyword}%");
        })->paginate();
        return view('RuLong::permissions.index', compact('permissions'));
    }

    public function create()
    {
        $guards = array_keys(config('auth.guards'));
        return view('RuLong::permissions.create', compact('guards'));
    }

    public function store(PermissionRequest $request)
    {
        if (Permission::create($request->all())) {
            return $this->success();
        } else {
            return $this->error();
        }
    }

    public function edit(Permission $permission)
    {
        $guards = array_keys(config('auth.guards'));
        return view('RuLong::permissions.edit', compact('guards', 'permission'));
    }

    public function update(PermissionRequest $request, role $permission)
    {
        if ($permissions->update($request->all())) {
            return $this->success();
        } else {
            return $this->error();
        }
    }

    public function destroy(Permission $permissions)
    {
        if ($permissions->delete()) {
            return $this->success();
        } else {
            return $this->error();
        }
    }
}
