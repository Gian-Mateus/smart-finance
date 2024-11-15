<?php

namespace Database\Seeders;
use App\Models\Periodicities;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeriodicitiesSeed extends Seeder
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
            Periodicities::create([
                'name' => $p
            ]);
        }
    }
}
