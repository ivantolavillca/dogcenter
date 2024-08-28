<?php

namespace App\Models\Modulos;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gastos extends Model
{
    use HasFactory;
    protected $table='descuentoscaja';
    protected $fillable = [
        
       
        'caja_id',
        'razon',
        'costo',
        'user_id',
        'estado',
       
       
        
       


    ];
    // public function internacion_mascota(){ tipo
    //     return $this->belongsTo(Mascotas::class , 'mascota_id');
    // }
    // public function internacion_medicamentos(){
    //     return $this->hasMany(MedicamentosInternacion::class , 'internacion_id')->where('estado','ACTIVO')->orderBy('id','desc');
    // }
    // public function internacion_comentarios(){
    //     return $this->hasMany   (ComentariosInternacion::class , 'internacion_id')->where('estado','ACTIVO')->orderBy('id','desc');
    // }
    public function usuario(){
        return $this->belongsTo(User::class , 'user_id');
    }
}
