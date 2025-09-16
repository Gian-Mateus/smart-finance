<?php

namespace App;

use Illuminate\Support\Str;

trait MoneyBRL
{
    /**
     * Formata um valor para exibição no formato de moeda brasileira
     * Assume que o valor já está na escala correta (não divide novamente)
     */
    public function showBRL($value)
    {
        return number_format($this->toDecimal($value), 2, ',', '.');
    }

    /**
     * Converte um valor decimal para inteiro (multiplicando por 10000)
     */
    public function toInteger($value)
    {
        $value = Str::replace([',', '.'], '', $value);
        $value = intval($value);

        return $value * 100;
    }

    /**
     * Converte um valor inteiro para decimal (dividindo por 10000)
     */
    public function toDecimal($value)
    {
        return $value / 10000;
    }

    public function floatToInteger(float $value): int
    {

        $scaledValue = $value * 10000;

        $roundedValue = intval($scaledValue);

        return $roundedValue;
    }
}
