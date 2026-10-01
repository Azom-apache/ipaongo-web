<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (! Schema::hasColumn('projects', 'status')) {
            return;
        }

        DB::table('projects')->whereNull('status')->update(['status' => 1]);
        DB::statement('ALTER TABLE projects MODIFY status INT NOT NULL DEFAULT 1');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (! Schema::hasColumn('projects', 'status')) {
            return;
        }

        DB::statement('ALTER TABLE projects MODIFY status INT NULL DEFAULT NULL');
    }
};
