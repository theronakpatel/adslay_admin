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
        Schema::table('device_media', function (Blueprint $table) {
            // Check if the foreign key already exists and drop it
            $table->dropForeign(['media_id']);

            // Add the new foreign key constraint on media_id
            $table->foreign('media_id', 'device_media_media_id_foreign_new')->references('id')->on('videos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('device_media', function (Blueprint $table) {
            // Drop the new foreign key constraint on media_id
            $table->dropForeign(['media_id']);

            // Optionally, add the original foreign key back if needed
            // $table->foreign('media_id')->references('id')->on('media')->onDelete('cascade');
        });
    }
};
