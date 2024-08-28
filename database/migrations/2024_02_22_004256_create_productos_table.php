<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->String('nombre',50);
            $table->String('descripcion',100);
            $table->String('imagen', 260);
            $table->decimal('cantidad_inicial', $precision = 8, $scale = 2)->default(0);
            $table->decimal('stock', $precision = 8, $scale = 2)->default(0);
            $table->decimal('precio', $precision = 8, $scale = 2)->default(0);
            $table->String('unidad_de_medida',100);
            $table->String('estado', 20)->default('activo');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('productos');
    }
};
