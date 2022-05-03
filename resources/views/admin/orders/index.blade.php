<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      注文一覧
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-3 md:p-6 bg-white border-b border-gray-200">

            <form class="" mothod="GET" action="{{ route('admin.orders.index') }}">
              <div>
                <div>
                  <x-label for="scheduled_date">注文番号:</x-label>
                  <x-input type="text" name="order_id" value="{{ $order_id }}" />
                </div>
              </div>
              <div class="py-3 flex items-center">
                <div>
                  <x-label for="scheduled_date">予約日:</x-label>
                  <x-input type="date" name="scheduled_date" value="{{ $scheduled_date }}" />
                </div>
                <div class="ml-2">
                  <x-label for="user_name">顧客名(部分一致):</x-label>
                  <x-input type="text" name="user_name" value="{{ $user_name }}" />
                </div>
                <div class="ml-2">
                  <x-button class="mt-5">
                    <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>
                    <span>検索</span>
                  </x-button>
                </div>
                <div class="ml-2">
                  <x-button class="mt-5" formaction="{{ route('admin.orders.print') }}" formtarget="_blank">
                    <svg  class="w-5 h-5 fill-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
                    <span>印刷</span>
                  </x-button>
                </div>
              </div>
            </form>

          <table class="table-auto w-full text-left whitespace-no-wrap">
            <thead>
              <tr>
                <th class="px-1 md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200 rounded-tl rounded-bl">注文番号</th>
                <th class="px-1 md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">顧客名</th>
                <th class="px-1 md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">キャンセル</th>
                <th class="px-1 md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">予約日</th>
                <th class="px-1 md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">予約時間</th>
                <th class="px-1 md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200 text-right">商品点数</th>
                <th class="px-1 md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200 text-right">合計金額</th>
              </tr>
            </thead>
            <tbody>
              @foreach($orders as $order)
                <tr>
                  <td class="px-1 md:px-4 py-3 border-t-2 border-gray-200">{{ $order->id }}</td>
                  <td class="px-1 md:px-4 py-3 border-t-2 border-gray-200">
                    <a class="no-underline hover:underline text-blue-500" href="{{ route('admin.orders.show', $order->id) }}">{{ $order->user->name }}</a>
                  </td>
                  <td class="px-1 md:px-4 py-3 border-t-2 border-gray-200">
                    @if ($order->cancel_datetime)
                       <span class="text-white text-sm bg-red-600 py-1 px-2 rounded-md">キャンセル</span>
                    @endif
                  </td>
                  <td class="px-1 md:px-4 py-3 border-t-2 border-gray-200">{{ $order->scheduled_date }}</td>
                  <td class="px-1 md:px-4 py-3 border-t-2 border-gray-200">{{ $order->scheduled_time }}時</td>
                  <td class="px-1 md:px-4 py-3 border-t-2 border-gray-200 text-right">{{ $order->quantity }}</td>
                  <td class="px-1 md:px-4 py-3 border-t-2 border-gray-200 text-right">{{ number_format($order->price) }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <div class="py-3">
        {{ $orders->links() }}
      </div>
    </div>
  </div>
</x-app-layout>