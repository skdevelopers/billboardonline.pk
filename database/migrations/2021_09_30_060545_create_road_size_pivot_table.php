<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoadSizePivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('road_size', function (Blueprint $table) {
            $table->unsignedInteger('road_id');

            $table->foreign('road_id', 'road_id_fk_667152')->references('id')->on('roads')->onDelete('cascade');

            $table->unsignedInteger('size_id');

            $table->foreign('size_id', 'size_id_fk_667152')->references('id')->on('sizes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('road_size');
    }
}
