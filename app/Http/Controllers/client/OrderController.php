<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    function orders(Request $request)
    {
        try {
            $id = $request->user()->id;
            $orders = Order::where('client_id', $id)->get();
            return $orders;
        } catch (\Throwable $th) {
            return $th;
        }
    }

    function order($id)
    {
        try {
            $order = Product::select('products.*', 'order_product.quantity as sell_quantity', 'order_product.price as sell_price')
                ->join('order_product', 'products.id', '=', 'order_product.product_id')
                ->where('order_product.order_id', $id) // Use the function parameter
                ->get();

            return $order;
        } catch (\Throwable $th) {
            // Log the error for internal review
            Log::error("Error fetching order details: " . $th->getMessage());

            // Return a user-friendly message
            return response()->json(['error' => 'An error occurred while fetching order details.'], 500);
        }
    }

    function createOrder(Request $request)
    {

        $validatedOrder = [];
        $total = 0;
        $clientId = $request->user()->id;
        try {
            foreach ($request['order'] as $item) {
                $validator = Validator::make($item, [
                    'product_id' => 'required|exists:products,id',
                    'quantity' => 'required|integer|min:1',
                    'price' => 'required|numeric|min:0.01'
                ]);

                if ($validator->fails()) {
                    return 'error in the data';
                } else {
                    $validatedOrder[] = $item;
                }
            }
            $order = new Order;
            $order->client_id = $clientId;
            $order->supplier_id = $request->supplier_id;
            $order->total = 0;
            $order->save();
            $orderId = $order->id;
            foreach ($validatedOrder as $item) {
                DB::table('order_product')->insert([
                    'order_id' => $orderId,
                    'product_id' => $clientId,
                    'quantity' => $item['quantity'],
                    'price' => $item['price']
                ]);
                $total += ($item['quantity'] * $item['price']);
            }
            $order->total = $total;
            $order->save();
            return response($order, 200);
        } catch (\Throwable $th) {
            return $th;
        }
    }
}
