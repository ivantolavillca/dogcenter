<?php

namespace App\Models\Modulos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Cirugias extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_mascota',
        'id_usuario',
        'descripcion',
        'asa',  
        'total',
        'peso',
        'estado',

            
    ];
    public function cirugia_mascota(){
        return $this->belongsTo(Mascotas::class , 'id_mascota');
    }


    public function cirugia_usuario(){
        return $this->belongsTo(User::class , 'id_usuario');
    }
    public function cirugia_datos1()
    {
        return $this->hasMany(CirugiasDatos::class, 'cirugia_id')->where('total', 1)->where('estado', 'activo')->orderBy('id', 'desc');
    }
    public function cirugia_datos2()
    {
        return $this->hasMany(CirugiasDatos::class, 'cirugia_id')->where('total', 2)->where('estado', 'activo')->orderBy('id', 'desc');
    }
    public function cirugia_datos3()
    {
        return $this->hasMany(CirugiasDatos::class, 'cirugia_id')->where('total', 3)->where('estado', 'activo')->orderBy('id', 'desc');
    }
    public function cirugia_pres1()
    {
        return $this->hasMany(CirugiasPre::class, 'cirugia_id')->where('tipo', 1)->where('estado', 'activo')->orderBy('id', 'desc');
    }
    public function cirugia_pre2()
    {
        return $this->hasMany(CirugiasPre::class, 'cirugia_id')->where('tipo', 2)->where('estado', 'activo')->orderBy('id', 'desc');
    }
    public function cirugia_pre3()
    {
        return $this->hasMany(CirugiasPre::class, 'cirugia_id')->where('tipo', 3)->where('estado', 'activo')->orderBy('id', 'desc');
    }
}
