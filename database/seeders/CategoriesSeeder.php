<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Receitas',
            'Investimentos',
            'Moradia',
            'Alimentação',
            'Transporte',
            'Educação',
            'Lazer',
            'Saúde & Beleza',
            'Serviços Financeiros',
            'Vestuário',
            'Doações & Presentes',
            'Animal de Estimação',
            'Outras Despesas',
        ];

        foreach ($categories as $cat) {
            Category::create([
                'user_id' => User::first()->id,
                'name' => $cat,
            ]);
        }
    }
}
