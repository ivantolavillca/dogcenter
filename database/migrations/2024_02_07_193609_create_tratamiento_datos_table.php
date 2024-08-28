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
        Schema::create('tratamiento_datos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tratamiento_id');
            $table->time('hora');
            $table->string('psys_dv');
            $table->string('temperatura');
            $table->string('fc');
            $table->string('fr');
            $table->string('mm');
            $table->string('trc');
            $table->string('SoPO2');
            $table->string('estado')->default('activo');
            $table->foreign('tratamiento_id')->references('id')->on('tratamientos_historials')->onDelete('cascade');
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
        Schema::dropIfExists('tratamiento_datos');
    }
};
