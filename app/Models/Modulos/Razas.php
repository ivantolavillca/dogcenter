<?php

namespace App\Models\Modulos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Razas extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'estado',
 
    ];
    public function razas_mascotas(){
        return $this->hasMany(Mascotas::class , 'id');
    }
}
