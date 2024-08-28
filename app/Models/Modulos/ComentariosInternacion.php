<?php

namespace App\Models\Modulos;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComentariosInternacion extends Model
{
    use HasFactory;
    protected $table='comentarios_internacion';
    protected $fillable = [
 
        'internacion_id',
        'comentario',
        'user_id',
        'fc',
        'fr',
        'tmm',
        'tlmc',
        'pulso',
       
    ];
     //  recibe los ides de sus papas
     public function internacions(){
        return $this->belongsTo(Internacion::class , 'internacion_id');
    }
    public function user(){
        return $this->belongsTo(User::class , 'user_id');
    }
}
