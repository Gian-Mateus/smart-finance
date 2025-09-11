<?php

namespace Database\Seeders;

use App\Models\Bank;
use App\Models\BanksAccount;
use Illuminate\Database\Seeder;

class BanksAccountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bank = Bank::where('name', 'COOPCENTRAL AILOS')->first();
        BanksAccount::create([
            'user_id' => 1,
            'bank_id' => $bank->id,
            'name' => 'Conta Principal',
        ]);
    }
}
