<?php

namespace App\Models\Modulos;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


//use App\Events\FichaStatusUpdated;
class Fichas extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_cliente',
       // 'nombre_cli',
        'id_usuario',
       // 'usuario',
        'numeracion',
        'estado',
    ];
    //  recibe los ides de sus papas
    public function ficha_mascota(){
        return $this->belongsTo(Mascotas::class , 'id_cliente');
    }
    public function ficha_usuario(){
        return $this->belongsTo(User::class , 'id_usuario');
    }
 
}
