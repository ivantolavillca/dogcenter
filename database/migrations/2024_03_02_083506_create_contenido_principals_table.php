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
        Schema::create('contenido_principals', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',500);
            $table->string('titulo',500);
            $table->string('subtitulo',500);
            $table->string('mision',1000);
            $table->string('vision',1000);
            $table->string('historia',4000);
            $table->string('url_instagram',1000);
            $table->string('url_tiktok',500);
            $table->string('url_facebook',500);
            $table->string('url_youtube',500);
            $table->string('url_twitter',500);
            $table->string('url_telefono',500);
            $table->string('url_logo',500);
            $table->string('img1',500);
            $table->string('img2',500)->nullable();
            $table->string('img3',500)->nullable();
            $table->string('img4',500)->nullable();
           
            $table->string('estado')->default('activo');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('contenido_principals');
    }
};
