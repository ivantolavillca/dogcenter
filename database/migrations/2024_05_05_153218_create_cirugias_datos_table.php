<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('cirugias_datos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cirugia_id')->nullable();
            $table->String('hora',50)->nullable();
            $table->String('FC',10)->nullable();
            $table->String('FR',10)->nullable();
            $table->String('Tem',10)->nullable();
            $table->String('MM',10)->nullable();
            $table->String('TLLC',10)->nullable();
            $table->String('sopo2',10)->nullable();
            $table->String('observacion',10)->nullable();
            $table->decimal('total', $precision = 8, $scale = 2)->default(0);
            $table->foreign('cirugia_id')->references('id')->on('cirugias')->onDelete('cascade');
            $table->String('estado', 20)->default('activo');
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('cirugias_datos');
    }
};
