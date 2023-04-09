<?php

namespace App\Http\Controllers\Client;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ClientProductController extends Controller
{
    private $category;
    private $product;
    public function __construct(Category $category, Product $product)
    {
        $this->category = $category;
        $this->product = $product;
    }
    public function listProducts()
    {
        $products = $this->product->all();
        $categories = $this->category->where('parent_id', 0)->get();
        return view('Client.Products.list',compact('categories','products'));
    }

    public function productCategory($slug,$categoryId)
    {
        // dd('Product');
        $categories = $this->category->where('parent_id', 0)->get();
        $products = $this->product->where('category_id',$categoryId)->paginate(10);
        return view('Client.Products.list',compact('products','categories'));
    }

    public function productDetail($id)
    {
        $products = $this->product->find($id);
        $productImage = $products->images();
        $productCategorys = $this->product->where('category_id',$products->category_id)->paginate(4);
        $productsRecommend = $this->product->latest('views','desc')->take(6)->get();
        $categories = $this->category->where('parent_id', 0)->get();
        return view('Client.Products.productDetails',compact('categories','products','productsRecommend','productCategorys','productImage'));
    }

    public function shoppingCart()
    {
        return view('Client.Products.cart');
    }

    public function addToCart($id)
    {
        
        $product = $this->product->find($id);
        $cart = session()->get('cart', []);
        if(isset($cart[$id])){
            $cart[$id]['quantity'] ++;
        }else{
            $cart[$id] =[
                'name'=>$product->name,
                'image'=>$product->feature_image_path,
                'price'=>$product->price,
                'quantity'=>1,
                // 'auth'=> Auth::user()->id,
                
            ];
           

        }
        session()->put('cart', $cart);
        // dd(session()->get('cart'));

        return redirect()->back()->with('success', 'Product add to cart successfully!');
    }
    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart successfully updated!');
        }
    }
 
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product successfully removed!');
        }
    }

    public function checkOut()
    {
        return view('Client.Products.checkout');
    }
}