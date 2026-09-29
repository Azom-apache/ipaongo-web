<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            
            $table->id();
            $table->text('title')->nullable();
            $table->text('image')->nullable();
            $table->longText('description')->nullable();
            $table->unsignedBigInteger('profile_id')->nullable();
            $table->unsignedBigInteger('verify_by')->nullable();
            $table->integer('status')->nullable();

            $table->timestamps();

            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('set null');
            $table->foreign('verify_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     *  @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
