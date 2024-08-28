<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('proveedors', function (Blueprint $table) {
            $table->id();
            $table->String('nombre',150);
            $table->String('ci',50);
            $table->String('celular',50);
            $table->String('correo',150);
            $table->String('NIT',150);
            $table->String('estado', 20)->default('activo');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('proveedors');
    }
};
