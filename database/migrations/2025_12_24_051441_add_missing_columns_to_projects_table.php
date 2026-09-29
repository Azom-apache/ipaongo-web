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
        Schema::table('projects', function (Blueprint $table) {
            $table->decimal('price', 10, 2)->nullable()->after('title');
            $table->text('short_desc')->nullable()->after('description');
            $table->string('slug')->nullable()->after('image');
            $table->boolean('sideber_visible')->default(0)->after('status');
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
