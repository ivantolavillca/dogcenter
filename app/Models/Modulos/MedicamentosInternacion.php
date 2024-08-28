<?php

namespace App\Models\Modulos;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicamentosInternacion extends Model
{
    use HasFactory;
    protected $table='medicamentos_internacion';
    protected $fillable = [
 
        'internacion_id',
        'Medicamento',
        'dosis_mg',
        'dosis_ml',
        'via',
        'administrado', 
        'hora',
        'estado',
        'precio',
        'user_id'
    ];
     //  recibe los ides de sus papas
     public function internacions(){
        return $this->belongsTo(Internacion::class , 'internacion_id');
    }
     public function user(){
        return $this->belongsTo(User::class , 'user_id');
    }
}
