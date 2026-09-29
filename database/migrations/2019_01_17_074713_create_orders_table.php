<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('coupon_id')->nullable();
            $table->string('invoice_no')->nullable();
            $table->integer('total_product')->unsigned()->nullable();
            $table->integer('total_qty')->unsigned()->nullable();
            $table->float('total_price')->unsigned()->nullable();
            $table->text('email')->nullable();
            $table->text('name')->nullable();
            $table->text('address')->nullable();
            $table->text('currency_type')->nullable();
            $table->text('delivery_type')->nullable();
            $table->text('postal_code')->nullable();
            $table->longtext('message')->nullable();
            $table->text('mobile')->nullable();
            $table->text('payment_method')->nullable();
            $table->integer('delivery_options_id')->nullable()->default(1);
            $table->boolean('has_shipping_cost')->nullable()->default(true);
            $table->float('shipping_cost')->nullable();
            $table->boolean('has_vat')->nullable()->default(false);
            $table->float('vat')->nullable();
            $table->float('final_price')->nullable();
            $table->unsignedBigInteger('orderby_id')->nullable();
            $table->unsignedBigInteger('editedby_id')->nullable();
            $table->string('status')->nullable()->default('pending');
            $table->timestamp('pending_at')->nullable();
            $table->timestamp('confirmed_at')->nullable();
            $table->timestamp('shipped_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->timestamp('returned_at')->nullable();
            $table->timestamps();
            $table->foreign('orderby_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('orders');
    }
}
