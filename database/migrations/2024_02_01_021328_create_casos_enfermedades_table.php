<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('casos_enfermedades', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion',250);
            $table->string('estado')->default('activo');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('casos_enfermedades');
    }
};
