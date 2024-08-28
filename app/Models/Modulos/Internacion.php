<?php

namespace App\Models\Modulos;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Internacion extends Model
{
    use HasFactory;
    protected $table='internacion';
    protected $fillable = [
        
        'mascota_id',
        'estado',
        
        'user_id',
        'precio',
        
       


    ];
    public function internacion_mascota(){
        return $this->belongsTo(Mascotas::class , 'mascota_id');
    }
    public function internacion_medicamentos(){
        return $this->hasMany(MedicamentosInternacion::class , 'internacion_id')->where('estado','ACTIVO')->orderBy('id','desc');
    }
    public function internacion_comentarios(){
        return $this->hasMany   (ComentariosInternacion::class , 'internacion_id')->where('estado','ACTIVO')->orderBy('id','desc');
    }
    public function intenacion_usuario(){
        return $this->belongsTo(User::class , 'user_id');
    }
}
