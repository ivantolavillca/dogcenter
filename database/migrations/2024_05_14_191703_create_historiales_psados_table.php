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
        Schema::create('historiales_psados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_mascota')->nullable();
            $table->String('descripcion',500)->nullable();
            $table->String('urlimagen',500)->nullable();
            $table->decimal('total', $precision = 8, $scale = 2)->default(0);
            $table->foreign('id_mascota')->references('id')->on('mascotas')->onDelete('cascade');
            $table->String('estado', 20)->default('activo');
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
        Schema::dropIfExists('historiales_psados');
    }
};
