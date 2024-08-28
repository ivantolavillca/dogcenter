<?php

namespace App\Models\Modulos;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desparacitaciones extends Model
{
    use HasFactory;
    protected $table='control_desparasitaciones';
    protected $fillable = [
 
        'mascota_id',
        'fecha',
        'edad',
        'producto_id',
        'proxima_fecha',
        'veterinario', 
        'user_id',
        'peso',
        'estado', 
        'precio',
        'id_producto2'
         
    ];
     //  recibe los ides de sus papas
     public function desparacitaciones_mascota(){
        return $this->belongsTo(Mascotas::class , 'mascota_id');
    }
     public function desparacitaciones_veterinario(){
        return $this->belongsTo(User::class , 'veterinario');
    }
     public function desparacitaciones_usuario_creacion(){
        return $this->belongsTo(User::class , 'user_id');
    }
    public function desparacitaciones_producto(){
        return $this->belongsTo(Productos::class , 'producto_id');
    }
}
