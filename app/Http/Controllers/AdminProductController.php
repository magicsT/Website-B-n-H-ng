<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Components\Recusive;
use App\Http\Requests\ProductAddRequest;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductTag;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Traits\StorageImageTrait;
use App\Models\Tag;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\DB;
use App\Traits\DeleteModelTrait;

class AdminProductController extends Controller
{
    use DeleteModelTrait;
    use StorageImageTrait;

    private $category;
    private $product;
    private $productImage;
    private $tag;
    private $productTag;
    public function  __construct(Category $category, Product $product, ProductImage $productImage, Tag $tag, ProductTag $productTag)
    {
        $this->category = $category;
        $this->product = $product;
        $this->productImage = $productImage;
        $this->tag = $tag;
        $this->productTag = $productTag;
    }
    public function index()
    {
        $products = $this->product->latest()->paginate();
        return view('admin.product.index')->with(compact('products'));
    }

    public function create()
    {
        $htmlOption = $this->getCategory($parentId = '');
        return View::make('admin.product.add')->with(compact('htmlOption'));
    }

    public function getCategory($parentId)
    {
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->categoryRecusive($parentId);
        return $htmlOption;
    }
    public function store(ProductAddRequest $request)
    {
        try {
            DB::beginTransaction();
            $dataProductCreate = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->contents,
                'user_id' => auth()->id(),
                'category_id' => $request->category_id
            ];
            $dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_image_path', 'product');
            if (!empty($dataUploadFeatureImage)) {
                $dataProductCreate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
                $dataProductCreate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
            }
            $product = $this->product->create($dataProductCreate);
            //Thêm data vào product_image

            if ($request->hasFile('image_path')) {
                foreach ($request->image_path as $fileItem) {
                    $dataProductImageDetail = $this->storageTraitUploadMutiple($fileItem, 'product');
                    $product->images()->create([
                        'image_path' => $dataProductImageDetail['file_path'],
                        'image_name' => $dataProductImageDetail['file_name']
                    ]);
                }
            }

            $tagIds = [];
            //Thêm tags cho product
            if(!empty($request->tags)){
                foreach ($request->tags as $tagItem) {
                    $tagInstance = $this->tag->firstOrCreate(['name' => $tagItem]);
                    $tagIds[] = $tagInstance->id;
                }
            }
            $product->tags()->attach($tagIds); 
            DB::commit();
            return redirect()->route('product.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message:' . $exception->getMessage() . 'Line :' . $exception->getLine());
        }
    }

    public function edit($id){
        $product = $this->product->find($id);
        $htmlOption = $this->getCategory($product->category_id); 
        return view('admin.product.edit')->with(compact('htmlOption','product'));
    }

    public function update($id, Request $request){
        try {
            DB::beginTransaction();
            $dataProductUpdate = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->contents,
                'user_id' => auth()->id(),
                'category_id' => $request->category_id
            ];
            $dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_image_path', 'product');
            if (!empty($dataUploadFeatureImage)) {
                $dataProductUpdate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
                $dataProductUpdate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
            }
            $this->product->find($id)->update($dataProductUpdate);
            $product = $this->product->find($id);

            //Thêm data vào product_image

            if ($request->hasFile('image_path')) {
                $this->productImage->where('product_id',$id)->delete();
                foreach ($request->image_path as $fileItem) {
                    $dataProductImageDetail = $this->storageTraitUploadMutiple($fileItem, 'product');
                    $product->images()->create([
                        'image_path' => $dataProductImageDetail['file_path'],
                        'image_name' => $dataProductImageDetail['file_name']
                    ]);
                }
            }

            //Thêm tags cho product
            if(!empty($request->tags)){
                foreach ($request->tags as $tagItem) {
                    $tagInstance = $this->tag->firstOrCreate(['name' => $tagItem]);
                    $tagIds[] = $tagInstance->id;
                }
            }
           
            $product->tags()->sync($tagIds);
            DB::commit();
            return redirect()->route('product.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message:' . $exception->getMessage() . 'Line :' . $exception->getLine());
        } 
    }

    public function delete($id){
        return $this->deleteModelTrait($id, $this->product);
    }
}
