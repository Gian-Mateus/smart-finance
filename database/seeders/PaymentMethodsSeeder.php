<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PaymentMethodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paymentsMethods = [
            ['name' => 'Dinheiro'],
            ['name' => 'Cheque'],
            ['name' => 'Pix'],
            ['name' => 'Boleto'],
            ['name' => 'Cartão de Crédito'],
            ['name' => 'Cartão de Débito'],
            ['name' => 'Transferência Bancária'],
        ];

        foreach ($paymentsMethods as $method) {
            \App\Models\PaymentMethod::create($method);
        }
    }
}
