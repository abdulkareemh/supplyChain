<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CancelOrderController extends Controller
{
    function cancelOrder(Request $request,$orderId)
    {
        $order = Order::find($orderId);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $createdAt = Carbon::parse($order->created_at);
        $now = Carbon::now();
        $diffInMinutes = $now->diffInMinutes($createdAt);

        if ($diffInMinutes < 60) {
            $order->status = 'cancel';
            $order->save();
            return response()->json(['message' => 'Order cancelled'], 200);
        } else {
            return response()->json(['message' => 'Cannot cancel order'], 403);
        }
    }
}
