<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(SettingSeeder::class);
        DB::table('users')->insert([
            "name" => "Admin",
            "email" => "admin@gmail.com",
            "password" => Hash::make("123456789"),
            "status" => 0,
            "role_id" => 1

        ]);
    }
}
