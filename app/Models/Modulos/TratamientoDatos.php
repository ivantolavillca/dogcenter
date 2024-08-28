<?php

namespace App\Models\Modulos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TratamientoDatos extends Model
{
    use HasFactory;
    protected $fillable = [
        'tratamiento_id',
        'hora',
        'psys_dv',
        'temperatura',
        'fc',
        'fr',
        'mm',
        'trc',
        'SoPO2',
       

 
    ];  
  
}
