<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use App\Components\Recusive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    // private $htmlSelect;
    // public function __construct()
    // {
    //     $this->htmlSelect='';  
    //   }
    private $category;
    function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function list()
    {
        $categories = $this->category->latest()->paginate(5);
        return view('Admin.Categories.list', compact('categories'));
    }
    public function create()
    {
        $htmlOption = $this->getCategory($parentId = '');

        return view('Admin.Categories.create', compact('htmlOption'));
    }


    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|unique:categories,name'
            ],
            [
                'name.required' => 'Bạn chưa nhập tên danh mục',
                'name.unique' => 'Tên danh mục đã tồn tại'
            ]
        );
        $this->category->create(
            [
                'name' => $request->name,
                'parent_id' => $request->parent_id,
                'slug' => Str::slug($request->name)
            ]
        );
        
        return redirect()->route('admin.category.list')->with('success', 'Add category successfully');
    }
    public function getCategory($parentId)
    {
        $data = $this->category->all();

        $recusive = new Recusive($data);
        $htmlOption = $recusive->categoryRecusive($parentId);
        return $htmlOption;
    }
    public function edit($id, Request $request)
    {
        $category = $this->category->find($id);
        $htmlOption = $this->getCategory($category->parent_id);
        return view('Admin.Categories.edit', compact('category', 'htmlOption'));
    }
    public function update($id, Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'unique:categories,name'
            ],
            [
               
                'name.unique' => 'Tên danh mục đã tồn tại'
            ]
        );
        $this->category->find($id)->update(
            [
                'name' => $request->name,
                'parent_id' => $request->parent_id,
                'slug' => Str::slug($request->name)
            ]
        );

        return redirect()->route('admin.category.list')->with('success', 'Update category successfully');
    }
    public function delete($id)
    {
        $this->category->find($id)->delete();
        return redirect()->route('admin.category.list');
    }
    public function showSoftDelete()
    {
        $categorySoftDelete = $this->category->onlyTrashed()->get();

        return view('Admin.Categories.listSoftDelete', compact('categorySoftDelete'));
    }

    public function restoreCategory($id)
    {
        $this->category->withTrashed()->find($id)->restore();
        return redirect()->route('admin.category.list')->with('success', 'Restore successfully');
    }

    public function deleteTrash($id)
    {
        $deleteTrash = $this->category->withTrashed()->find($id);
      
        
        $deleteTrash->forceDelete();

        return redirect()->route('admin.category.deletesoft')->with('success', 'Delete category successfully');
    }
}
