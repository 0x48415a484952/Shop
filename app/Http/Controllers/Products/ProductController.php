<?php

namespace App\Http\Controllers\Products;

use App\Models\Comment;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Scoping\Scopes\CategoryScope;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductIndexResource;

class ProductController extends Controller
{
    // public function create(Request $request)
    // {
    //     $product = new Product;
    //     $product->title = 'God of War 2';
    //     $product->price = 40;
    //     $product->description = 'this is a new description and no one cares really 2';
    //     //dd($product);
    //     $product->save();

    //     $category = Category::find([5, 6]);
    //     //dd($category);
    //     $product->categories()->attach($category);

    //     return 'Success';
    // }

    // public function show(Product $product)
    // {
    //     return compact('product');
    // }

    // public function removeCategory(Product $product)
    // {
    //     $category = Category::find(3);
        
    //     $product->categories()->detach($category);
    //     //dd($product->categories());
    //     return 'Success';
    // }
    public function index()
    {
        $products = Product::with(['variations.stock'])->withScopes($this->scopes())->paginate(12);
        return ProductIndexResource::collection(
            $products
        );
    }

    public function show(Product $product)
    {
        $product->load(['variations.type', 'variations.product']);
        return new ProductResource(
            $product
        );
    }

    public function scopes() 
    {
        return [
            'category' => new CategoryScope()
        ];
    }
}
