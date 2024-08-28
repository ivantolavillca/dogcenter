<?php

namespace App\Models\Modulos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentasProductos extends Model
{
    use HasFactory;
    protected $fillable = [
        'producto_id',
        'id_venta',
        'descripcion',
        'cantidad',
        'precio',
        'estado',
    ];
   
    public function produc_ventas(){
        return $this->belongsTo(Productos::class , 'producto_id');
    }
}
