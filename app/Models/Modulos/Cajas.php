<?php

namespace App\Models\Modulos;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cajas extends Model
{
    use HasFactory;
    protected $table='cajas';
    protected $fillable = [
        
       
        'estado',
        
        'encargado_id',
        
       


    ];
    // public function internacion_mascota(){
    //     return $this->belongsTo(Mascotas::class , 'mascota_id');
    // }
    // public function internacion_medicamentos(){
    //     return $this->hasMany(MedicamentosInternacion::class , 'internacion_id')->where('estado','ACTIVO')->orderBy('id','desc');
    // }
    public function cobros(){
        return $this->hasMany   (Cobros::class , 'caja_id')->where('estado','activo')->orderBy('id','desc');
    } public function descuentos(){
        return $this->hasMany   (Gastos::class , 'caja_id')->where('estado','activo')->orderBy('id','desc');
    }
    public function usuario(){
        return $this->belongsTo(User::class , 'encargado_id');
    }
}
