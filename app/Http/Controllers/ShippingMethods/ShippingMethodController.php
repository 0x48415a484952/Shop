<?php

namespace App\Http\Controllers\ShippingMethods;

use Illuminate\Http\Request;
use App\Models\ShippingMethod;
use App\Http\Controllers\Controller;
use App\Http\Resources\ShippingMethodIndexResource;
use App\Http\Requests\ShippingMethods\ShippingMethodStoreRequest;

class ShippingMethodController extends Controller
{

    public function __construct()
    {
        $this->middleware(['jwt.verify', 'role.authorization'], ['only' => ['create', 'store', 'edit', 'destroy']]);
    }
    public function index()
    {
        $shippingMethods = ShippingMethod::all();
        return ShippingMethodIndexResource::collection($shippingMethods);
    }

    public function store(ShippingMethodStoreRequest $request)
    {
        $shippingMethod = new ShippingMethod();
        $shippingMethod->name = $request->name;
        $shippingMethod->price = $request->price;
        $shippingMethod->save();
        return new ShippingMethodIndexResource($shippingMethod);
    }

    public function destroy($id)
    {
        $shippingMethod = ShippingMethod::findOrFail($id);
        $shippingMethod->delete();
        return response()->json(['status' => 'success', 'message' => 'shipping method has been deleted'], 200);
    }
}
