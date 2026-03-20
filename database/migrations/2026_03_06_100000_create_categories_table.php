<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('color', 7)->default('#d4a843'); // hex color for badge
            $table->timestamps();
        });

        // Seed default categories
        DB::table('categories')->insert([
            ['name' => 'Berita', 'slug' => 'berita', 'color' => '#d4a843', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Opini', 'slug' => 'opini', 'color' => '#2dd4bf', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Budaya', 'slug' => 'budaya', 'color' => '#f472b6', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Lingkungan', 'slug' => 'lingkungan', 'color' => '#34d399', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ekonomi', 'slug' => 'ekonomi', 'color' => '#60a5fa', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Teknologi', 'slug' => 'teknologi', 'color' => '#a78bfa', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
