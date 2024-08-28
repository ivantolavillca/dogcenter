<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tratamientos_historials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('historial_id');
            $table->string('encargado');
            $table->date('fecha');
            $table->string('tratamiento',5000);
            $table->string('observaciones',5000);
            $table->string('estado')->default('activo');
            $table->foreign('historial_id')->references('id')->on('historias_clinicos')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tratamientos_historials');
    }
};
