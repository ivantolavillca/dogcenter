<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('fichas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_cliente')->nullable();
            $table->String('nombre_cli',50)->default('sin datos')->nullable();
            $table->unsignedBigInteger('id_usuario')->nullable();
            $table->String('usuario', 250)->default('activo')->default('sin datos')->nullable();
            $table->integer('numeracion');
            $table->String('estado', 20)->default('activo');
            $table->foreign('id_cliente')->references('id')->on('mascotas')->onDelete('cascade');
            $table->foreign('id_usuario')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('fichas');
    }
};
