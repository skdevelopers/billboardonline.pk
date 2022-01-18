<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');

            $table->string('traffic_from')->nullable();

            $table->string('traffic_to')->nullable();

            $table->longText('description')->nullable();

            $table->string('address')->nullable();

            $table->string('latitude')->nullable();

            $table->string('longitude')->nullable();

            $table->boolean('featured')->default(0);

            $table->boolean('active')->default(0);

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
