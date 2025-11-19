<?php

namespace Database\Seeders;

use App\Models\Produto;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::factory()->create([
            'name'=>'Admin',
            'email'=>'admin@dev.test',
            'is_admin'=>true,
            // 'password'=>'789456123'
            'password'=>env('ADMIN_PASSWORD','adminadmin')
        ]);

        Produto::factory(20)->create();

        $this->call(RegiaoSeeder::class);

    }
}
