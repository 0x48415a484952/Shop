<?php

namespace App\Http\Controllers\Orders;

use App\Cart\Cart;
use Illuminate\Http\Request;
use App\Events\Order\OrderCreated;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Requests\Orders\OrderStoreRequest;
use App\Models\Order;

class OrderController extends Controller
{
    protected $cart;
    public function __construct()
    {
        $this->middleware(['auth:api']);
        $this->middleware(['auth:api', 'role.authorization'])->only('update', 'edit', 'adminIndexOrders');
        $this->middleware(['cart.sync', 'cart.isnotempty'])->only('store');
    }

    public function index(Request $request)
    {
        $orders = $request->user()->orders()
            ->with([
                    'products',
                    'products.type',
                    'products.stock',
                    'products.product',
                    'products.product.images',
                    'products.product.variations',
                    'products.product.variations.stock',
                    'address',
                    'shippingMethod'
                ])
            ->latest()
            ->paginate(10);

        return OrderResource::collection($orders);
        // return $orders;
    }

    public function show(Order $order, Request $request)
    {
        $order->load([
            'products',
            'products.type',
            'products.stock',
            'products.product',
            'products.product.images',
            'products.product.variations',
            'products.product.variations.stock',
            'address',
            'shippingMethod'
        ]);

        if($order->user_id != $request->user()->id) return response()->json('not athorised');

        return new OrderResource(
            $order
        );
    }

    public function store(OrderStoreRequest $request, Cart $cart)
    {
        //used the middleware as $cart->sync() there is the same method implemented in the cart.sync middleware
        // $cart->sync();

        //used the middleware as the 3 lines below 
        // if ($cart->isEmpty()) {
        //     return response(null, 400);
        // }

        //this is new and needed
        $order = $this->createOrder($request, $cart);
    
        //this is new and needed
        $order->products()->sync($cart->products()->forSyncing());

        


        //this one not really needed it loads the product variations
        //we can get access to this information within here but not necessary really
        // $order->load(['products']);
        // $order->load(['shippingMethod']);
        // $order->load(['address']);

        //this is needed remember to uncomment it 
        //warning!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        event(new OrderCreated($order));

        return new OrderResource($order);

        //this one is old and universal
        // $products = $cart->products()->keyBy('id')->map(function($product) {
        //     return [
        //         'quantity' => $product->pivot->quantity
        //     ];
        // })->toArray();
        // $order->products()->sync($products);
        
    }

    public function update(Request $request)
    {
        $order = Order::findOrFail($request->order);
        //change order status to $request->status which should be the constants we have at Order Model
        $status = $request->status;
        switch ($status) {
            case 'processing':
                $order->update([
                    'status' => Order::PROCESSING
                ]);
                break;
            case 'payment_failed':
                $order->update([
                    'status' => Order::PAYMENT_FAILED
                ]);
            break;
            case 'completed':
                $order->update([
                    'status' => Order::COMPLETED
                ]);
            break;
            case 'pending':
                $order->update([
                    'status' => Order::PENDING
                ]);
            break;
            // default:
            //     //
            //     break;
            return response()->json(['errors' => ['status' => 'failed', 'message' => 'the status could not be changed']], 402);
        }
        return new OrderResource(
            $order
        );
    }

    public function orderIndexForAdmin()
    {
        // $orders = Order::get()->with([
        //     'products',
        //     'products.type',
        //     'products.stock',
        //     'products.product',
        //     'products.product.images',
        //     'products.product.variations',
        //     'products.product.variations.stock',
        //     'address',
        //     'shippingMethod'
        // ])
        $orders = Order::with(
            'products',
            'products.type',
            'products.stock',
            'products.product',
            'products.product.images',
            'products.product.variations',
            'products.product.variations.stock',
            'address',
            'shippingMethod'
        )->latest()->paginate(10);
        return OrderResource::collection($orders);
    }

    protected function createOrder(Request $request, Cart $cart)
    {
        return $request->user()->orders()->create(
            array_merge($request->only(['address_id', 'shipping_method_id']), [
                'subtotal' => $cart->subtotal()->amount()
            ])
        );
    }


}
