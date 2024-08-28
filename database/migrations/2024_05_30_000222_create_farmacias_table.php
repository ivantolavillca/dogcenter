<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('farmacias', function (Blueprint $table) {
             $table->id();
            $table->String('nombre',50)->nullable();
            $table->String('descripcion',100)->nullable();
            $table->String('estado', 20)->default('activo');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('farmacias');
    }
};
