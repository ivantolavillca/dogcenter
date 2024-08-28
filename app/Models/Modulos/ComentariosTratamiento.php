<?php

namespace App\Models\Modulos;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComentariosTratamiento extends Model
{
    use HasFactory;
    protected $table='comentarios_tratamiento';
    protected $fillable = [
 
        'tratamiento_id',
        'comentario',
        'user_id',
       
    ];
     //  recibe los ides de sus papas
     public function tratamientos(){
        return $this->belongsTo(Tratamiento_historial_clinico::class , 'tratamiento_id');
    }
    public function user(){
        return $this->belongsTo(User::class , 'user_id');
    }
}
