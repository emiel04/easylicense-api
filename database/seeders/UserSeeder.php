<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         User::factory()->create([
             'name' => 'Admin user',
             'email' => 'admin@easylicense.be',
             'admin' => true
         ]);
        User::factory()->create([
            'name' => 'User user',
            'email' => 'user@easylicense.be',
        ]);
    }
}
