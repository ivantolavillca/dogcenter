<?php

namespace App\Models\Modulos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoHistorial extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'estado',
 
    ];
    public function thistori_historiales()
    {
        return $this->hasMany(Historias_clinico::class , 'id');
    }
    
}
