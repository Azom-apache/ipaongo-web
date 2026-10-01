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
        if (! Schema::hasTable('projects')) {
            return;
        }

        $missing = ['price', 'short_desc', 'slug', 'sideber_visible'];
        $missing = array_filter($missing, fn ($column) => ! Schema::hasColumn('projects', $column));
        if ($missing === []) {
            return;
        }

        Schema::table('projects', function (Blueprint $table) {
            if (! Schema::hasColumn('projects', 'price')) {
                $table->decimal('price', 10, 2)->nullable();
            }
            if (! Schema::hasColumn('projects', 'short_desc')) {
                $table->text('short_desc')->nullable();
            }
            if (! Schema::hasColumn('projects', 'slug')) {
                $table->string('slug')->nullable();
            }
            if (! Schema::hasColumn('projects', 'sideber_visible')) {
                $table->boolean('sideber_visible')->default(0);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['price', 'short_desc', 'slug', 'sideber_visible']);
        });
    }
};
