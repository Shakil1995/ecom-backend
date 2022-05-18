<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PriceType;
use Illuminate\Http\Request;

class PriceTypeController extends Controller
{
   
    public function index()
    {
        $priceTypes = PriceType::all();

        return response()->json([
            'status' => true,
            'priceTypes' => $priceTypes
        ], 200); 
    }

   
    public function create()
    {
        //
    }

  
    public function store(StorePriceTypeRequest $request)
    {
        $priceType = new PriceType; 

        //insert data
        $priceType->name = $request->name;

        //save to database
        $priceType->save();

        return response()->json([
            'message' => "Price Created Successfully!!",
            'priceType' => $priceType
        ], 200);
    }

   
    public function show(PriceType $priceType)
    {
      
        return response()->json([
            'message' => "Price Showed Successfully!!",
            'priceType' => $priceType
        ], 200);
       
    }

    
    public function edit(PriceType $priceType)
    {
        //
    }

    
    public function update(UpdatePriceTypeRequest $request, PriceType $priceType)
    {
        //insert data
        $priceType->name = $request->name;

        //save to database
        $priceType->update();

        return response()->json([
            'message' => "Price updated Successfully!!",
            'price' => $priceType
        ], 200);
    }

   
    public function destroy(PriceType $priceType)
    {
        $priceType->delete();

        return response()->json([
            'message' => "Price Deleted Successfully!!",
        ], 200);
    }
}
