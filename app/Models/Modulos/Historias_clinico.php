<?php

namespace App\Models\Modulos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Historias_clinico extends Model
{
    use HasFactory;

    protected $fillable = [
        'nro_historial_clinico',
        'mascota_id',
        'estudio_complementario_id',
        'edad',
        'temperatura_ingreso',
        'temperatura_salida',
        'peso_ingreso',
        'peso_salida',
        'examen_clinico',
        'actitud',
        'conducta',
        'esta_nutricional',
        'const_v_fc',
        'const_v_fr',
        'const_v_t',
        'capa_piel',
        'estado',
        'tipo_historial_id',
        'imagen_pdf_estudio_complementario',
        'informe_de_eutanacia',
        'fecha_de_eutanacia',
        'anamensis',
        'tllc',
        'mm',
        'Past',
        'Pad',
        'Pam',
        'Pulso',
        'Dht',
        'Peso',
        'motivo_atencion',
        'peso_internacion',
        'fecha_ingreso_internacion',
        'imagen_pdf_ficha_clinica_cirugia',
        'imagen_pdf_recomendaciones_operatorias',
        'imagen_pdf_concentimiento_infomado',
        'imagen_pdf_autorizacion_de_sedacion',
        'user_id',
        'recomendacion',
        'precio',
        'imagen_eutanacia',
        'diagnostico',
        'comentario_estudio',
        //diagnostico



    ];
    public function historial_clinico_mascotas(){
        return $this->belongsTo(Mascotas::class , 'mascota_id');
    }
    public function hitorialtipohistorial(){
        return $this->belongsTo(TipoHistorial::class , 'tipo_historial_id');
    }
    public function historial_clinico_tratamiento(){
        return $this->belongsTo(Mascotas::class , 'id');
    }
    public function historial_estudio(){
        return $this->belongsTo(EstudiosComplementarios::class , 'estudio_complementario_id');
    }
    public function historial_tratamientos(){
        return $this->hasMany(Tratamiento_historial_clinico::class , 'historial_id') ->where('estado', 'activo');
    }
    public function historial_tratamientos_internacion(){
        return $this->hasMany(TratamientosHistorial::class , 'historial_id');
    }
    public function historial_user(){
        return $this->belongsTo(User::class , 'user_id');
    }
    public function fotosestudio(){
        return $this->hasMany(FotosEstudio::class , 'historial_id')->where('estado','<>','eliminado');
    }
}
