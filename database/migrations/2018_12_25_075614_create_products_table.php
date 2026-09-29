<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('title')->nullable();
            $table->string('code')->nullable();
            $table->integer('brand_id')->nullable();
            $table->boolean('hassize')->nullable()->default(true);
            $table->boolean('hascolor')->nullable()->default(true);
            $table->text('color')->nullable();
            $table->float('star')->nullable();
            $table->text('excerpt')->nullable();
            $table->longtext('description')->nullable();
            $table->string('slug')->nullable();
            $table->string('status')->nullable()->default(false);
            $table->boolean('hassizechart')->nullable()->default(false);
            $table->text('size_chart')->nullable();
            $table->string('image')->nullable();
            $table->string('type')->default('regular');
            $table->integer('total_qty')->nullable()->default(0);
            $table->float('regular_price')->nullable();
            $table->boolean('discount_type')->nullable()->default(false);
            $table->float('discount_amount')->nullable();
            $table->float('sale_price')->nullable();
            $table->boolean('hasdeliverydays')->nullable()->default(false);
            $table->string('deliverydays')->nullable();
            $table->string('order')->nullable()->default('1');
            $table->unsignedBigInteger('addedby_id')->nullable();
            $table->unsignedBigInteger('editedby_id')->nullable();
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('addedby_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('editedby_id')->references('id')->on('users')->onDelete('set null');
        });
        Schema::create('category_product', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('product_id');
            $table->primary(['category_id','product_id']);
            // category_id & product_id should not be repeated like 1 5
            // thats why both set as primary key aka unique
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
