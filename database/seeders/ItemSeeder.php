<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // データの削除
        DB::table('items')->truncate();

        // 画像ファイルは必要に応じて手動で削除
        // Storage::delete(Storage::allFiles('public/itemsimg'));

        // CSVファイル読み込み
        $file = new \SplFileObject(database_path('seeders/data/items.csv'));
        $file->setFlags(
            \SplFileObject::READ_CSV |
            \SplFileObject::READ_AHEAD |
            \SplFileObject::SKIP_EMPTY |
            \SplFileObject::DROP_NEW_LINE
        );

        foreach ($file as $index => $line) {
            // 1行目はヘッダ行なので読み飛ばす
            if($index === 0) {
                continue;
            }

            // フォームのデータを取得してモデルにセット
            $item = new Item;
            $item->item_name = $line[1];
            $item->unit_price = $line[2];
            $item->item_category = $line[3];
            $item->item_image_path = 'itemsimg/' . $line[0] . '.png';

            // データを保存
            $item->save();
        }
    }
}
