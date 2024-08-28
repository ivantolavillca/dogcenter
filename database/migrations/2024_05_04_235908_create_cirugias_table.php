<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('cirugias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_mascota')->nullable();
            $table->unsignedBigInteger('id_usuario')->nullable();
            $table->String('descripcion', 300);
            $table->String('asa', 10);
            $table->decimal('total', $precision = 12, $scale = 2)->default(0);
            $table->String('estado', 20)->default('activo');
            $table->foreign('id_mascota')->references('id')->on('mascotas')->onDelete('cascade');
            $table->foreign('id_usuario')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cirugias');
    }
};
