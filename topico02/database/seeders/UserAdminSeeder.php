<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         if (!User::where('email', 'admin@dev.test')->first())
            User::factory()->create([
                'name' => 'Admin',
                'email' => 'admin@dev.test',
                'is_admin' => true,
                // 'password'=>'789456123'
                'password' => env('ADMIN_PASSWORD', 'adminadmin')
            ]);
    }
}
