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
            if (! Schema::hasColumn('pages', 'subtitle')) {
                $table->string('subtitle')->nullable()->after('title');
            }
            if (! Schema::hasColumn('pages', 'image')) {
                $table->text('image')->nullable()->after('subtitle');
            }
            if (! Schema::hasColumn('pages', 'excerpt')) {
                $table->text('excerpt')->nullable()->after('image');
            }
            if (! Schema::hasColumn('pages', 'description')) {
                $table->longText('description')->nullable()->after('content');
            }
            if (! Schema::hasColumn('pages', 'slug')) {
                $table->string('slug')->unique()->nullable()->after('description');
            }
            if (! Schema::hasColumn('pages', 'order')) {
                $table->integer('order')->default(1)->after('slug');
            }
            if (! Schema::hasColumn('pages', 'addedby_id')) {
                $table->unsignedBigInteger('addedby_id')->nullable()->after('order');
                $table->foreign('addedby_id')->references('id')->on('users')->onDelete('cascade');
            }
            if (! Schema::hasColumn('pages', 'editedby_id')) {
                $table->unsignedBigInteger('editedby_id')->nullable()->after('addedby_id');
                $table->foreign('editedby_id')->references('id')->on('users')->onDelete('cascade');
            }
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
