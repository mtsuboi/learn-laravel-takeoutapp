<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ご予約履歴
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if (count($orders) > 0)
                  @foreach ($orders as $order)
                  <div class="p-6 bg-white border-b border-gray-200 md:flex md:flex-wrap">
                      <div class="mb-4 md:mb-0 md:w-1/3">
                        <div>
                          <span class="text-sm font-bold text-gray-700">注文番号</span>
                          <span class="title-font font-medium text-xl text-gray-900">{{ $order->id }}</span>
                        </div>
                        <div>
                          <span class="text-sm font-bold text-gray-700">予約日</span>
                          <span class="title-font font-medium text-xl text-gray-900">{{ $order->scheduled_date }}</span>
                        </div>
                        <div>
                          <span class="text-sm font-bold text-gray-700">予約時間</span>
                          <span class="title-font font-medium text-xl text-gray-900">{{ $order->scheduled_time }}</span>
                          <span class="text-sm text-gray-700">時</span>
                        </div>
                        <div>
                          <span class="text-sm font-bold text-gray-700">合計金額</span>
                          <span class="title-font font-medium text-xl text-gray-900">{{ number_format($order->totalPrice) }}</span><span class="text-sm text-gray-700">円(税込)</span>
                        </div>
                        <div class="mt-4">
                          @if (isset($order->cancel_datetime))
                            <span class="px-4 text-sm font-bold bg-red-500 text-white">キャンセル済</span>
                          @elseif ($order->cancelable)
                            <form method="post" action="{{route('user.orders.cancel')}}" onsubmit="return confirm('キャンセルしてよろしいですか？')">
                              @csrf
                              <input type="hidden" name="id" value="{{ $order->id }}" />
                              <button type="submit" class="text-gray-400 hover:text-red-500">
                                <svg class="inline w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/></svg>
                                <span class="text-xs">キャンセル</span>
                              </button>
                            </form>
                          @endif
                        </div>
                      </div>
                      <div class="md:w-2/3">
                        @foreach ($order->orderDetails as $orderDetail)
                          <div class="flex items-center mb-2">
                            <div class="w-2/12"><img alt="ecommerce" class="object-cover object-center w-full h-full block" src="{{ asset(isset($orderDetail->item->item_image_path) ? '/storage/' . $orderDetail->item->item_image_path : '/img/noimage.png') }}"></div>
                            <div class="w-5/12 pl-2">{{ $orderDetail->item_name }}</div>
                            <div class="w-5/12 flex justify-around">
                              <div>{{ $orderDetail->quantity }}個</div>
                              <div>{{ number_format($orderDetail->unit_price * $orderDetail->quantity) }}</span><span class="text-sm text-gray-700">円（税込）</span></div>
                            </div>
                          </div>
                        @endforeach
                      </div>
                    </div>
                  @endforeach
                @else
                  ご予約の履歴はありません。
                @endif
            </div>
            @if (count($orders) > 0)
              <div class="py-3">
                {{ $orders->links() }}
              </div>
            @endif
        </div>
    </div>
</x-app-layout>
