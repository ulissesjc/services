<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'type' => 'admin',
                'name' => 'Usuário1',
                'username' => "user1",
                'password' => Hash::make("senhaNova"),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'type' => 'common',
                'name' => 'Usuário2',
                'username' => "user2",
                'password' => Hash::make("senhaNova"),
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
