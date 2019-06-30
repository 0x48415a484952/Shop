<?php

namespace App\Http\Controllers\ProductVariationType;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductVariationType;
use App\Http\Resources\ProductVariationTypeIndexResource;
use App\Http\Requests\ProductVariationType\ProductVariationTypeStoreRequest;

class ProductVariationTypeController extends Controller
{
    public function index()
    {
        $productVariationsTypes = ProductVariationType::all();
        // return ProductVariationType::all();
        return ProductVariationTypeIndexResource::collection(
            $productVariationsTypes
        );
    }

    public function store(ProductVariationTypeStoreRequest $request)
    {
        $productVariationType = new ProductVariationType;
        $productVariationType->title = $request->title;
        $productVariationType->save();
        return new ProductVariationTypeIndexResource($productVariationType);
    }
}
