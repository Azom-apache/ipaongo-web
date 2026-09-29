<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBloodDonersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blood_doners', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->string('mobile', 20);
            $table->string('email', 70);
            $table->string('blood_group', 20);
            $table->string('area', 55);
            $table->string('gender', 20);
            $table->string('dob', 20)->nullable();
            $table->text('image')->nullable();
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
        Schema::dropIfExists('blood_doners');
    }
}
