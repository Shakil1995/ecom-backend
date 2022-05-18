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
            'category' => $categories
        ], 200);
    }

   
    public function create()
    {
        //
    }

    public function store(StoreCategoryRequest $request)
    {
   
        $category = new Category; 

 
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);

        $category->save();

        return response()->json([
            'message' => "Category Created Successfully!!",
            'category' => $category
        ], 200);
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

        return response()->json([
            'message' => "Category updated Successfully!!",
            'category' => $category
        ], 200);
    }

    
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json([
            'message' => "Category Deleted Successfully!!",
        ], 200);
    
    }
}
