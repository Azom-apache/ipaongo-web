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
        Schema::table('pages', function (Blueprint $table) {
            $table->string('subtitle')->nullable()->after('title');
            $table->text('image')->nullable()->after('subtitle');
            $table->text('excerpt')->nullable()->after('image');
            $table->longText('description')->nullable()->after('content');
            $table->string('slug')->unique()->nullable()->after('description');
            $table->integer('order')->default(1)->after('slug');
            $table->unsignedBigInteger('addedby_id')->nullable()->after('order');
            $table->unsignedBigInteger('editedby_id')->nullable()->after('addedby_id');

            $table->foreign('addedby_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('editedby_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropForeign(['addedby_id']);
            $table->dropForeign(['editedby_id']);
            $table->dropColumn(['subtitle', 'image', 'excerpt', 'description', 'slug', 'order', 'addedby_id', 'editedby_id']);
        });
    }
};
