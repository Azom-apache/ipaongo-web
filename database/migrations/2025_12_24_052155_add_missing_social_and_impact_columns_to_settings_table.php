<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->text('instagram')->nullable()->after('map');
            $table->text('welcome_message')->nullable()->after('favicon');
            $table->text('welcome_title')->nullable()->after('welcome_message');
            $table->text('successfull_project')->nullable()->after('welcome_title');
            $table->text('people_impact')->nullable()->after('successfull_project');
            $table->text('money_donate')->nullable()->after('people_impact');
            $table->text('total_volunteer')->nullable()->after('money_donate');
            $table->text('food')->nullable()->after('total_volunteer');
            $table->text('cloth')->nullable()->after('food');
            $table->text('other')->nullable()->after('cloth');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
                'instagram',
                'welcome_message',
                'welcome_title',
                'successfull_project',
                'people_impact',
                'money_donate',
                'total_volunteer',
                'food',
                'cloth',
                'other'
            ]);
        });
    }
};
