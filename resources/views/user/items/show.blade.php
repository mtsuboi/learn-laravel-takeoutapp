<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            商品詳細
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                  <div class="md:flex md:justify-around">
                    <div class="md:w-1/2">
                      <img alt="ecommerce" class="object-cover object-center w-full h-full block" src="{{ asset(isset($item->item_image_path) ? '/storage/' . $item->item_image_path : '/img/noimage.png') }}">
                    </div>
                    <div class="md:w-1/2 ml-4">
                      <h2 class="my-2 text-sm title-font text-gray-500 tracking-widest">{{ App\Enums\ItemCategory::getDescription($item->item_category) }}</h2>
                      <h1 class="my-2 text-gray-900 text-3xl title-font font-medium">{{ $item->item_name }}</h1>
                      <span class="title-font font-medium text-2xl text-gray-900">{{ number_format($item->unit_price) }}</span><span class="text-sm text-gray-700">円（税込）</span>
                      <form method="post" action="{{ route('user.cart.add') }}">
                        @csrf
                        <div class="flex items-center py-2 mt-4 pt-4 border-t-2">
                          <span class="mr-3">数量</span>
                          <div class="relative">
                            <select name="quantity" class="rounded border appearance-none border-gray-300 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 text-base pl-3 pr-10">
                              @for($qty=1; $qty<=9; $qty++)
                                <option value="{{ $qty }}">{{ $qty }}</option>
                              @endfor
                            </select>
                            <span class="absolute right-0 top-0 h-full w-10 text-center text-gray-600 pointer-events-none flex items-center justify-center">
                              <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4" viewBox="0 0 24 24">
                                <path d="M6 9l6 6 6-6"></path>
                              </svg>
                            </span>
                          </div>
                          <input type="hidden" name="item_id" value="{{ $item->id }}"/>
                          <button class="ml-8 text-white bg-indigo-500 border-0 my-2 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">カートに入れる</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
