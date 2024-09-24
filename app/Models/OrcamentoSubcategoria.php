<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrcamentoSubcategoria extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome',
        'categoria_id'
    ];
}
