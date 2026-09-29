<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->text('name')->nullable();
            $table->text('image')->nullable();
            $table->text('designation')->nullable();
            $table->text('mobile')->nullable();
            $table->text('email')->nullable();
            $table->text('address')->nullable();
            $table->text('bio_graphy')->nullable();
            $table->integer('position')->nullabe();
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
        Schema::dropIfExists('members');
    }
}
