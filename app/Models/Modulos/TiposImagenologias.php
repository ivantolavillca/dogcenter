<?php

namespace App\Models\Modulos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiposImagenologias extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'estado',
 
    ];
    
    // tipos de imagenologia envia su id primaria a imagenologia (modelo padre)
    public function tiposima_ima(){
        return $this->hasMany(Imagenologia::class , 'id');
    }
}
