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
            $table->unsignedInteger('repeat_count')->default(1)->after('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('device_media', function (Blueprint $table) {
            $table->dropColumn('repeat_count');
        });
    }
};
