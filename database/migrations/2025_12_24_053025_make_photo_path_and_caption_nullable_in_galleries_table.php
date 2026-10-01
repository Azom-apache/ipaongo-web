<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (! Schema::hasTable('galleries')) {
            return;
        }

        foreach (['photo_path', 'caption'] as $column) {
            $definition = DB::selectOne("SHOW COLUMNS FROM galleries WHERE Field = ?", [$column]);
            if ($definition && $definition->Null === 'NO') {
                DB::statement("ALTER TABLE galleries MODIFY {$column} {$definition->Type} NULL");
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('galleries', function (Blueprint $table) {
            $table->string('photo_path')->nullable(false)->change();
            $table->string('caption')->nullable(false)->change();
        });
    }
};
