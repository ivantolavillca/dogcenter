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
        Schema::create('mascotas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',55);
            $table->unsignedBigInteger('especie_id');
            $table->unsignedBigInteger('raza_id');
            $table->unsignedBigInteger('color_id');
            $table->string('sexo',55);
            $table->string('esterilizado',55);
          
            $table->double('peso');
            $table->string('edad_mascota'); 
            $table->unsignedBigInteger('cliente_id');
            $table->string('estado')->default('activo');
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
            $table->foreign('especie_id')->references('id')->on('especies')->onDelete('cascade');
            $table->foreign('raza_id')->references('id')->on('razas')->onDelete('cascade');
            $table->foreign('color_id')->references('id')->on('colores_mascotas')->onDelete('cascade');
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
        Schema::dropIfExists('mascotas');
    }
};
