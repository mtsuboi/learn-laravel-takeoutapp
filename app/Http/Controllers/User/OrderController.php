<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderDetail;
use Carbon\Carbon;
use App\Jobs\SendCancelConfirmMail;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
                    ->with('orderDetails')
                    ->with('orderDetails.item')
                    ->orderByDesc('scheduled_date')
                    ->orderByDesc('scheduled_time')
                    ->orderByDesc('id')
                    ->paginate(5);

        // ordersコレクションにtotalPriceカラムとcancelableカラムを追加
        $orders->map(function ($order) {
            $order['totalPrice'] = $order->orderDetails->sum(function ($detail) {
                return $detail->unit_price * $detail->quantity;
            });
            $order['cancelable'] = $order->scheduled_date > Carbon::today();
        });
        
        return view('user.orders.index', compact('orders'));
    }

    public function cancel(Request $request)
    {
        // 注文データを取得（ユーザーID指定・キャンセル日時がNULL）
        $order = Order::where('id', $request->id)
                    ->where('user_id', Auth::id())
                    ->whereNull('cancel_datetime')
                    ->first();

        if($order) {
            // キャンセル日時に現在日時をセットして保存
            $order->cancel_datetime = Carbon::now();
            $order->save();

            // キャンセルメール送信
            SendCancelConfirmMail::dispatch(Auth::user(), $order);
        }

        return redirect()->route('user.orders.index');
    }
}
