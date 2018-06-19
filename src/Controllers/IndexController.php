<?php

namespace RuLong\Panel\Controllers;

use Admin;
use RuLong\Panel\Models\Menu;
use RuLong\Panel\Requests\PasswordRequest;

class IndexController extends Controller
{

    public function index()
    {
        $adminMenus = Menu::adminShow();
        return view('RuLong::public.index', compact('adminMenus'));
    }

    public function dashboard()
    {
        return view('RuLong::public.dashboard');
    }

    public function password(PasswordRequest $request)
    {
        if ($request->isMethod('put')) {
            $user = Admin::user();

            $user->password = $request->repass;
            if ($user->save()) {
                return $this->success();
            } else {
                return $this->error();
            }
        } else {
            return view('RuLong::public.password');
        }
    }
}
