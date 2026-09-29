<?php

use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
        	"domain_name" => env("APP_URL"),
        	"site_title" => env("APP_NAME")
        ]);
    }
}
