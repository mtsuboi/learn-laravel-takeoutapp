<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            お取り置き予約
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-wrap -m-4">
                        @foreach ($items as $item )
                            <div class="lg:w-1/4 md:w-1/2 p-4 w-full">
                                <a href="{{route('user.items.show', ['id' => $item->id])}}" class="block relative h-48 rounded overflow-hidden">
                                    <img alt="ecommerce" class="object-cover object-center w-full h-full block" src="{{ asset(isset($item->item_image_path) ? '/storage/' . $item->item_image_path : '/img/noimage.png') }}">
                                </a>
                                <div class="mt-4">
                                    <h3 class="text-gray-500 text-xs tracking-widest title-font mb-1">{{ App\Enums\ItemCategory::getDescription($item->item_category) }}</h3>
                                    <h2 class="text-gray-900 title-font text-lg font-medium">{{ $item->item_name }}</h2>
                                    <p class="mt-1">{{ number_format($item->unit_price) }}円（税込）</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
