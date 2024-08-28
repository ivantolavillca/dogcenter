<?php

namespace App\Models\Modulos;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicamentosTratamiento extends Model
{
    use HasFactory;
    protected $table='medicamentos_tratamiento';
    protected $fillable = [
 
        'tratamiento_id',
        'Medicamento',
        'dosis_mg',
        'dosis_ml',
        'comprimido',
        'via',
        'administrado', 
        'hora',
        'estado',
        'precio',
        'user_id'
    ];
     //  recibe los ides de sus papas
     public function tratamientos(){
        return $this->belongsTo(Tratamiento_historial_clinico::class , 'tratamiento_id');
    }
     public function user(){
        return $this->belongsTo(User::class , 'user_id');
    }
}
