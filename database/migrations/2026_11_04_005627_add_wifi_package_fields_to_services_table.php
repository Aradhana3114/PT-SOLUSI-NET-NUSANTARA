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
        Schema::table('services', function (Blueprint $table) {
            $table->string('wifi_name')->nullable()->after('name');
            $table->unsignedInteger('speed_mbps')->nullable()->after('wifi_name');
            $table->unsignedBigInteger('monthly_fee')->nullable()->after('price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn(['wifi_name', 'speed_mbps', 'monthly_fee']);
        });
    }
};
