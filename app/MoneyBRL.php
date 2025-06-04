<?php

namespace App;

trait MoneyBRL
{
    /**
     * Formata um valor para exibição no formato de moeda brasileira
     * Assume que o valor já está na escala correta (não divide novamente)
     */
    public function showBRL($value)
    {
        // Verifica se o valor é numérico
        if (!is_numeric($value)) {
            return;
        }
        
        // Formata o valor para o padrão brasileiro
        $formattedValue = number_format($value, 2, ',', '.');

        // Retorna o valor formatado
        return $formattedValue;
    }
    
    /**
     * Converte um valor decimal para inteiro (multiplicando por 10000)
     */
    public function toInteger($value)
    {
        if (!is_numeric($value)) {
            return 0;
        }
        
        return (int) round($value * 10000);
    }

    /**
     * Converte um valor inteiro para decimal (dividindo por 10000)
     */
    public function toDecimal($value)
    {
        if (!is_numeric($value)) {
            return 0;
        }
        
        return $value / 10000;
    }
}
