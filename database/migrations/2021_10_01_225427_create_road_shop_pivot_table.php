<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoadShopPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('road_shop', function (Blueprint $table) {
            $table->unsignedInteger('road_id');

            $table->foreign('road_id', 'road_id_fk_667152')->references('id')->on('roads')->onDelete('cascade');

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
        Schema::dropIfExists('road_shop');
    }
}
