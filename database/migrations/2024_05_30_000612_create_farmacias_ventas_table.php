<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('farmacias_ventas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mascota_id')->nullable();
            $table->unsignedBigInteger('farmacia_id')->nullable();
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->String('unidad', 20)->default('ml')->nullable();;
            $table->decimal('cantidad', $precision = 10, $scale = 4)->default(0);
            $table->decimal('precio', $precision = 10, $scale = 4)->default(0);
            $table->foreign('mascota_id')->references('id')->on('mascotas')->onDelete('cascade');
            $table->foreign('farmacia_id')->references('id')->on('farmacias')->onDelete('cascade');
            $table->foreign('doctor_id')->references('id')->on('users')->onDelete('cascade');
            $table->String('estado', 20)->default('activo');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('farmacias_ventas');
    }
};
