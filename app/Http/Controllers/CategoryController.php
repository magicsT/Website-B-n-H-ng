<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Components\Recusive;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;
use app\Traits\StorageImageTrait;

class CategoryController extends Controller
{
    private $category;
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        $categories = $this->category->latest()->paginate(5);
        return View::make('admin.category.index')->with(compact('categories'));
    }

    public function create()
    {
        $htmlOption = $this->getCategory($parentId ='');
        return View::make('admin.category.add')->with(compact('htmlOption'));
    }

    public function store(Request $request)
    {
        $this->category->create([
            'name' => $request->name,
            'parent_id'=> $request->parent_id,
            'slug' => Str::slug($request->name)
        ]);
        return redirect()->route("categories.index");
    }

    public function edit($id){
        $category = $this->category->find($id);
        $htmlOption = $this->getCategory($category->parent_id);
        return View::make('admin.category.edit')->with(compact('category','htmlOption'));
    }

    public function delete($id){
        $this->category->find($id)->delete();
        return redirect()->route("categories.index");
    }

    public function update($id, Request $request){
        $this -> category ->find($id)->update([
            'name' => $request->name,
            'parent_id'=> $request->parent_id,
            'slug' => Str::slug($request->name)
        ]);
        return redirect()->route("categories.index");
    }

    public function getCategory($parentId){
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->categoryRecusive($parentId);
        return $htmlOption;
    }
}

