<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('device_media', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('device_id');
            $table->unsignedBigInteger('media_id');
            $table->timestamps();

            $table->foreign('device_id')->references('id')->on('devices')->onDelete('cascade');
            $table->foreign('media_id')->references('id')->on('media')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('device_media');
    }
};
