<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('imagenes_cirgias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cirugia_id')->nullable();
            $table->String('url', 300)->nullable();
            $table->String('descripcion', 300)->nullable();
            $table->String('estado', 20)->default('activo');
            $table->foreign('cirugia_id')->references('id')->on('cirugias')->onDelete('cascade');
            $table->timestamps();
    
        });
    }

  
    public function down()
    {
        Schema::dropIfExists('imagenes_cirgias');
    }
};
