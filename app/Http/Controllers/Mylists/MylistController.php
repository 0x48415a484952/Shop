<?php

namespace App\Http\Controllers\Mylists;

use App\Models\Mylist;
use App\Models\ProductVariation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MylistResource;
use App\Http\Resources\MylistItemsResource;
use App\Http\Requests\StoreListRequest;

class MylistController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth:api', 'role.authorization'], ['only' => ['create', 'store', 'edit', 'destroy']]);
    }

    public function index()
    {
        return MylistResource::collection(Mylist::get());
    }

    public function store(StoreListRequest $request)
    {
        $list = new Mylist();
        $list->title = $request->title;
        $list->slug = $request->slug;
        $list->save();
        return new MylistResource($list);
    }

    public function destroy($id)
    {
        $list = Mylist::where('id', $id)->first();
        $list->delete();
        return response()->json(['status' => 'success', 'message' => 'list has been deleted'], 200);
    }

    public function show($listId)
    {
        return MylistItemsResource::collection(Mylist::with('items')->findOrFail($listId)->items);
    }

    // public function addItemTolist(Mylist $list, ProductVariation $productVariaton)
    public function addItemTolist(Request $request)
    {
        $list = Mylist::findOrFail($request->list);
        $list->load([
            'items'
        ]);
        $productVariation = ProductVariation::findOrFail($request->productVariation);
        $list->items()->save($productVariation);
        return MylistItemsResource::collection(Mylist::with('items')->findOrFail($request->list)->items);
    }
}
