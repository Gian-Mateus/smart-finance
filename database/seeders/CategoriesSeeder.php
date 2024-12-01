<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Categories;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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

        foreach($categories as $cat){
            Categories::create([
                'user_id' => User::first()->id,
                'name' => $cat,
            ]);
        }
    }
}
