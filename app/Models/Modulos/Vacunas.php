<?php

namespace App\Models\Modulos;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacunas extends Model
{
    use HasFactory;
    protected $table='vacunas_de_mascotas';
    protected $fillable = [
 
        'mascota_id',
        'fecha',
        'edad',
        'vacuna_aplicada',
        'proxima_fecha',
        'veterinario', 
        'user_id',
        'precio',
        'FC',
        'FR',
        'T',
        'TLLC',
        'PESO',
        'MM',
        'recomendacion',
        'anamensis',
        'estado'
    ];
     //  recibe los ides de sus papas
     public function vacuna_mascota(){
        return $this->belongsTo(Mascotas::class , 'mascota_id');
    }
     public function vacuna_veterinario(){
        return $this->belongsTo(User::class , 'veterinario');
    }
     public function vacuna_usuario_creacion(){
        return $this->belongsTo(User::class , 'user_id');
    }
}
