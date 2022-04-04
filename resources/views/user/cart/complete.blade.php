<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            予約注文完了
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="text-center text-2xl">
                        <p>予約注文が完了しました。</p>
                        <p>ご来店お待ちしております。</p>
                        <p>注文番号：{{ $order->id }}</p>
                        <x-button type="button" onclick="location.href='{{ route('user.items.index') }}'" >予約画面に戻る</x-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
