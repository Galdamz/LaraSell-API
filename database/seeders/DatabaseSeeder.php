<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Role::factory()->create([
            'name' => 'Administrator',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@email.com',
            "role_id" => 1,
            "password" => bcrypt("12345678"),
        ]);
    }
}
