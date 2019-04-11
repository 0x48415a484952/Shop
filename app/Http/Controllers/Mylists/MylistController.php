<?php

namespace App\Http\Controllers\Mylists;

use App\Models\Mylist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MylistResource;
use App\Http\Resources\MylistItemsResource;

class MylistController extends Controller
{

    public function index()
    {
        return MylistResource::collection(Mylist::get());
    }

    public function show($listId)
    {
        return MylistItemsResource::collection(Mylist::with('items')->findOrFail($listId)->items);
    }
}
