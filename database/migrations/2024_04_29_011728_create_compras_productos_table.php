<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up()
    {
        Schema::create('compras_productos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_compra');
            $table->unsignedBigInteger('producto_id');
            $table->String('descripcion',200);
            $table->decimal('cantidad_inicial', $precision = 8, $scale = 2)->default(0);
            $table->decimal('precio', $precision = 8, $scale = 2)->default(0);
            $table->foreign('id_compra')->references('id')->on('compras')->onDelete('cascade');
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade');
            $table->String('estado', 20)->default('activo');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('compras_productos');
    }
};
