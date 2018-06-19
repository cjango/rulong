<?php

namespace RuLong\Panel\Controllers;

use Illuminate\Http\Request;
use RuLong\Panel\Models\Menu;
use RuLong\Panel\Requests\MenuRequest;

class MenuController extends Controller
{

    public function index(Request $request)
    {
        $keyword   = $request->keyword;
        $parent_id = $request->get('parent_id', 0);
        $menuTree  = Menu::treeJson();
        $menus     = Menu::when($keyword, function ($query) use ($keyword) {
            return $query->where('title', 'like', "%{$keyword}%");
        })->where('parent_id', $parent_id)->orderBy('sort', 'asc')->paginate();
        return view('RuLong::menus.index', compact('menus', 'menuTree'));
    }

    public function create()
    {
        $topMenus = Menu::treeShow();
        return view('RuLong::menus.create', compact('topMenus'));
    }

    public function store(MenuRequest $request)
    {
        if (Menu::create($request->all())) {
            return $this->success();
        } else {
            return $this->error();
        }
    }

    public function sort(Request $request, $parent_id = 0)
    {
        if ($request->isMethod('post')) {
            $sort = $request->post('sort');
            $sort = json_decode($sort, true);

            foreach ($sort as $key => $value) {
                Menu::where('id', $value['id'])->update(['sort' => $key + 1]);
            }
            return $this->success();

        } else {
            $list = Menu::where('parent_id', $parent_id)->orderBy('sort', 'asc')->get();
            return view('RuLong::menus.sort', compact('list'));
        }
    }

    public function edit(Menu $menu)
    {
        $topMenus = Menu::treeShow($menu->id);
        return view('RuLong::menus.edit', compact('topMenus', 'menu'));
    }

    public function update(MenuRequest $request, Menu $menu)
    {
        if ($menu->update($request->all())) {
            return $this->success();
        } else {
            return $this->error();
        }
    }

    public function destroy(Menu $menu)
    {
        if ($menu->children()->count()) {
            return $this->error('菜单下有子菜单，不允许直接删除');
        } elseif ($menu->delete()) {
            return $this->success();
        } else {
            return $this->error();
        }
    }
}
