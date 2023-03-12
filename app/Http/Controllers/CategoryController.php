<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use App\Components\Recusive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    // private $htmlSelect;
    // public function __construct()
    // {
    //     $this->htmlSelect='';  
    //   }
    private $category;
    function __construct(Category $category){
            $this->category = $category;
    }

    public function list(){
        $categories = $this->category->latest()->paginate(5);
        return view('Admin.Categories.list', compact('categories'));
        
     }
    public function create(){
        // $data = DB::table('categories')->get();
        $data= $this->category->all();
        // dd($data);
        $recusive = new Recusive($data);
       $htmlOption = $recusive->categoryRecusive();
    //    dd($recusive);
       return view('Admin.Categories.create', compact('htmlOption'));
    }

    // function categoryRecusive($id, $text=''){
    //     $data = Category::all();
    //     foreach ($data as $value){
    //         if($value['parent_id']== $id){
    //             $this->htmlSelect.="<option>" . $text . $value['name'] . "</option>";
    //             $this->categoryRecusive($value['id'], $text . '-');
    //         }
    //     }

    //     return $this->htmlSelect;
        
    // }
    public function store(Request $request){
        $this->validate($request,
        [
            'name'=>'required|unique:categories,name'
        ],
        [
            'name.required'=>'Bạn chưa nhập tên danh mục',
            'name.unique'=>'Tên danh mục đã tồn tại'
        ]
    );
        $this->category->create([
            'name'=> $request->name,
            'parent_id'=> $request->parent_id,
            'slug'=>Str::slug($request->name)
        ]);

        return redirect()->route('admin.category.list');
    }
}