<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;

class CategoryController extends Controller
{
    private $_getColumns = (['id', 'name', 'is_active']);

    public function index()
    {
        $categories = Category::get($this->_getColumns);

        return response()->json([
            'status' => true,
            'categories' => $categories
        ], 200);
    }

   
    public function create()
    {
        //
    }

    public function store(StoreCategoryRequest $request)
    {
   
        $category = new Category; 

//  dd($category);
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);

        $category->save();
        return response()->json([
            'message' => "Category add Successfully!!",
            'category' => $category
        ], 200);

    //  return redirect('http://127.0.0.1:7000/categories/index');
    }

    private $_showColumns = (['id', 'name', 'is_active']);
    public function show(Category $category)
    {
        return response()->json([
            'message' => "Category Showed Successfully!!",
            'category' => $category
        ], 200);
    }

  
    public function edit(Category $category)
    {
   
    }

    
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);

     
        $category->update();

        return redirect('http://127.0.0.1:7000/categories/index');
    }

    
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect('http://127.0.0.1:7000/categories/index');
    }
}
