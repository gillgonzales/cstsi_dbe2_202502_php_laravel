<?php

namespace Database\Seeders;

use App\Models\Fornecedor;
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

        // Produto::factory(20)->create();

        $this->call([
            UserAdminSeeder::class,
            RegiaoSeeder::class,
            EstadoSeeder::class
        ]);

        Fornecedor::factory(100)
            // ->has(Produto::factory(10))
            ->hasProdutos(10)
            ->create();

        $this->call([
				PromocaoSeeder::class,
				PromocaoProdutoSeeder::class
        ]);
    }
}
