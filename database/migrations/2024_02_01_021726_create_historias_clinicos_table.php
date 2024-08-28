<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historias_clinicos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nro_historial_clinico')->nullable();
            $table->unsignedBigInteger('mascota_id');
            $table->unsignedBigInteger('tipo_historial_id');
           $table->string('anamensis',5000)->nullable();
           $table->string('actitud',155)->nullable();
           $table->string('tllc',155)->nullable();
           $table->string('conducta',155)->nullable();
           
            $table->string('esta_nutricional',55)->nullable();
            $table->string('mm',55)->nullable();
            $table->string('const_v_fc',55)->nullable();
            $table->string('const_v_fr',55)->nullable();
            $table->string('const_v_t',55)->nullable();
            $table->string('capa_piel',55)->nullable();
           
           
            $table->unsignedBigInteger('estudio_complementario_id')->nullable();
            $table->string('imagen_pdf_estudio_complementario')->nullable();
            $table->integer('peso_internacion')->nullable();
            $table->date('fecha_ingreso_internacion')->nullable();
            $table->string('imagen_pdf_ficha_clinica_cirugia')->nullable();
            $table->string('imagen_pdf_recomendaciones_operatorias')->nullable();
            $table->string('imagen_pdf_concentimiento_infomado')->nullable();
            $table->string('imagen_pdf_autorizacion_de_sedacion')->nullable();
            $table->string('informe_de_eutanacia')->nullable();
            $table->date('fecha_de_eutanacia')->nullable();
            
            $table->string('estado')->default('activo');
            
            $table->foreign('mascota_id')->references('id')->on('mascotas')->onDelete('cascade');
            $table->foreign('tipo_historial_id')->references('id')->on('tipo_historials')->onDelete('cascade');
            $table->foreign('estudio_complementario_id')->references('id')->on('estudios_complementarios')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historias_clinicos');
    }
};
