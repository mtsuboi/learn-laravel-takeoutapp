<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            カート
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 bg-white border-b border-gray-200 md:flex md:flex-wap">
                  @if (count($items) > 0)
                    <div class="md:w-2/3">
                      @foreach ($items as $item)
                        <div class="flex items-center mb-2">
                          <div class="w-2/12"><img alt="ecommerce" class="object-cover object-center w-full h-full block" src="{{ asset(isset($item->item_image_path) ? '/storage/' . $item->item_image_path : '/img/noimage.png') }}"></div>
                          <div class="w-4/12 pl-2">{{ $item->item_name }}</div>
                          <div class="w-4/12 flex justify-around">
                            <div>{{ $item->pivot->quantity }}個</div>
                            <div>{{ number_format($item->unit_price * $item->pivot->quantity) }}</span><span class="text-sm text-gray-700">円（税込）</span></div>
                          </div>
                          <div class="w-2/12">
                            <form method="post" action="{{route('user.cart.delete', ['id' => $item->id])}}" onsubmit="return confirm('削除してよろしいですか？')">
                              @method('delete')
                              @csrf
                              <button type="submit" class="text-gray-400 hover:text-red-500">
                                <svg class="inline w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/></svg>
                                <span class="-ml-2 text-xs">削除</span>
                              </button>
                            </form>
                          </div>
                        </div>
                      @endforeach
                    </div>
                    <div class="p-4 md:w-1/3 text-right">
                      <span class="text-sm text-gray-700">合計金額</span>
                      <span class="title-font font-medium text-2xl text-gray-900">{{ number_format($totalPrice) }}</span><span class="text-sm text-gray-700">円(税込)</span>
                      <button class="text-white bg-indigo-500 border-0 my-2 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">予約確定</button>
                    </div>
                  @else
                    カートに商品が入っていません。
                  @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
