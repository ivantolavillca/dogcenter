<?php

namespace App\Models\Modulos;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagenesInternacion extends Model
{
    use HasFactory;
    protected $table = 'imagenes_internaciones';
    protected $fillable = [

        'internacion_id',
        'imagen', 
       
        'estado',

    ];
    //  recibe los ides de sus papas
    public function internacion()
    {
        return $this->belongsTo(Internacion::class, 'internacion_id');
    }

}
