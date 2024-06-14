<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeviceInfosTable extends Migration
{
    public function up()
    {
        Schema::create('device_infos', function (Blueprint $table) {
            $table->id();
            $table->string('model');
            $table->string('device');
            $table->string('buildId');
            $table->string('board');
            $table->string('brand');
            $table->string('display');
            $table->string('hardware');
            $table->string('product');
            $table->string('manufacturer');
            $table->string('osVersion');
            $table->string('device_id')->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('device_infos');
    }
}

