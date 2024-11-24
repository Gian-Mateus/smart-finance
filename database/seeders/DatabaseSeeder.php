<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\BankSeeder;
use Database\Seeders\CategoriesSeed;
use Database\Seeders\RecurrenceSeed;
use Database\Seeders\SubcategoriesSeed;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // User::create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        //     'password' => hash('1234', )
        // ]);

        $this->call([
                    CategoriesSeed::class,
                    SubcategoriesSeed::class,
                    RecurrenceSeed::class,
                    BankSeeder::class
                ]);

    }
}
