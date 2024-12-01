<?php

namespace Database\Seeders;

use App\Models\RecurrenceType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
