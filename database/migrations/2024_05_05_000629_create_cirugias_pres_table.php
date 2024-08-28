<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('cirugias_pres', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_producto')->nullable();
            $table->unsignedBigInteger('cirugia_id')->nullable();
            $table->String('detalle', 300)->nullable();
            $table->String('mg', 20)->nullable();
            $table->String('ml', 20)->nullable();
            $table->String('via', 20)->nullable();
            $table->String('hora', 20)->nullable();
            $table->String('observaciones', 300)->nullable();
            $table->String('tipo', 5)->nullable();
            $table->String('estado', 20)->default('activo');
            $table->foreign('cirugia_id')->references('id')->on('cirugias')->onDelete('cascade');
            $table->foreign('id_producto')->references('id')->on('productos')->onDelete('cascade');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('cirugias_pres');

    }
};
