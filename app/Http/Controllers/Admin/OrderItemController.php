<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use Carbon\Carbon;

class OrderItemController extends Controller
{
    public function index(Request $request)
    {
        if($request->input('scheduled_date')) {
            $scheduled_date = $request->input('scheduled_date');
        } else {
            $scheduled_date = Carbon::today()->toDateString();
        }
        $item_name = $request->input('item_name');

        $select = 'item_id, item_name,';
        $select.= 'SUM(CASE WHEN scheduled_time BETWEEN 10 AND 12 THEN quantity ELSE 0 END) AS time10to12,';
        $select.= 'SUM(CASE WHEN scheduled_time BETWEEN 13 AND 15 THEN quantity ELSE 0 END) AS time13to15,';
        $select.= 'SUM(CASE WHEN scheduled_time BETWEEN 16 AND 18 THEN quantity ELSE 0 END) AS time16to18';

        $orderitems = Order::selectRaw($select)
                    ->join('order_details', function ($join) use($item_name) {
                        $join->on('order_details.order_id', '=', 'orders.id')
                            ->where('item_name','like','%' . $item_name . '%');
                    })
                    ->where('scheduled_date', '=', $scheduled_date)
                    ->groupBy('item_id')
                    ->groupBy('item_name')
                    ->orderBy('item_id')
                    ->paginate(5)->withQueryString();

        // dd($orderitems);
        return view('admin.orderitems.index', compact('orderitems', 'scheduled_date', 'item_name'));
    }
}
