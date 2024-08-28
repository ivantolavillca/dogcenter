<?php

namespace App\Models\Modulos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'ci',
        'celular',
        'correo',
        'NIT',
        'estado',
    ];
     //  envia su id primaria a Compras (modelo padre)
     public function proveed_Compras()
     {
        return $this->hasMany(ComprasProductos::class , 'id');
    }
    public function prove_Com()
    {
       return $this->hasMany(Compras::class , 'id');
   }
}

