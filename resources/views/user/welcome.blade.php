<x-app-layout>
    <x-slot name="header">
        <h4 class="font-semibold text-sm text-gray-800 leading-tight">
            ようこそ！つぼいベーカリーへ！
        </h4>
        <p class="text-sm">浜松市浜北区にある地産地消とオーガニックにこだわったパン屋さんです。</p>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Slider main container -->
                    <div class="swiper">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            <div class="swiper-slide"><img src="{{ asset('img/shop1.jpg') }}" /></div>
                            <div class="swiper-slide"><img src="{{ asset('img/shop2.jpg') }}" /></div>
                            <div class="swiper-slide"><img src="{{ asset('img/shop3.jpg') }}" /></div>
                        </div>
                        <!-- pagination -->
                        <div class="swiper-pagination"></div>

                        <!-- navigation buttons -->
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ mix('js/swiper.js') }}"></script>
</x-app-layout>
