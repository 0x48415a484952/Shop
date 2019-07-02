<?php

namespace App\Http\Controllers\Products;

use App\Models\Comment;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ProductImages;
use App\Http\Controllers\Controller;
use App\Scoping\Scopes\CategoryScope;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ProductIndexResource;
use App\Http\Requests\Products\ProductStoreRequest;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware(['jwt.verify', 'role.authorization'], ['only' => ['create', 'store', 'edit', 'destroy']]);
        // Alternativly
        // $this->middleware(['jwt.verify', 'role.authorization'], ['except' => ['index', 'show']]);
    }
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
        // dd(Storage::url('iphone.jpg'));
        // dd(factory(ProductImages::class)->create());
        // $products = Storage::url();
        $products = Product::with(['variations.stock',])->withScopes($this->scopes())->paginate(12);
        return ProductIndexResource::collection(
            $products
        );
    }

    public function store(ProductStoreRequest $request)
    {
        $product = new Product;
        $product->title = $request->title;
        $product->slug = $request->slug;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->save();
        $url = time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('images'), $url);
        $product->images()->associate($url);
        $product->categories()->attach($request->category_id);
        return new ProductIndexResource($product);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
    }

    public function getRandomProducts()
    {
        $products = Product::inRandomOrder()->get();
        return $products;
        return ProductIndexResource::collection(
            $products
        );

        // dd('ok');
    }


    // public function getRandom()
    // {
    //     // dd(Storage::url('iphone.jpg'));
    //     // dd(factory(ProductImages::class)->create());
    //     // $products = Storage::url();
    //     $products = Product::with(['variations.stock',])->withScopes($this->scopes())->paginate(12);
    //     return ProductIndexResource::collection(
    //         $products
    //     );
    // }

    public function show(Product $product)
    {
        $product->load(['variations.type', 'variations.product', 'comments.product']);
        return new ProductResource(
                $product
            );
        // return $product;
    }




    // public function show(Product $product)
    // {
    //     $product =  Product::with('comments')->findOrFail($product->id)->load(['variations.type', 'variations.product']);
    //     return (new ProductResource($product));
    //     // return $product;
    // }

    public function scopes() 
    {
        return [
            'category' => new CategoryScope()
        ];
    }
}
