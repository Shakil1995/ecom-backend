<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreUpdateRequest;
use App\Http\Requests\Product\StoreProductRequest;

class ProductController extends Controller
{
    private $_getColumns = (['id', 'name', 'category_id']);
    public function index()
    {
        $products = Product::with('category','prices')->get($this->_getColumns);

        return response()->json([
            'product' => $products
        ], 200);
    }

  
    public function create()
    {
        //
    }

   
    public function store(StoreProductRequest $request)
    {
        $product = new Product;

        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->category_id = $request->category_id;
        $product->image = $request->image;
        $product->description = $request->description;

        $product->save();

        return response()->json([
            'message' => "Category updated Successfully!!",
            'product' => $product
        ], 200);

    }

    private $_showColumns = (['id', 'name', 'category_id']);
    public function show(Product $product)
    {
        $product = Product::with('category','prices')->get('$this->_showColumns')->find($product->id);
        return response()->json([
            'message' => "Product Showed Successfully!!",
            'product' => $product
        ], 200);
    }

  
    public function edit(Product $product)
    {
        //
    }

    
    public function update(StoreUpdateRequest $request, Product $product)
    {
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->category_id = $request->category_id;
        $product->image = $request->image;
        $product->description = $request->description;


        $product->update();

        return response()->json([
            'message' => "product updated Successfully!!",
            'product' => $product
        ], 200);
    }

   
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([
            'message' => "product Deleted Successfully!!",
        ], 200);
    }
}