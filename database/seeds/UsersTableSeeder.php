<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Ipao',
            'email' => 'admin@gmail.com',
            'mobile' => '01935900933',
            'password' => Hash::make('123456789'),
            'role' => 'owner',
        ]);
        DB::table('users')->insert([
            'name' => 'Living Stone BD',
            'email' => 'admin@livingstonebd.com',
            'mobile' => '01611900933',
            'password' => '$2y$10$01wfQlJj1XH1lEO/DJPqE.s4VkDb.JYvjZ/iJedo.NLle2Z2LKhJe',
            'role' => 'owner',
        ]);
    }
}
