<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration 
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add 'trashed' to status enum
        DB::statement("
            ALTER TABLE articles
            ALTER COLUMN status TYPE VARCHAR(20)
        ");

        DB::statement("
            ALTER TABLE articles
            ALTER COLUMN status SET DEFAULT 'pending'
        ");

        // Add trashed_reason column to track why it was trashed
        Schema::table('articles', function (Blueprint $table) {
            $table->string('trashed_reason')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('trashed_reason');
        });

        DB::statement("ALTER TABLE `articles` MODIFY `status` ENUM('pending','approved','rejected','unpublished') NOT NULL DEFAULT 'pending'");
    }
};
