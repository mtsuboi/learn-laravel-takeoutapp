<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $order_id = $request->input('order_id');
        
        if($order_id) {
            // 注文番号が入っていたらそれ以外の条件はクリアする
            $scheduled_date = null;
            $user_name = null;
        } else {
            // 注文番号が入っていなくて他の条件も入ってなかったら予約日は当日にする
            if(!$request->input('scheduled_date') && !$request->input('user_name')) {
                $scheduled_date = Carbon::today()->toDateString();
            } else {
                $scheduled_date = $request->input('scheduled_date');
            }

            $user_name = $request->input('user_name');
        }

        $select = 'orders.id, users.name, cancel_datetime, scheduled_date, scheduled_time,';
        $select.= 'sum(quantity) as quantity,';
        $select.= 'sum(quantity * unit_price) as price';

        $query = Order::selectRaw($select)
                    ->join('users', function ($join) use($user_name) {
                        $join->on('users.id', '=', 'orders.user_id')
                            ->where('name','like','%' . $user_name . '%');
                    })
                    ->join('order_details', 'order_details.order_id', '=', 'orders.id')
                    ->groupBy('orders.id', 'users.name', 'cancel_datetime', 'scheduled_date', 'scheduled_time')
                    ->orderBy('orders.id');
        
        if($order_id) {
            $query = $query->where('orders.id', '=', $order_id);
        } elseif($scheduled_date) {
            $query = $query->where('scheduled_date', '=', $scheduled_date);
        }
        
        $orders = $query->paginate(5)->withQueryString();

        // dd($orders);
        return view('admin.orders.index', compact('orders', 'order_id', 'scheduled_date', 'user_name'));        
    }

    public function show($id)
    {
        $order = Order::with('orderDetails')
                    ->with('user')
                    ->with('orderDetails.item')
                    ->findOrFail($id);

        // 商品点数と合計金額を計算
        $itemQuantity = $order->orderDetails->sum('quantity');
        $totalPrice = $order->orderDetails->sum(function ($detail) {
            return $detail->quantity * $detail->unit_price;
        });

        // dd($order);
        return view('admin.orders.show', compact('order', 'itemQuantity', 'totalPrice'));
    }
}
