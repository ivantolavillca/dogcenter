<?php

namespace App\Models\Modulos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compras extends Model
{
    use HasFactory;
    protected $fillable = [
 
        'proveedor_id',
        'usuario_id',
        'descripcion',
        'total',
        'estado'
    ];
    
    public function preedo_compras(){
        return $this->belongsTo(Proveedor::class , 'proveedor_id');
    }
}
