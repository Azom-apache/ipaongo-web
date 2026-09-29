<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->text('title')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->integer('level')->unsigned()->nullable()->default(1);
            $table->boolean('haschild')->nullable()->default(false);
            $table->boolean('hasgrand')->nullable()->default(false);
            $table->text('excerpt')->nullable();
            $table->longtext('description')->nullable();
            $table->string('image')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->string('order')->default('1');
            $table->integer('status')->default('1');  //0 disabled 1 enabled 2 is shown in homepage
            $table->unsignedBigInteger('addedby_id')->nullable();
            $table->unsignedBigInteger('editedby_id')->nullable();
            $table->timestamps();
            $table->foreign('parent_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('addedby_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('editedby_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
