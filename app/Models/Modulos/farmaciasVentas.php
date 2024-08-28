<?php

namespace App\Models\Modulos;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class farmaciasVentas extends Model
{
    use HasFactory;
    protected $fillable = [
        'mascota_id',
        'farmacia_id',
        'doctor_id',
        'unidad',
        'cantidad',
        'precio',
    ];
     //  envia su id primaria a Compras (modelo padre)
   
     public function productos_famaciaven(){
        return $this->belongsTo(farmacias::class , 'farmacia_id');
    }
    public function farmacia_mascota(){
        return $this->belongsTo(Mascotas::class , 'mascota_id');
    }
    public function farmacia_doctor(){
        return $this->belongsTo(User::class , 'doctor_id');
    }
}
