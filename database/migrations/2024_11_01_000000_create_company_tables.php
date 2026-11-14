<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $t) {
            $t->id();
            $t->string('site_name')->default('PT Solusi Nusantara');
            $t->longText('site_description')->nullable();
            $t->string('logo')->nullable();
            $t->string('email')->nullable();
            $t->string('phone')->nullable();
            $t->text('address')->nullable();
            $t->string('maps_url')->nullable();
            $t->string('facebook')->nullable();
            $t->string('youtube')->nullable();
            $t->string('instagram')->nullable();
            $t->string('x')->nullable();
            $t->string('linkedin')->nullable();
            $t->timestamps();
        });

        Schema::create('modules', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->string('slug')->unique();
            $t->string('description')->nullable();
            $t->string('image')->nullable();
            $t->unsignedInteger('sort_order')->default(1);
            $t->boolean('is_active')->default(true);
            $t->timestamps();
        });

        Schema::create('module_objects', function (Blueprint $t) {
            $t->id();
            $t->foreignId('module_id')->constrained('modules')->cascadeOnDelete();
            $t->string('name');
            $t->string('slug');
            $t->string('description')->nullable();
            $t->string('detail_header')->nullable();
            $t->longText('detail_description')->nullable();
            $t->string('image')->nullable();
            $t->unsignedInteger('sort_order')->default(1);
            $t->boolean('is_active')->default(true);
            $t->timestamps();
            $t->unique(['module_id', 'slug']);
        });

    }

    public function down(): void
    {
        foreach (['module_objects', 'modules', 'site_settings'] as $table) {
            Schema::dropIfExists($table);
        }
    }
};
