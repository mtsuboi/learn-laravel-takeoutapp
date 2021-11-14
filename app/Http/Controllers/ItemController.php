<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

use App\Models\Item;
use App\Http\Requests\StoreItemRequest;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * 商品一覧の表示
     *
     * @param  \App\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 商品を全件読み込む
        // $items = Item::all();

        // 商品を5件ずつのページネーションで読み込む(条件指定)
        $item_name = $request->input('item_name');
        $query = Item::where('item_name','like','%' . $item_name . '%');
        $items = $query->paginate(5)->withQueryString();

        return view('items/index', compact('items','item_name'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 新規作成画面を表示する
        return view('items/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreItemRequest $request)
    {
        // フォームのデータを取得してモデルにセット
        $item = new Item;
        $item->item_name = $request->input('item_name');
        $item->unit_price = $request->input('unit_price');
        $item->item_category = $request->input('item_category');

        // 画像をアップロードしてパスをセット
        if(request('item_image')){
            $item->item_image_path = $request->file('item_image')->store('itemsimg','public');
        }

        // データを保存
        $item->save();

        return redirect('items');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // データを取得
        $item = Item::find($id);

        return view('items/edit',compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreItemRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreItemRequest $request, $id)
    {
        // フォームのデータを取得してモデルにセット
        $item = Item::find($id);
        $item->item_name = $request->input('item_name');
        $item->unit_price = $request->input('unit_price');
        $item->item_category = $request->input('item_category');

        // ファイルが指定された場合、既存画像は削除した上でアップロード、DBのパスを更新
        if($request->file('item_image')){
            Storage::delete(storage_path('/app/public/' . $item->item_image_path));
            $item->item_image_path = $request->file('item_image')->store('itemsimg','public');
        }

        // データを保存
        $item->save();

        return redirect('items');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // データを取得
        $item = Item::find($id);

        // 画像ファイルを削除
        Storage::delete(storage_path('/app/public/' . $item->item_image_path));

        // データを削除
        $item->delete();

        return redirect('items');
    }
}
