<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeed extends Seeder
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
                'name' => $cat,
            ]);
        }
    }
}
