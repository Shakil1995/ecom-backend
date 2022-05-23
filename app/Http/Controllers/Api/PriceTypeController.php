<?php

namespace App\Http\Controllers\Api;

use App\Models\PriceType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PriceType\StorePriceTypeRequest;
use App\Http\Requests\PriceType\UpdatePriceTypeRequest;

class PriceTypeController extends Controller
{
    public function index()
    {
        $priceTypes = PriceType::all();

        return response()->json([
            'priceTypes' => $priceTypes
        ], 200);
    }

    public function create()
    {
        
    }

    public function store(StorePriceTypeRequest $request)
    {
        $priceType = new PriceType; 

        //insert data
        $priceType->name = $request->name;

        //save to database
        $priceType->save();

        return redirect(config('app.frontend_url').'/price-types/index')->with('status','Price Type has been Created Successfully !');
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

        return redirect(config('app.frontend_url').'/price-types/index')->with('status','Price Type has been Updated Successfully !');
    }

    public function destroy(PriceType $priceType)
    {
        $priceType->delete();

        return redirect(config('app.frontend_url').'/price-types/index')->with('status','Price Type has been Deleted Successfully !');
    }

    public function toggleStatus(PriceType $priceType)
    {
        $priceType->is_active = !$priceType->is_active;

        $priceType->update();

        return redirect(config('app.frontend_url').'/price-types/index')->with('status','PriceType Status has been Toggled Successfully !');
    }
}