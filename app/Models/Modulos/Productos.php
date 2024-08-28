<?php

namespace App\Models\Modulos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'descripcion',
        'imagen',
        'cantidad_inicial',
        'stock',
        'precio',
        'unidad_de_medida',
        'estado',
    ];
     //  envia su id primaria a Compras (modelo padre)
     public function productos_Compras()
     {
        return $this->hasMany(ComprasProductos::class , 'id');
     }
}
