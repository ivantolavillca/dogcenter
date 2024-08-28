<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up()
    {
        Schema::create('ventas_productos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('producto_id');
            $table->unsignedBigInteger('id_venta')->nullable();
            $table->String('descripcion',500);
            $table->decimal('cantidad', $precision = 8, $scale = 2)->default(0);
            $table->decimal('precio', $precision = 8, $scale = 2)->default(0);
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade');
            $table->foreign('id_venta')->references('id')->on('ventas')->onDelete('cascade');
            $table->String('estado', 20)->default('activo');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ventas_productos');
    }
};
