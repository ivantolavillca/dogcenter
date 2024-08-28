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
        Schema::create('tratamiento_historial_clinicos', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion',4000);
            $table->string('imagen',255)->nullable();
            $table->unsignedBigInteger('historial_id');
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
        Schema::dropIfExists('tratamiento_historial_clinicos');
    }
};
