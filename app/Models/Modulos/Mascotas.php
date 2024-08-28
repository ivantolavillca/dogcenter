<?php

namespace App\Models\Modulos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mascotas extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre',
        'especie_id',
        'raza_id',
        'sexo',
        'esterilizado',
        'edad_mascota',
        'cliente_id',
        'color_id',
        'estado', 
        'peso', 
        'imagen', 
 
    ];
    public function mascotas_clientes(){
        return $this->belongsTo(Clientes::class , 'cliente_id');
    }
    public function mascotas_especies(){
        return $this->belongsTo(Especies::class , 'especie_id');
    }
    public function mascotas_colores(){
        return $this->belongsTo(ColoresMascotas::class , 'color_id');
    }
    public function mascotas_razas(){
        return $this->belongsTo(Razas::class , 'raza_id');
    }
    public function mascotas_historial_clinico(){
        return $this->hasMany(Historias_clinico::class , 'mascota_id');
    }
    public function mascotas_historial_eutanacia(){
        return $this->hasMany(Historias_clinico::class , 'mascota_id')->where('tipo_historial_id',9)->where('estado','activo');
    }
    public function Mascota_Fichas(){
        return $this->hasMany(Fichas::class , 'mascota_id');
    }
    public function mascot_clie(){
        return $this->belongsTo(Clientes::class , 'cliente_id');
    }
    public function mascot_cirugia(){
        return $this->hasMany(Cirugias::class , 'mascota_id');
    }
    public function mascot_ventas(){
        return $this->hasMany(Ventas::class , 'mascota_id');
    }
}
