<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Product;

use App\Models\Category;
use App\Models\ProductTag;
use Illuminate\Support\Str;
use App\Components\Recusive;
use App\Models\ProductImage;
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
    private $productImage;
    function __construct(Category $category, Product $product, Tag $tag, ProductTag $productTag, ProductImage $productImage)
    {
        $this->category = $category;
        $this->product = $product;
        $this->tag = $tag;
        $this->productTag = $productTag;
        $this->productImage = $productImage;
    }
    public function listProducts()
    {
        $products = $this->product->latest()->paginate(5);

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
        $this->validate(
            $request,
            [
                'name' => 'required|unique:products,name',
                'price' => 'required',
                'feature_image_path' => 'required',
                'image_path' => 'required',
                'category_id' => 'required'
            ]
        );
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
            if (!empty($request->tags)) {
                foreach ($request->tags as $tagItem) {
                    $tagInstance = $this->tag->firstOrCreate(['name' => $tagItem]);

                    $tagId[] = $tagInstance->id;
                }
                $product->tags()->attach($tagId);
            }


            DB::commit();
            return redirect()->route('admin.product.list')->with('success', 'Add product successfully');
        } catch (\Exception $exeption) {
            DB::rollBack();
            Log::error('Message' . $exeption->getMessage() . 'Line: ' . $exeption->getLine());
        }
    }

    public function edit($id)
    {
        $product = $this->product->find($id);
        $htmlOption = $this->getCategory($product->category_id);
        return view('Admin.Products.edit', compact('htmlOption', 'product'));
    }

    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'name' => 'unique:products,name',
                'price' => 'required',
            ]
        );
        try {
            DB::beginTransaction();
            $dataProductUpdate =
                [
                    'name' => $request->name,
                    'price' => $request->price,
                    'content' => $request->content,
                    'user_id' => auth()->id(),
                    'category_id' => $request->category_id,

                ];
            $dataUploadFeatureImage = $this->strageTraitUpload($request, 'feature_image_path', 'product');
            if (!empty($dataUploadFeatureImage)) {
                $dataProductUpdate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
                $dataProductUpdate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
            }
            $this->product->find($id)->update($dataProductUpdate);
            $product = $this->product->find($id);


            //Insert data to product_image
            if ($request->hasFile('image_path')) {
                $this->productImage->where('product_id', $id)->delete();
                foreach ($request->image_path as $fileItem) {
                    $dataProductImageDetail = $this->strageTraitUploadMutiple($fileItem, 'product');
                    $product->images()->create([
                        'image_path' => $dataProductImageDetail['file_path'],
                        'image_name' => $dataProductImageDetail['file_name']
                    ]);
                }
            }

            //Insert tags to product
            if (!empty($request->tags)) {
                foreach ($request->tags as $tagItem) {
                    $tagInstance = $this->tag->firstOrCreate(['name' => $tagItem]);

                    $tagId[] = $tagInstance->id;
                }
                $product->tags()->sync($tagId);
            }


            DB::commit();
            return redirect()->route('admin.product.list')->with('success', 'update product successfully');
        } catch (\Exception $exeption) {
            DB::rollBack();
            Log::error('Message' . $exeption->getMessage() . 'Line: ' . $exeption->getLine());
        }
    }
    public function delete($id)
    {
        $this->product->find($id)->delete();
        return redirect()->route('admin.product.list');
    }

    public function showSoftDelete()
    {
        $productSoftDelete = $this->product->onlyTrashed()->get();

        return view('Admin.Products.listSoftDelete', compact('productSoftDelete'));
    }

    public function restoreProduct($id)
    {
        $this->product->withTrashed()->find($id)->restore();
        return redirect()->route('admin.product.list')->with('success', 'Restore successfully');
    }

    public function deleteTrash($id)
    {
        $deleteTrash = $this->product->withTrashed()->find($id);
        $deleteTrash->tags()->detach();
        $deleteTrash->images()->delete();
        $deleteTrash->forceDelete();

        return redirect()->route('admin.product.deletesoft')->with('success', 'Delete product successfully');
    }
}
