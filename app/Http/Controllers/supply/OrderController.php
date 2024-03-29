<?php

namespace App\Http\Controllers\supply;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    function accept(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'Expected_delivery_date' => 'date|nullable',
            'status' => 'required|in:accept,cancel',
            'order_id' => 'required|exists:orders,id',
        ]);
        $order = Order::findOrfail($request->order_id);
        $order->update($request->only(['status', 'Expected_delivery_date']));
        return response()->json(['message' => 'Order updated successfully.'], 200);
    }

    function orders(Request $request)
    {
        $id = $request->user()->id;
        $orders = Order::where('supplier_id', $id)->with('products')->get();
        return $orders;
    }
}
