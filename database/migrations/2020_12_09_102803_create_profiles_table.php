<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('profiles')) {
Schema::create('profiles', function (Blueprint $table) {
           
            $table->id();
            $table->text('name')->nullable();
            $table->text('batch')->nullable();
            $table->text('company')->nullable();
			$table->string('position')->nullable();
			$table->string('business_area')->nullable();
			$table->string('no_of_employee')->nullable();
            $table->text('blood_group')->nullable();
            $table->text('blood_donor')->nullable();
            $table->string('gender')->nullable();
            $table->string('birth_date')->nullable();
			$table->text('about_you')->nullable();
			$table->text('about_business')->nullable();
			$table->text('address')->nullable();
			$table->string('district')->nullable();
			$table->string('country')->nullable();
			$table->string('nationality')->nullable();
            $table->string('mobile')->nullable();
            $table->text('fb_link')->nullable();
            $table->string('email')->nullable();
            $table->text('password')->nullable();
            $table->text('responsibilities')->nullable();
            $table->text('volunteer')->nullable();
            $table->text('entrepreneur')->nullable();
            $table->text('image')->nullable();
            $table->integer('status')->default(1);
			$table->timestamps();
        });
        }    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
