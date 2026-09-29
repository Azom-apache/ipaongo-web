<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->nullable();
            $table->timestamps();
        });

        Schema::create('product_tag', function (Blueprint $table) {
            $table->integer('product_id');
            $table->integer('tag_id');
            $table->primary(['product_id','tag_id']);
            // product_id & tag_id should not be repeated like 1 5
            // thats why both set as primary key aka unique
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags');
        Schema::dropIfExists('product_tag');
    }
}
