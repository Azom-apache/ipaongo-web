<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('askby_id')->nullable();
            $table->unsignedBigInteger('ansby_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->text('question')->nullable();
            $table->text('answer')->nullable();
            $table->boolean('status')->nullable()->default(false);
            $table->unsignedBigInteger('editedby_id')->nullable();
            $table->timestamps();
            $table->foreign('askby_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ansby_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('editedby_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('question_answers');
    }
}
