<?php

namespace App\Models\Modulos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagenologia extends Model
{
    use HasFactory;
    
    // recibe la foranea de tiposdeimagenilogia  (modelo hijo)
    public function imagenolo_tipos()
    {
        return $this->belongsTo(TiposImagenologias::class , 'tipo_imagen_id');
    }
}


