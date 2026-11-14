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
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn(['facebook', 'youtube', 'x']);
            $table->string('tiktok')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn('tiktok');
            $table->string('facebook')->nullable();
            $table->string('youtube')->nullable();
            $table->string('x')->nullable();
        });
    }
};
