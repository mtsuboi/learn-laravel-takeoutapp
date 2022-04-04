<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\User;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Http\Requests\StoreCartRequest;

class CartController extends Controller
{
    public function index(Request $request)
    {
        // セッションのカートを取得
        $items = array();
        $totalPrice = 0;
        if($request->session()->has('cart' . Auth::id())) {
            $sessionCarts = $request->session()->get('cart' . Auth::id());

            // 商品情報を補完＆合計金額を計算
            foreach ($sessionCarts as $sessionCart) {
                $item = Item::findOrFail($sessionCart['item_id']);
                $items[] = new Cart(
                    $sessionCart['item_id'],
                    $item->item_name,
                    $item->unit_price,
                    $sessionCart['quantity'],
                    $item->item_image_path
                );
                $totalPrice += $item->unit_price * $sessionCart['quantity'];
            }
        }

        return view('user.cart.index', compact('items', 'totalPrice'));
    }

    public function add(Request $request)
    {
        // セッションのカートを取得し同じ商品があれば、数量を加算
        $itemFound = false;
        if($request->session()->has('cart' . Auth::id())) {
            $sessionCarts = $request->session()->get('cart' . Auth::id());
            $itemIndex = array_search($request->item_id, array_column($sessionCarts, 'item_id'));
            if($itemIndex !== false){
                $quantity = $sessionCarts[$itemIndex]['quantity'] + $request->quantity;
                $request->session()->put('cart' . Auth::id() . '.' . $itemIndex . '.quantity', $quantity);
                $itemFound = true;
            }
        }

        // セッションにカートが存在しないか同じ商品が無ければ、セッションに追加
        if(!$itemFound){
            $request->session()->push('cart' . Auth::id(), [
                'item_id' => $request->item_id,
                'quantity' => $request->quantity,
            ]);
        }

        return redirect()->route('user.cart.index');
    }

    public function store(StoreCartRequest $request)
    {
        // セッションにカートが無い場合は、カート画面に戻す
        if(!$request->session()->has('cart' . Auth::id())) {
            return redirect()->route('user.cart.index');
        }

        // セッションのカートを取得
        $sessionCarts = $request->session()->get('cart' . Auth::id());

        // 予約注文のインスタンスを作成しておく
        $order = new Order;
        
        // トランザクションで予約注文と明細を保存して、カートを削除
        DB::transaction(function () use($request, $order, $sessionCarts) {
            // 予約注文を保存
            $order->order_datetime = Carbon::now();
            $order->user_id = Auth::id();
            $order->scheduled_date = $request->scheduled_date;
            $order->scheduled_time = $request->scheduled_time;
            $order->save();

            // 明細を保存
            foreach ($sessionCarts as $sessionCart) {
                // 商品を検索
                $item = Item::findOrFail($sessionCart['item_id']);

                $orderDetail = new OrderDetail;
                $orderDetail->order_id = $order->id;
                $orderDetail->item_id = $sessionCart['item_id'];
                $orderDetail->item_name = $item->item_name;
                $orderDetail->unit_price = $item->unit_price;
                $orderDetail->quantity = $sessionCart['quantity'];
                $orderDetail->save();
            }

            // カートを削除
            $request->session()->forget('cart' . Auth::id());
        });

        return view('user.cart.complete', compact('order'));
    }

    public function delete(Request $request)
    {
        // セッションのカートを取得し同じ商品があれば、配列から削除してセッションを更新
        if($request->session()->has('cart' . Auth::id())) {
            $sessionCarts = $request->session()->get('cart' . Auth::id());
            $itemIndex = array_search($request->id, array_column($sessionCarts, 'item_id'));
            if($itemIndex !== false){
                array_splice($sessionCarts, $itemIndex, 1);
                $request->session()->put('cart' . Auth::id(), $sessionCarts);
            }
        }
        
        return redirect()->route('user.cart.index');
    }
}
