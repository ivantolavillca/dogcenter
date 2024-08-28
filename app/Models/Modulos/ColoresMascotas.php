<?php

namespace App\Models\Modulos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColoresMascotas extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'estado',
 
    ];
    public function especies_mascotas(){
        return $this->hasMany(Mascotas::class , 'id');
    }
}
