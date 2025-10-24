<?php

namespace Database\Seeders;

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
        // User::factory(10)->create();

        User::create([
            'name' => 'Test User',
            'email' => 'gian.m.silver@gmail.com',
            'password' => bcrypt('123456'),
        ]);

        $this->call([
            CategoriesSeeder::class,
            SubcategoriesSeeder::class,
            RecurrenceTypeSeeder::class,
            BanksSeeder::class,
            IconsSeeder::class,
            PaymentMethodsSeeder::class,
            BudgetsSeeder::class,
            BanksAccountsSeeder::class,
        ]);
    }
}
