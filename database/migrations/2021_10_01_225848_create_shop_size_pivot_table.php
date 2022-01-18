<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopSizePivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_size', function (Blueprint $table) {
            $table->unsignedInteger('size_id');

            $table->foreign('size_id', 'size_id_fk_667152')->references('id')->on('sizes')->onDelete('cascade');

            $table->unsignedInteger('shop_id');

            $table->foreign('shop_id', 'shop_id_fk_667152')->references('id')->on('shops')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shop_size');
    }
}
