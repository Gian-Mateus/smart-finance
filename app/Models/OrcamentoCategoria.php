<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrcamentoCategoria extends Model
{
    use HasFactory;
    protected $fillable = [
        'categoria_id',
        'valor_orcado',
        'mes_referencia'
    ];
}
