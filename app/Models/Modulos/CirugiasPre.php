<?php

namespace App\Models\Modulos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class CirugiasPre extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_producto',
        'cirugia_id',
        'detalle',
        'mg',
        'ml',
        'via',
        'hora',
        'observaciones',
        'tipo',
        'estado',
    ];
    public function cirugia_mascota(){
        return $this->belongsTo(Mascotas::class , 'id_mascota');
    }
    public function cirugia_usuario(){
        return $this->belongsTo(User::class , 'id_usuario');
    }
   
}
