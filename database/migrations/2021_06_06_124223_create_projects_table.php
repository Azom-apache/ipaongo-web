<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('projects')) {
Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->integer('parent')->default(0);
            $table->string('title', 255);
            $table->text('description');
            $table->string('image', 255)->nullable();
            $table->integer('status');
            $table->integer('order')->default(0);
            $table->string('create_id')->nullable();
            $table->string('update_id')->nullable();
            $table->timestamps();
        });
        }    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
