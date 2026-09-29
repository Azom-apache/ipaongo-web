<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->text('site_title')->nullable();
            $table->text('domain_name')->nullable();
            $table->longText('address_1')->nullable();
            $table->longText('address_2')->nullable();
            $table->text('mobile')->nullable();
            $table->text('mobile_2')->nullable();
            $table->text('email')->nullable();
            $table->text('contact_mail')->nullable();
            $table->text('facebook')->nullable();
            $table->text('youtube')->nullable();
            $table->text('twitter')->nullable();
            $table->text('linkedin')->nullable();
            $table->text('map')->nullable();
            $table->text('logo')->nullable();
            $table->text('favicon')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
