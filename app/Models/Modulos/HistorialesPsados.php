<?php

namespace App\Models\Modulos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialesPsados extends Model
{
    use HasFactory;
    protected $fillable = [
 
        'id_mascota',
        'descripcion',
        'urlimagen',
        'total',
        'estado'
    ];
    
    public function preedo_compras(){
        return $this->belongsTo(Proveedor::class , 'proveedor_id');
    }


}
