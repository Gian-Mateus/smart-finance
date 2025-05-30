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
            'Receitas' => 10000000,
            'Investimentos' => 10000000,
            'Moradia' => 10000000,
            'Alimentação' => 10000000,
            'Transporte' => 10000000,
            'Educação' => 10000000,
            'Lazer' => 10000000,
            'Saúde & Beleza' => 10000000,
            'Serviços Financeiros' => 10000000,
            'Vestuário' => 10000000,
            'Doações & Presentes' => 10000000,
        ];

        foreach ($budgetCategories as $categoryName => $targetValue) {
            \App\Models\Budget::create([
                'user_id' => 1, // Assuming user_id 1 exists
                'category_id' => \App\Models\Category::where('name', $categoryName)->first()->id,
                'subcategory_id' => null, // Assuming no subcategory for now
                'recurrence' => null, // Assuming no recurrence type for now
                'target_value' => $targetValue,
                'types' => 'budget',
                'start_date' => now(),
                'end_date' => now()->addYear(),
            ]);
        }
    }
}
