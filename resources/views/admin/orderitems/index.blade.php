<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      商品別注文数一覧
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-3 md:p-6 bg-white border-b border-gray-200">

            <form class="" mothod="GET" action="{{ route('admin.orderitems.index') }}">
              <div class="py-3 flex items-center">
                <div>
                  <x-label for="scheduled_date">予約日:</x-label>
                  <x-input type="date" name="scheduled_date" value="{{ $scheduled_date }}" />
                </div>
                <div class="ml-2">
                  <x-label for="item_name">商品名(部分一致):</x-label>
                  <x-input type="text" name="item_name" value="{{ $item_name }}" />
                </div>
                <div class="ml-2">
                  <x-button class="mt-5">
                    <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>
                    <span>検索</span>
                  </x-button>
                </div>
              </div>
            </form>

          <table class="table-auto w-full text-left whitespace-no-wrap">
            <thead>
              <tr>
                <th class="px-1 md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200 rounded-tl rounded-bl">商品ID</th>
                <th class="px-1 md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">商品名</th>
                <th class="px-1 md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200 text-right">10時～12時台</th>
                <th class="px-1 md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200 text-right">13時～15時台</th>
                <th class="px-1 md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200 text-right">16時～18時台</th>
              </tr>
            </thead>
            <tbody>
              @foreach($orderitems as $orderitem)
                <tr>
                  <td class="px-1 md:px-4 py-3 border-t-2 border-gray-200">{{ $orderitem->item_id }}</td>
                  <td class="px-1 md:px-4 py-3 border-t-2 border-gray-200">{{ $orderitem->item_name }}</td>
                  <td class="px-1 md:px-4 py-3 border-t-2 border-gray-200 text-right">{{ $orderitem->time10to12 ?: '' }}</td>
                  <td class="px-1 md:px-4 py-3 border-t-2 border-gray-200 text-right">{{ $orderitem->time13to15 ?: '' }}</td>
                  <td class="px-1 md:px-4 py-3 border-t-2 border-gray-200 text-right">{{ $orderitem->time16to18 ?: '' }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <div class="py-3">
        {{ $orderitems->links() }}
      </div>
    </div>
  </div>
</x-app-layout>