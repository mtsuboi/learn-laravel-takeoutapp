<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCartRequest;
use App\Services\CartService;

class CartController extends Controller
{
    public function index(CartService $cartService)
    {
        // セッションのカートを取得して、合計金額を計算
        $items = $cartService->getItems();
        $totalPrice = $items->sum(function($item) {return $item->unit_price * $item->quantity;});

        return view('user.cart.index', compact('items', 'totalPrice'));
    }

    public function add(Request $request, CartService $cartService)
    {
        // セッションのカートに追加（同じ商品には数量を加算）
        $cartService->add($request->item_id, $request->quantity);

        return redirect()->route('user.cart.index');
    }

    public function store(StoreCartRequest $request, CartService $cartService)
    {
        // カートを確定
        $order = $cartService->order($request->scheduled_date, $request->scheduled_time);

        // 確定できたら注文完了画面へ、NGの場合はカート画面に戻す
        if($order) {
            return view('user.cart.complete', compact('order'));
        } else {
            return redirect()->route('user.cart.index');
        }
    }

    public function delete($id, CartService $cartService)
    {
        // セッションのカートを取得し同じ商品があれば、配列から削除してセッションを更新
        $cartService->delete($id);
        
        return redirect()->route('user.cart.index');
    }
}
