<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
