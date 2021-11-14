<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      商品新規登録
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          <!-- Validation Errors -->
          <x-validation-errors class="mb-4 lg:px-24" :errors="$errors" />

          <form method="POST" action="{{ route('items.store') }}" enctype="multipart/form-data" class="grid gap-4 grid-cols-1 md:grid-cols-2 lg:px-24">
            @csrf
            <div class="grid gap-4 grid-cols-1">
              <!-- 商品ID -->
              <div>
                <x-label>商品ID</x-label>
                <x-input type="text" name="item_id" class="w-1/2 bg-gray-200 text-gray-500" value="自動採番されます" disabled />
              </div>
              <!-- 商品名 -->
              <div>
                <x-label>商品名</x-label>
                <x-input type="text" name="item_name" class="w-full" value="{{ old('item_name') }}" />
              </div>
              <!-- 単価 -->
              <div>
                <x-label>単価</x-label>
                <x-input type="number" name="unit_price" class="w-1/2" value="{{ old('unit_price') }}" />
              </div>
              <!-- 商品分類 -->
              <div>
                <x-label>商品分類</x-label>
                <select name="item_category" class="w-1/2 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" >
                  @foreach(App\Enums\ItemCategory::asSelectArray() as $key => $value)
                    <option value="{{ $key }}" @if(old('item_category') == $key) selected @endif>{{ $value }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div>
              <x-label>商品画像</x-label>
              <x-input type="file" name="item_image" class="w-full" accept="image/png, image/jpeg" />
            </div>

            <div class="mt-4">
              <x-button>保存</x-button>
              <x-button formmethod="GET" formaction="{{ route('items.index') }}" >戻る</x-button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
