<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $category;
    private $product;
    public function __construct(Category $category, Product $product)
    {
        $this->category = $category;
        $this->product = $product;
    }
    public function index()
    {
        $productsRecommend = $this->product->latest('views','desc')->take(6)->get();
        $products = $this->product->latest()->take(6)->get();
        $categories = $this->category->where('parent_id', 0)->get();
        return view('Client.Home.home',compact('categories','products','productsRecommend'));
    }

   
   
    
}
