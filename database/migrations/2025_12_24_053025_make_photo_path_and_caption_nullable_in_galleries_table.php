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
        if (! Schema::hasColumn('galleries', 'photo_path') || ! Schema::hasColumn('galleries', 'caption')) {
            return;
        }

        Schema::table('galleries', function (Blueprint $table) {
            $table->string('photo_path')->nullable()->change();
            $table->string('caption')->nullable()->change();
        });
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
