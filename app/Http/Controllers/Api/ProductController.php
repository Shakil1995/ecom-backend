<?php

namespace App\Http\Controllers\Api;

use App\Models\Price;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category','prices')->get();

        return response()->json([
            'products' => $products
        ], 200);
    }

  
    public function create()
    {
        //
    }

   
    public function store(StoreProductRequest $request)
    {
        // dd($request->all());
        $imageName = NULL;

            if($request->hasFile('image')){
                $image = $request->file('image');
                $imageName = $this->_getFileName($image->getClientOriginalExtension());
                $image->move(public_path('product-images'), $imageName);
            }

    //  dd($imageName);
        $product = new Product;

        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->category_id = $request->category_id;
        $product->image = $imageName;
        $product->description = $request->description;

        $product->save();

       
        // Product Price Type Store
        $getAllPrices = $request->amount;
        $price_type_ids = $request->price_type_id;

        $values = [];

        if(($getAllPrices !== NULL) && ($price_type_ids !== NULL)){
            foreach ($getAllPrices as $index => $amount) {
                $values[] = [
                    'product_id' => $product->id,
                    'amount' => $amount,
                    'price_type_id' => $price_type_ids[$index],
                ];
            }
        }

        if ( ($amount !== NULL) && ($price_type_ids[$index] !== NULL) ){
            $product->prices()->insert($values);
        }

        return redirect('http://127.0.0.1:7000/products/index');

    }


    public function show(Product $product)
    {
        $product = Product::with('category','prices')->find($product->id);
        return response()->json([
            'message' => "Product Showed Successfully!!",
            'product' => $product
        ], 200);
    }

  
    public function edit(Product $product)
    {
        //
    }

    
    public function update(UpdateProductRequest $request, Product $product)
    {


        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $this->_getFileName($image->getClientOriginalExtension());
            $image->move(public_path('product-images'), $imageName);

            if ($product->image !== NULL) {
                if (file_exists(public_path('product-images/'. $product->image ))) {
                    unlink(public_path('product-images/'. $product->image ));
                }
            }

            $product->image = $imageName;
           }

        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->category_id = $request->category_id;
        $product->description = $request->description;
        $product->update();

        // Update Prices
        $product_price_ids = $request->product_price_id;

        if($product_price_ids){
            for ($i = 0; $i < count($product_price_ids); $i++) {

                $values = [
                    'product_id' => $product->id,
                    'amount' => $request->amount[$i],
                ];

                $check_id = Price::find($product_price_ids[$i]);

                if ($check_id) {
                    $product->prices()->where('id', $check_id->id)->update($values);
                }
            }
        }

        $price_type_new_ids = $request->price_type_new_id;

            if($price_type_new_ids){
                for ($i = 0; $i < count($price_type_new_ids); $i++) {
                    $values2 = [
                        'product_id' => $product->id,
                        'amount' => $request->new_amount[$i],
                        'price_type_id' => $request->price_type_new_id[$i],
                    ];

                    if ( ($request->new_amount[$i] !== NULL) && ($request->price_type_new_id[$i] !== NULL) ){
                      $product->prices()->insert($values2);
                    }
                }
            }
            return redirect(config('app.frontend_url').'/products/index')->with('status','Product has been Updated Successfully !');
    }

   
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect(config('app.frontend_url').'/products/index')->with('status','Product has been Deleted Successfully !');
    }

    public function toggleStatus(Product $product)
    {
        $product->is_active = !$product->is_active;

        $product->update();

        return redirect(config('app.frontend_url').'/products/index')->with('status','Product Status has been Toggled Successfully !');
    }

    public function priceListDestroy($price_id)
    {
        $price = Price::find($price_id);
        $price->forceDelete();

        return response()->json([
            'success' => 'Product Price Deleted Successfully !'
        ]);
    }

    private function _getFileName($fileExtension){

        // Image name format is - p-05042022121515.jpg
        return 'p-'. date("dmYhis") . '.' . $fileExtension;
    }
}
