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
        // Drop the constraint that was created by Laravel's enum when the table was originally created.
        if (DB::connection()->getDriverName() === 'pgsql') {
            DB::statement('ALTER TABLE articles DROP CONSTRAINT IF EXISTS articles_status_check');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No down needed; the check constraint shouldn't exist anymore as we now support trashed, unpublished.
    }
};
