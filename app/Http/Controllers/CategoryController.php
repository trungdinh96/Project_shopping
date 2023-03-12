<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function list(){
        return view('Admin.Categories.list');
        
     }
    public function create(){
        

        
       return view('Admin.Categories.create');
    }
}
