<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;
use App\Services\OrderService;

class OrderController extends Controller
{
    public function index(Request $request, OrderService $orderService)
    {
        $order_id = $request->input('order_id');
        $scheduled_date = $request->input('scheduled_date');
        $user_name = $request->input('user_name');        

        if($order_id) {
            // 注文番号が入っていたらそれ以外の条件はクリアする
            $scheduled_date = null;
            $user_name = null;
        } elseif(!$scheduled_date && !$user_name) {
            // 予約日も顧客名も入ってなかったら予約日は当日にする
            $scheduled_date = Carbon::today()->toDateString();
        }

        $orders = $orderService->getOrders($order_id, $scheduled_date, $user_name, false, true);

        return view('admin.orders.index', compact('orders', 'order_id', 'scheduled_date', 'user_name'));        
    }

    public function show($id, OrderService $orderService)
    {
        $order = $orderService->getOrders($id)->first();
        return view('admin.orders.show', compact('order'));
    }

    public function print(Request $request, OrderService $orderService)
    {
        $order_id = $request->input('order_id');
        $scheduled_date = $request->input('scheduled_date');
        $user_name = $request->input('user_name');        

        if($order_id) {
            // 注文番号が入っていたらそれ以外の条件はクリアする
            $scheduled_date = null;
            $user_name = null;
        } elseif(!$scheduled_date && !$user_name) {
            // 予約日も顧客名も入ってなかったら予約日は当日にする
            $scheduled_date = Carbon::today()->toDateString();
        }

        $orders = $orderService->getOrders($order_id, $scheduled_date, $user_name, true, false);
        
        $pdf = \PDF::loadView('admin.orders.print', compact('orders'));
        $pdf->setPaper('A6');
        return $pdf->stream('orders.pdf');
    }
}
