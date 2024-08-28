<?php

namespace App\Models\Modulos;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotosEstudio extends Model
{
    use HasFactory;
    protected $table = 'fotos_Historial_estudios';
    protected $fillable = [

        'historial_id',
        'imagen',
        'user_id',
        'estado',

    ];
    //  recibe los ides de sus papas
    public function historial()
    {
        return $this->belongsTo(Historias_clinico::class, 'historial_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
