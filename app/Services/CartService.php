<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderDetail;

class CartService
{
    public function getItems()
    {
        // セッションのカートを取得
        $cartItems = collect();
        if(session()->has('cart' . Auth::id())) {
            $sessionCarts = session()->get('cart' . Auth::id());

            // 商品情報を補完
            foreach ($sessionCarts as $sessionCart) {
                $item = Item::findOrFail($sessionCart['item_id']);
                // 連想配列をオブジェクトに変換して追加
                $cartItems->add((object)[
                    'item_id' => $sessionCart['item_id'],
                    'item_name' => $item->item_name,
                    'unit_price' => $item->unit_price,
                    'quantity' => $sessionCart['quantity'],
                    'item_image_path' => $item->item_image_path
                ]);
            }
        }

        return $cartItems;
    }

    public function add($item_id, $quantity)
    {
        // セッションのカートを取得し同じ商品があれば、数量を加算
        $itemFound = false;
        if(session()->has('cart' . Auth::id())) {
            $sessionCarts = session()->get('cart' . Auth::id());
            $itemIndex = array_search($item_id, array_column($sessionCarts, 'item_id'));
            if($itemIndex !== false){
                $addedQuantity = $sessionCarts[$itemIndex]['quantity'] + $quantity;
                session()->put('cart' . Auth::id() . '.' . $itemIndex . '.quantity', $addedQuantity);
                $itemFound = true;
            }
        }

        // セッションにカートが存在しないか同じ商品が無ければ、セッションに追加
        if(!$itemFound){
            session()->push('cart' . Auth::id(), [
                'item_id' => $item_id,
                'quantity' => $quantity,
            ]);
        }

        return $itemFound;
    }

    public function order($scheduled_date, $scheduled_time)
    {
        // セッションにカートが無い場合は、終了
        if(!session()->has('cart' . Auth::id())) {
            return null;
        }

        // セッションのカートを取得
        $sessionCarts = session()->get('cart' . Auth::id());

        // 予約注文のインスタンスを作成しておく
        $order = new Order;
        
        // トランザクションで予約注文と明細を保存して、カートを削除
        DB::transaction(function () use($scheduled_date, $scheduled_time, $order, $sessionCarts) {
            // 予約注文を保存
            $order->order_datetime = Carbon::now();
            $order->user_id = Auth::id();
            $order->scheduled_date = $scheduled_date;
            $order->scheduled_time = $scheduled_time;
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
            session()->forget('cart' . Auth::id());
        });

        return $order;
    }

    public function delete($item_id)
    {
        // セッションのカートを取得し同じ商品があれば、配列から削除してセッションを更新
        $itemFound = false;
        if(session()->has('cart' . Auth::id())) {
            $sessionCarts = session()->get('cart' . Auth::id());
            $itemIndex = array_search($item_id, array_column($sessionCarts, 'item_id'));
            if($itemIndex !== false){
                array_splice($sessionCarts, $itemIndex, 1);
                session()->put('cart' . Auth::id(), $sessionCarts);
                $itemFound = true;
            }
        }
        
        return $itemFound;
    }
}