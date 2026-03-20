<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration 
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add 'unpublished' to the enum values for status
        DB::statement("
            ALTER TABLE articles
            ALTER COLUMN status TYPE VARCHAR(20)
        ");

        DB::statement("
            ALTER TABLE articles
            ALTER COLUMN status SET DEFAULT 'pending'
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // revert to previous enum values (remove 'unpublished')
        DB::statement("ALTER TABLE `articles` MODIFY `status` ENUM('pending','approved','rejected') NOT NULL DEFAULT 'pending'");
    }
};
