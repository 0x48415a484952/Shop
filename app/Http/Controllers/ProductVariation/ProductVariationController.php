<?php

namespace App\Http\Controllers\ProductVariation;

use App\Models\Stock;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductVariation;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductVariationIndexResource;
use App\Http\Requests\ProductVariation\ProductVariationStoreRequest;
use App\Models\ProductVariationType;

class ProductVariationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['jwt.verify', 'role.authorization'], ['only' => ['create', 'store', 'edit', 'destroy']]);
    }
    
    public function index()
    {
        $productVariations =  ProductVariation::all();
        return ProductVariationIndexResource::collection(
            $productVariations
        );
    }


    public function store(ProductVariationStoreRequest $request)
    {
        //works
        $productVariation = new ProductVariation();
        $productVariation->title = $request->title;
        $productVariation->price = $request->price;
        $productVariation->product_id = $request->product_id;
        $productVariation->product_variation_type_id = $request->product_variation_type_id;
        $stock = new Stock();
        $stock->quantity = $request->quantity;
        $productVariation->save();
        $productVariation->stocks()->save($stock);
        return new ProductVariationIndexResource($productVariation);
        //works


        //experiment
        // $variation = new ProductVariation();
        // $variation->title = $request->title;
        // $variation->price = $request->price;
        // $product = Product::findOrFail($request->id);
        // $variation->product()->save($product);
        // $type = ProductVariationType::findOrFail($request->product_variation_type_id);
        // $variation->type()->save($type);
        // $stock = new Stock();
        // $stock->quantity = $request->quantity;
        // $variation->stocks()->save($stock);
        // return new ProductVariationIndexResource($variation);
    }
}
