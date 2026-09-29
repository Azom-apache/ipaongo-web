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
            $table->string('title')->nullable()->after('id');
            $table->string('title_two')->nullable()->after('title');
            $table->string('type')->nullable()->after('caption');
            $table->unsignedBigInteger('offer_id')->nullable()->after('type');
            $table->string('slug')->nullable()->after('image');
            $table->integer('status')->default(1)->after('slug');
            $table->integer('order')->default(1)->after('status');
            $table->unsignedBigInteger('addedby_id')->nullable()->after('order');
            $table->unsignedBigInteger('editedby_id')->nullable()->after('addedby_id');

            $table->foreign('offer_id')->references('id')->on('offers')->onDelete('cascade');
            $table->foreign('addedby_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('editedby_id')->references('id')->on('users')->onDelete('set null');
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
