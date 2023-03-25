<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;

use Illuminate\Support\Str;
use App\Components\Recusive;
use function Ramsey\Uuid\v1;
use Illuminate\Http\Request;
use App\Traits\StorageImageTrait;
use App\Traits\StorageImageTraits;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    use StorageImageTrait;
    private $category;
    private $product;
    function __construct(Category $category , Product $product)
    {
        $this->category = $category;
        $this->product = $product;
    }
    public function listProducts()
    {
        return view('Admin.Products.list');
    }

    public function createProduct()
    {
        $htmlOption = $this->getCategory($parentId = '');
        return view('Admin.Products.create' , compact( 'htmlOption'));
    }
    
    public function getCategory($parentId)
    {
        $data = $this->category->all();

        $recusive = new Recusive($data);
        $htmlOption = $recusive->categoryRecusive($parentId);
        return $htmlOption;
    }

    public function store(Request $request) 
    {
        $dataProductCreate = 
        [
            'name' => $request->name,
            'price' => $request->price,
            'content' => $request->content,
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,

        ];
        $dataUploadFeatureImage = $this->strageTraitUpload($request, 'feature_image_path', 'product');
        if(!empty($dataUploadFeatureImage)){
            $dataProductCreate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
            $dataProductCreate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
        }
        $product =$this->product->create($dataProductCreate);
        
        dd($product);
    }
}
