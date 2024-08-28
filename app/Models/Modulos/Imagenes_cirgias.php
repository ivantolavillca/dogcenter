<?php

namespace App\Models\Modulos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagenes_cirgias extends Model
{

    use HasFactory;
    protected $fillable = [
       
        'cirugia_id',
        'url',
        'descripcion',
        'estado',
    ];
    public function cirugia_imagens(){
        return $this->belongsTo(Cirugias::class , 'cirugia_id');
    }
 

}
