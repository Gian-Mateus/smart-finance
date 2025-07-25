<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BudgetsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $budgetCategories = [
            'Receitas' => 100000,
            'Investimentos' => 100000,
            'Moradia' => 100000,
            'Alimentação' => 100000,
            'Transporte' => 100000,
            'Educação' => 100000,
            'Lazer' => 100000,
            'Saúde & Beleza' => 100000,
            'Serviços Financeiros' => 100000,
            'Vestuário' => 100000,
            'Doações & Presentes' => 100000,
        ];

        $loop = 1;
        foreach ($budgetCategories as $categoryName => $value) {
            \App\Models\Budget::create([
                'user_id' => 1, // User 1
                'budgetable_id' => $loop,
                'budgetable_type' => 'App\Models\Category',
                'recurrence' => 'monthly',
                'target_value' => $value,
                'types' => 'budget',
                'start_date' => now(),
                'end_date' => now()->addYear(),
            ]);
            $loop++;
        }
    }
}
