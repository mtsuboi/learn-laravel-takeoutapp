<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            店舗情報
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-wrap">
                        <img class="w-full md:w-1/2 p-4" src="{{ asset('img/shop.jpg') }}" alt="店舗外観">
                        <table class="table-auto w-full md:w-1/2">
                            <tbody>
                            <tr>
                                <th class="border-t-2 border-gray-200 px-4 py-3">店名</th>
                                <td class="border-t-2 border-gray-200 px-4 py-3">つぼいベーカリー 本店</td>
                            </tr>
                            <tr>
                                <th class="border-t-2 border-gray-200 px-4 py-3">住所</th>
                                <td class="border-t-2 border-gray-200 px-4 py-3">静岡県浜松市浜北区西美薗</td>
                            </tr>
                            <tr>
                                <th class="border-t-2 border-gray-200 px-4 py-3">最寄り駅</th>
                                <td class="border-t-2 border-gray-200 px-4 py-3">遠州鉄道 小林駅</td>
                            </tr>
                            <tr>
                                <th class="border-t-2 border-gray-200 px-4 py-3">電話番号</th>
                                <td class="border-t-2 border-gray-200 px-4 py-3">090-XXXX-XXXX</td>
                            </tr>
                            <tr>
                                <th class="border-t-2 border-gray-200 px-4 py-3">営業時間</th>
                                <td class="border-t-2 border-gray-200 px-4 py-3">8:00 ～ 19:00</td>
                            </tr>
                            <tr>
                                <th class="border-t-2 border-b-2 border-gray-200 px-4 py-3">定休日</th>
                                <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3">水曜・不定休</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        <p>「友かつ」から歩いて5分</p>
                        <img class="w-full max-w-lg border-2" src="{{ asset('img/accessmap.png') }}" alt="地図">
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
