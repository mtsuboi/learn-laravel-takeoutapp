<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use Carbon\Carbon;

class OrderService
{
    public function getOrders($order_id, $scheduled_date = null, $user_name = null, $isRejectCancel = false, $isPaginate = false)
    {
        $query = Order::with('orderDetails')
        ->with('user')
        ->with('orderDetails.item');

        if($order_id) {
            $query = $query->where('id', '=', $order_id);
        }
        if($scheduled_date) {
            $query = $query->where('scheduled_date', '=', $scheduled_date);
        }
        if($user_name) {
            $query = $query->whereHas('user', function ($query) use($user_name) {
                $query->where('name', 'like', '%' . $user_name . '%');
            });
        }
        if($isRejectCancel) {
            $query = $query->whereNull('cancel_datetime');
        }

        if($isPaginate) {
            $orders = $query->paginate(5)->withQueryString();
        } else {
            $orders = $query->get();
        }

        // ordersコレクションにquantityカラムとpriceカラムを追加
        $orders->map(function ($order) {
            $order['quantity'] = $order->orderDetails->sum('quantity');
            $order['price'] = $order->orderDetails->sum(function ($detail) {
                return $detail->unit_price * $detail->quantity;
            });
        });

        return $orders;
    }
}