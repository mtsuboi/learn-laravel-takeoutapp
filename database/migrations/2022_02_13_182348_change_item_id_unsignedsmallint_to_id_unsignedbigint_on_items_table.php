<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeItemIdUnsignedsmallintToIdUnsignedbigintOnItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // カラム名を変更
        Schema::table('items', function (Blueprint $table) {
            $table->renameColumn('item_id', 'id');
        });

        // 型を変更
        Schema::table('items', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // 型を戻す
        Schema::table('items', function (Blueprint $table) {
            $table->unsignedSmallInteger('id')->change();
        });
        
        // カラム名を戻す
        Schema::table('items', function (Blueprint $table) {
            $table->renameColumn('id', 'item_id');
        });
    }
}
