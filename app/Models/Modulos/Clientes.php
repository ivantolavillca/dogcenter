<?php

namespace App\Models\Modulos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre',
        'apellidos',
        'telefono',
        'ci',
        'expedido',
        'domicilio',
        'estado',
        'codigo',
        'correo',

    ];
    public function cliente_mascotas(){
        return $this->hasMany(Mascotas::class , 'cliente_id');
    }
    public function cliente_ventas(){
        return $this->hasMany(VentasProductos::class , 'cliente_id');
    }
  
}
