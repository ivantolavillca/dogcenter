<?php

namespace App\Models\Modulos;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tratamiento_historial_clinico extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'historial_id',
        'precio',
        'estado',
        'user_id',

    ];
    public function tratamiento_historial_clinico(){
        return $this->belongsTo(Historias_clinico::class , 'historial_id');
    }
    public function tratamiento_medicamentos(){
        return $this->hasMany(MedicamentosTratamiento::class , 'tratamiento_id')->where('estado','ACTIVO')->orderBy('id','desc');
    }
    public function tratamiento_comentarios(){
        return $this->hasMany(ComentariosTratamiento::class , 'tratamiento_id')->where('estado','ACTIVO')->orderBy('id','desc');
    }
    public function tratamiento_doctor(){
        return $this->belongsTo(User::class , 'user_id');
    }
}
