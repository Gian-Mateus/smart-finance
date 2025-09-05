<?php

namespace Database\Seeders;

use App\Models\RecurrenceType;
use Illuminate\Database\Seeder;

class RecurrenceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RecurrenceType::create([
            'name' => 'de 45 em 45 dias',
            'type' => 'custom',
            'interval' => 45,
            'user_id' => 1,
        ]);

        RecurrenceType::create([
            'name' => 'Diário',
            'type' => 'daily',
            'user_id' => 1,
        ]);

        RecurrenceType::create([
            'name' => 'Mensal',
            'type' => 'monthly',
            'user_id' => 1,
        ]);

        RecurrenceType::create([
            'name' => 'Semanal',
            'type' => 'weekly',
            'user_id' => 1,
        ]);

        RecurrenceType::create([
            'name' => 'Anual',
            'type' => 'yearly',
            'user_id' => 1,
        ]);
    }
}
