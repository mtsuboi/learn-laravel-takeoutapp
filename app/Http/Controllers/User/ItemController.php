<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return view('user.items.index', compact('items'));
    }

    public function show($id)
    {
        $item = Item::findOrFail($id);
        return view('user.items.show', compact('item'));
    }
}
