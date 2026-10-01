<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('areas')) {
Schema::create('areas', function (Blueprint $table) {
            $table->id();
            $table->text('area')->nullable();
            $table->unsignedBigInteger('district_id')->nullable();

            $table->timestamps();
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('set null');
        });
        }    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('areas');
    }
}
