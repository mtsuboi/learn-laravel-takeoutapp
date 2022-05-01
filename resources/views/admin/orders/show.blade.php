<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      注文詳細
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-3 md:p-6 bg-white border-b border-gray-200">
          <div class="py-3 flex items-center justify-between flex-wrap">
            <div class="flex items-center">
              <div class="p-3">
                <p class="text-sm text-gray-700 font-medium">注文番号:</p>
                <p class="text-2xl text-gray-700">{{ $order->id }}</p>
              </div>
              <div class="p-3">
                <p class="text-sm text-gray-700 font-medium">顧客名:</p>
                <p><span class="text-2xl text-gray-700">{{ $order->user->name }}</span><span class="ml-4 text-sm text-gray-700">様</span></p>
              </div>
            </div>
            <div class="flex items-center">
              <div class="p-3">
                <p class="text-sm text-gray-700 font-medium">予約日:</p>
                <p class="text-2xl text-gray-700">{{ $order->scheduled_date }}</p>
              </div>
              <div class="p-3">
                <p class="text-sm text-gray-700 font-medium">予約時間:</p>
                <p><span class="text-2xl text-gray-700">{{ $order->scheduled_time }}</span><span class="text-sm text-gray-700">時</span></p>
              </div>
            </div>
            <div class="flex items-center">
              <div class="p-3">
                <p class="text-sm text-gray-700 font-medium">商品点数:</p>
                <p><span class="text-2xl text-gray-700">{{ $itemQuantity }}</span><span class="text-sm text-gray-700">点</span></p>
              </div>
              <div class="p-3">
                <p class="text-sm text-gray-700 font-medium">合計金額:</p>
                <p><span class="text-2xl text-gray-700">{{ number_format($totalPrice) }}</span><span class="text-sm text-gray-700">円(税込み)</span></p>
              </div>
            </div>
          </div>
          @if(isset($order->cancel_datetime))
            <div class="-mt-3 ml-3 mb-3 flex items-center">
              <div>
                <p><span class="text-sm font-medium text-white bg-red-700 inline-block p-1">キャンセル</span></p>
              </div>
              <div class="ml-6">
                <p><span class="text-md text-gray-700">{{ $order->cancel_datetime }}</span></p>
              </div>
            </div>
          @endif
          <table class="table-auto w-full text-left whitespace-no-wrap">
            <thead>
              <tr>
                <th class="px-1 md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200 rounded-tl rounded-bl">No</th>
                <th class="px-1 md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">商品名</th>
                <th class="px-1 md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">商品画像</th>
                <th class="px-1 md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200 text-right">数量</th>
                <th class="px-1 md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200 text-right">金額</th>
              </tr>
            </thead>
            <tbody>
              @foreach($order->orderDetails as $detail)
                <tr>
                  <td class="px-1 md:px-4 py-3 border-t-2 border-gray-200">{{ $loop->iteration }}</td>
                  <td class="px-1 md:px-4 py-3 border-t-2 border-gray-200">{{ $detail->item_name }}</td>
                  <td class="px-1 md:px-4 py-3 border-t-2 border-gray-200">
                    <img class="w-14 h-14" src="{{ asset(isset($detail->item->item_image_path) ? '/storage/' . $detail->item->item_image_path : '/img/noimage.png') }}">
                  </td>
                  <td class="px-1 md:px-4 py-3 border-t-2 border-gray-200 text-right">{{ number_format($detail->quantity) }}</td>
                  <td class="px-1 md:px-4 py-3 border-t-2 border-gray-200 text-right">{{ number_format($detail->quantity * $detail->unit_price) }}円</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>