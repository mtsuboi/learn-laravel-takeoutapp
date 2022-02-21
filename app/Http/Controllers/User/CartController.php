<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::id());
        $items = $user->items;
        $totalPrice = 0;

        foreach ($items as $item) {
            $totalPrice += $item->unit_price * $item->pivot->quantity;
        }

        // dd($items, $totalPrice);
        return view('user.cart', compact('items', 'totalPrice'));
    }

    public function add(Request $request)
    {
        $itemInCart = Cart::where('item_id', $request->item_id)
            ->where('user_id', Auth::id())->first();
        
        if($itemInCart){
            $itemInCart->quantity += $request->quantity;
            $itemInCart->save();
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'item_id' => $request->item_id,
                'quantity' => $request->quantity
            ]);
        }

        return redirect()->route('user.cart.index');
    }

    public function delete($id)
    {
        Cart::where('item_id', $id)
            ->where('user_id', Auth::id())
            ->delete();
        
        return redirect()->route('user.cart.index');
    }
}
