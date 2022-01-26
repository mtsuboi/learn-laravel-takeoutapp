<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            パンへのこだわり
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p>毎日美味しく召し上がっていただけるパンを目指しています。</p>
                    <div class="mt-6">
                        <h3 class="font-semibold text-xl">素材にこだわりました。</h3>
                        <p>地元静岡県産の無農薬栽培の国産小麦を使用し、水は浜松の水道水を長期熟成させて使用しています。<br/>
                        その他原材料も地元産にこだわっております。</p>
                        <img class="w-full max-w-2xl" src="{{ asset('img/concept1.jpg') }}" alt="地元静岡県産の無農薬国産小麦を使用">
                    </div>
                    <div class="mt-6">
                        <h3 class="font-semibold text-xl">食感、味わい、香りにこだわりました。</h3>
                        <p>フランスで３か月修業した熟練したパン職人が、季節と天候と気分にあわせて水加減や火加減を調整し、丹精込めて作りあげます。<br/>
                        だからこそ、他では味わえない食感、味わい、香りが引き出されるのです。</p>
                        <img class="w-full max-w-2xl" src="{{ asset('img/shop3.jpg') }}" alt="食感、味わい、香り">
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
