<?php

namespace App\Models\Modulos;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cobros extends Model
{
    use HasFactory;
    protected $table='cobros';
    protected $fillable = [
        
       
        'caja_id',
        'tipo',
        'costo',
        'user_id',
        'estado',
        'cliente_id',
        'motivo',
       
        
       


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
    public function cliente(){
        return $this->belongsTo(Clientes::class , 'cliente_id');
    }
}
