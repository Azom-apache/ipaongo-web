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
        Schema::table('sliders', function (Blueprint $table) {
            if (! Schema::hasColumn('sliders', 'title')) {
                $table->string('title')->nullable()->after('id');
            }
            if (! Schema::hasColumn('sliders', 'title_two')) {
                $table->string('title_two')->nullable()->after('title');
            }
            if (! Schema::hasColumn('sliders', 'type')) {
                $table->string('type')->nullable()->after('caption');
            }
            if (! Schema::hasColumn('sliders', 'offer_id')) {
                $table->unsignedBigInteger('offer_id')->nullable()->after('type');
                $table->foreign('offer_id')->references('id')->on('offers')->onDelete('cascade');
            }
            if (! Schema::hasColumn('sliders', 'slug')) {
                $table->string('slug')->nullable()->after('image');
            }
            if (! Schema::hasColumn('sliders', 'status')) {
                $table->integer('status')->default(1)->after('slug');
            }
            if (! Schema::hasColumn('sliders', 'order')) {
                $table->integer('order')->default(1)->after('status');
            }
            if (! Schema::hasColumn('sliders', 'addedby_id')) {
                $table->unsignedBigInteger('addedby_id')->nullable()->after('order');
                $table->foreign('addedby_id')->references('id')->on('users')->onDelete('cascade');
            }
            if (! Schema::hasColumn('sliders', 'editedby_id')) {
                $table->unsignedBigInteger('editedby_id')->nullable()->after('addedby_id');
                $table->foreign('editedby_id')->references('id')->on('users')->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sliders', function (Blueprint $table) {
            $table->dropForeign(['offer_id']);
            $table->dropForeign(['addedby_id']);
            $table->dropForeign(['editedby_id']);
            $table->dropColumn(['title', 'title_two', 'type', 'offer_id', 'slug', 'status', 'order', 'addedby_id', 'editedby_id']);
        });
    }
};
