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
        if (! Schema::hasTable('galleries')) {
            return;
        }

        $missing = ['parent', 'image', 'title', 'slug'];
        $missing = array_filter($missing, fn ($column) => ! Schema::hasColumn('galleries', $column));
        if ($missing === []) {
            return;
        }

        Schema::table('galleries', function (Blueprint $table) {
            if (! Schema::hasColumn('galleries', 'parent')) {
                $table->integer('parent')->default(0);
            }
            if (! Schema::hasColumn('galleries', 'image')) {
                $table->string('image')->nullable();
            }
            if (! Schema::hasColumn('galleries', 'title')) {
                $table->string('title')->nullable();
            }
            if (! Schema::hasColumn('galleries', 'slug')) {
                $table->string('slug')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('galleries', function (Blueprint $table) {
            $table->dropColumn(['parent', 'image', 'title', 'slug']);
        });
    }
};
