<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BanksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banks = [
            'Nubank',
            'Viacred',
            'Itaú',
            'Bradesco'
        ];

        foreach($banks as $bank){
            Bank::create([
                'name' => $bank,
            ]);

        }
    }
}
