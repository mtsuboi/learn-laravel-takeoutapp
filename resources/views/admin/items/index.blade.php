<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      商品一覧
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-3 md:p-6 bg-white border-b border-gray-200">
          <div class="py-3 flex justify-between">
            <x-button type="button" onclick="location.href='{{ route('admin.items.create') }}'">
              <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path d="M13 7h-2v4H7v2h4v4h2v-4h4v-2h-4V7zm-1-5C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/></svg>
              <span>新規登録</span>
            </x-button>
            <form class="flex items-center" mothod="GET" action="{{ route('admin.items.index') }}">
              <x-input type="search" name="item_name" placeholder="商品名(部分一致)" value="{{ $item_name }}" />
              <x-button>
                <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>
                <span>検索</span>
              </x-button>
            </form>
          </div>
          <table class="table-auto w-full text-left whitespace-no-wrap">
            <thead>
              <tr>
                <th class="px-1 md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200 rounded-tl rounded-bl">商品ID</th>
                <th class="px-1 md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">商品名</th>
                <th class="px-1 md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200 text-right">単価</th>
                <th class="px-1 md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">商品分類</th>
                <th class="px-1 md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">商品画像</th>
                <th class="w-10 px-1 md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200 rounded-tr rounded-br">
                  <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/></svg>
                </th>
              </tr>
            </thead>
            <tbody>
              @foreach($items as $item)
                <tr>
                  <td class="px-1 md:px-4 py-3 border-t-2 border-gray-200">{{$item->id}}</td>
                  <td class="px-1 md:px-4 py-3 border-t-2 border-gray-200">
                    <a class="no-underline hover:underline text-blue-500" href="{{ route('admin.items.edit', ['item' => $item->id]) }}">{{$item->item_name}}</a>
                  </td>
                  <td class="px-1 md:px-4 py-3 border-t-2 border-gray-200 text-right">{{number_format($item->unit_price)}}</td>
                  <td class="px-1 md:px-4 py-3 border-t-2 border-gray-200">{{App\Enums\ItemCategory::getDescription($item->item_category)}}</td>
                  <td class="px-1 md:px-4 py-3 border-t-2 border-gray-200">
                    <img class="w-14 h-14" src="{{ asset(isset($item->item_image_path) ? '/storage/' . $item->item_image_path : '/img/noimage.png') }}">
                  </td>
                  <td class="w-10 px-1 md:px-4 py-3 border-t-2 border-gray-200">
                    <form method="POST" action="{{ route('admin.items.destroy', ['item' => $item->id]) }}" onsubmit="return confirm('削除してよろしいですか？')">
                      @method('DELETE')
                      @csrf
                      <button type="submit" class="text-gray-400 hover:text-red-500">
                        <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/></svg>
                      </button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <div class="py-3">
        {{ $items->links() }}
      </div>
    </div>
  </div>
</x-app-layout>
