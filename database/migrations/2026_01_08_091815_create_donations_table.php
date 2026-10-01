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
        if (! Schema::hasTable('donations')) {
Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id')->nullable();
            $table->unsignedBigInteger('subcat_id')->nullable();
            $table->unsignedBigInteger('subsubcat_id')->nullable();
            $table->string('project_name');
            $table->string('subcat_name')->nullable();
            $table->string('subsubcat_name')->nullable();
            $table->decimal('budget', 15, 2)->nullable();
            $table->integer('quantity')->nullable();
            $table->decimal('usd', 15, 2)->nullable();
            $table->string('donor_name');
            $table->text('address');
            $table->string('country');
            $table->string('email');
            $table->string('contact');
            $table->string('image')->nullable();
            $table->timestamp('donated_at');
            $table->timestamps();

            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('subcat_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('subsubcat_id')->references('id')->on('projects')->onDelete('cascade');
        });
        }    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
