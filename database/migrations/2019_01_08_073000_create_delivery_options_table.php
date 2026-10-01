<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('delivery_options')) {
Schema::create('delivery_options', function (Blueprint $table) {
            $table->id();
            $table->string('region')->nullable();
            $table->string('district')->nullable();
            $table->string('area')->nullable();
            $table->float('cost')->nullable();
            $table->string('delivery_days');
            $table->boolean('cash_on_delivery');
            $table->string('order')->default('1');
            $table->unsignedBigInteger('addedby_id')->nullable();
            $table->unsignedBigInteger('editedby_id')->nullable();
            $table->timestamps();
            $table->foreign('addedby_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('editedby_id')->references('id')->on('users')->onDelete('set null');
        });
        }    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivery_options');
    }
}
