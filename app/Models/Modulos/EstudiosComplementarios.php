<?php

namespace App\Models\Modulos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstudiosComplementarios extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'descripcion',
        'estado',
 
    ];
    //  envia su id primaria a Historias_clinico (modelo padre)
    public function estudios_(){
        return $this->hasMany(Historias_clinico::class , 'id');
    }
}
