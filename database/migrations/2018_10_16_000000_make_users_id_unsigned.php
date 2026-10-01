<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Existing databases may have a signed users.id, which MySQL rejects
     * as the target of an unsigned foreign key.
     */
    public function up(): void
    {
        if (! Schema::hasTable('users') || ! Schema::hasColumn('users', 'id')) {
            return;
        }

        $column = DB::selectOne("SHOW COLUMNS FROM users WHERE Field = 'id'");
        if (! $column || str_contains($column->Type, 'unsigned')) {
            return;
        }

        DB::statement('ALTER TABLE users MODIFY id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT');
    }

    public function down(): void
    {
        //
    }
};
