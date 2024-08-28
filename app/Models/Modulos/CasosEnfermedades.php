<?php

namespace App\Models\Modulos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CasosEnfermedades extends Model
{
    use HasFactory;
    protected $fillable = [
        'descripcion',
        'estado',
    ];
     //  envia su id primaria a Compras (modelo padre)
     public function enfermedad_Ficha()
     {
        return $this->hasMany(Fichas::class , 'id');
    }
}
