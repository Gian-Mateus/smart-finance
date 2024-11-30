<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecurrenceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $periodicities = [
            'Diária',
            'Semanal',
            'Quinzenal',
            'Mensal',
            'Bimestral',
            'Trimestral',
            'Semestral',
            'Anual'
        ];

        foreach($periodicities as $p){
            RecurrenceType::create([
                'name' => $p
            ]);
        }
    }
}
