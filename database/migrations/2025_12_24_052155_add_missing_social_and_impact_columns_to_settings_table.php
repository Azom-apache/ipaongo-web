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
        if (! Schema::hasTable('settings')) {
            return;
        }

        $columns = [
            'instagram',
            'welcome_message',
            'welcome_title',
            'successfull_project',
            'people_impact',
            'money_donate',
            'total_volunteer',
            'food',
            'cloth',
            'other',
        ];

        $missing = array_filter($columns, fn ($column) => ! Schema::hasColumn('settings', $column));
        if ($missing === []) {
            return;
        }

        Schema::table('settings', function (Blueprint $table) use ($columns) {
            foreach ($columns as $column) {
                if (! Schema::hasColumn('settings', $column)) {
                    $table->text($column)->nullable();
                }
            }
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
