<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ProductIndexResource;
use App\Http\Requests\SearchRequest;

class SearchController extends Controller
{
    public function action(SearchRequest $request)
    {
        $query = $request->validated();
        $query = implode(" ",$query);
        // dd($query);
            $keys = explode(" ",$query);
            
            $count = 0;

            foreach($keys as $k) {
                if($k != '') {
                    $products[$count] = Product::distinct()->where(mb_strtolower('slug'), 'like', '%' . mb_strtolower($k) . '%')
                                            // ->orWhere('description', 'like', '%' . $k . '%')
                                            ->get();



                    // $products[$count] = Product::distinct()->where(mb_strtolower('slug'), 'like', '%' . mb_strtolower($k) . '%')
                    //                         // ->orWhere('description', 'like', '%' . $k . '%')
                    //                         ->with(['variations.stock',])->paginate(12);



                    $count++;

                    // $products = Product::where(mb_strtolower('slug'), 'like', '%' . mb_strtolower($k) . '%')
                    //                         ->orWhere('description', 'like', '%' . $k . '%')
                    //                         ->paginate(12);
                }
            }
            $products = array_unique($products);
            $products = array_flatten($products);
            $products = array_unique($products);
            $products = array_flatten($products);
            if($query != '') {
                if($products == null) return response()->json('no result', 422);
                // return response()->json(['data' => $products]);
                $products = collect($products);
                return ProductIndexResource::collection(
                    $products
                );
            }

            return response()->json(['query' => 'type something'], 422);

        return response()->json(['query' => 'type something'], 422);
        
    }
}
