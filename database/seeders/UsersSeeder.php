<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            "name" => "admin",
            "email" => "admin@fitlife.com",
            "phone" => "0599916672",
            "type" => "admin",
            "gender" => "male",
            "status" => "active",
            "email_verified_at" => now(),
            "password" => Hash::make("12345678"),
            "created_at" => now(),
        ]);
    }
}
