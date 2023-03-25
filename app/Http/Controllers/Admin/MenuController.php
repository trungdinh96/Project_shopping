<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Components\MenuRecusive;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    private $menuRecusive;
    private $menu;
    public function __construct(MenuRecusive $menuRecusive, Menu $menu)
    {

        $this->menuRecusive = $menuRecusive;
        $this->menu = $menu;
    }
    public function list()
    {
        $menus = $this->menu->paginate(6);
        return view('Admin.Menus.list', compact('menus'));
    }
    public function create()
    {
        $optionSelect =  $this->menuRecusive->menuRecusive();

        return view('Admin.Menus.create', compact('optionSelect'));
    }
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|unique:menus,name'
            ],
            [
                'name.required' => 'Bạn chưa nhập tên menu',
                'name.unique' => 'Tên menu đã tồn tại'
            ]
        );
        $this->menu->create(
            [
                'name' => $request->name,
                'parent_id' => $request->parent_id,
                'slug' => Str::slug($request->name)
            ]
        );

        return redirect()->route('admin.menu.list');
    }

    public function edit($id, Request $request)
    {
        $menu = $this->menu->find($id);
        $optionSelect = $this->menuRecusive->menuRecusiveEdit($menu->parent_id);
        return view('Admin.Menus.edit', compact('menu','optionSelect'));
       
    }
    public function update($id, Request $request)
    {
        $this->menu->find($id)->update(
            [
                'name' => $request->name,
                'parent_id' => $request->parent_id,
                'slug' => Str::slug($request->name)
            ]
        );
        return redirect()->route('admin.menu.list');
    }
    public function delete($id)
    {
        $this->menu->find($id)->delete();
        return redirect()->route('admin.menu.list');
    }
}
