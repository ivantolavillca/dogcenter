<?php

namespace App\Models\Modulos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    use HasFactory;
    protected $fillable = [
 
        'cliente_id',
        'usuario_id',
        'descripcion',
        'total',
        'estado'
    ];
     //  recibe los ides de sus papas
     public function cliente_ventas(){
        return $this->belongsTo(Clientes::class , 'cliente_id');
    }
    public function mascota_ventas(){
        return $this->belongsTo(Mascotas::class , 'cliente_id');
    }
    public function ventas_realizadas(){
        return $this->hasMany(VentasProductos::class , 'id_venta');
    }
}
 