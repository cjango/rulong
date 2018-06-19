<?php

namespace RuLong\Panel\Controllers;

use Illuminate\Http\Request;
use RuLong\Panel\Models\Admin;
use RuLong\Panel\Requests\AdminRequest;

class AdminController extends Controller
{

    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $admins  = Admin::when($keyword, function ($query) use ($keyword) {
            return $query->where('username', 'like', "%{$keyword}%");
        })->with('lastLogin')->withCount('logins')->paginate();
        return view('RuLong::admins.index', compact('admins'));
    }

    public function create()
    {
        return view('RuLong::admins.create');
    }

    public function store(AdminRequest $request)
    {
        if (Admin::create($request->all())) {
            return $this->success();
        } else {
            return $this->error();
        }
    }

    public function edit(Admin $admin)
    {
        return view('RuLong::admins.edit', compact('admin'));
    }

    public function update(AdminRequest $request, Admin $admin)
    {
        if ($admin->update($request->all())) {
            return $this->success();
        } else {
            return $this->error();
        }
    }

    public function destroy(Admin $admin)
    {
        if ($admin->delete()) {
            return $this->success();
        } else {
            return $this->error();
        }
    }
}
