<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Product;

use App\Models\Category;
use App\Models\ProductTag;
use Illuminate\Support\Str;
use App\Components\Recusive;
use function Ramsey\Uuid\v1;
use Illuminate\Http\Request;
use App\Traits\StorageImageTrait;
use App\Traits\StorageImageTraits;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    use StorageImageTrait;
    private $category;
    private $product;
    private $tag;
    private $productTag;
    function __construct(Category $category, Product $product, Tag $tag, ProductTag $productTag)
    {
        $this->category = $category;
        $this->product = $product;
        $this->tag = $tag;
        $this->productTag = $productTag;
    }
    public function listProducts()
    {
        $products = $this->product->paginate(5);

        return view('Admin.Products.list', compact('products'));
    }

    public function createProduct()
    {
        $htmlOption = $this->getCategory($parentId = '');
        return view('Admin.Products.create', compact('htmlOption'));
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
        try {
            DB::beginTransaction();
            $dataProductCreate =
                [
                    'name' => $request->name,
                    'price' => $request->price,
                    'content' => $request->content,
                    'user_id' => auth()->id(),
                    'category_id' => $request->category_id,

                ];
            $dataUploadFeatureImage = $this->strageTraitUpload($request, 'feature_image_path', 'product');
            if (!empty($dataUploadFeatureImage)) {
                $dataProductCreate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
                $dataProductCreate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
            }
            $product = $this->product->create($dataProductCreate);

            //Insert data to product_image
            if ($request->hasFile('image_path')) {
                foreach ($request->image_path as $fileItem) {
                    $dataProductImageDetail = $this->strageTraitUploadMutiple($fileItem, 'product');
                    $product->images()->create([
                        'image_path' => $dataProductImageDetail['file_path'],
                        'image_name' => $dataProductImageDetail['file_name']
                    ]);
                }
            }

            //Insert tags to product
            foreach ($request->tags as $tagItem) {
                $tagInstance = $this->tag->firstOrCreate(['name' => $tagItem]);

                $tagId[] = $tagInstance->id;
            }
            $product->tags()->attach($tagId);
            DB::commit();
            return redirect()->route('admin.product.list');
        } catch (\Exception $exeption) {
            DB::rollBack();
            Log::error('Message' . $exeption->getMessage() . 'Line: ' . $exeption->getLine());
        }
    }
}
