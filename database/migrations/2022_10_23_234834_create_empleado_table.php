<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleado', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('ap_paterno');
            $table->string('ap_materno');
            $table->string('curp');
            $table->string('rfc');
            $table->date('f_nacimiento');
            $table->date('f_ingreso');
            $table->date('f_baja');
            $table->integer('estatus');
            $table->string('g_academico');
            $table->date('f_nacimiento date');
            $table->string('url_foto'); 
            $table->binary('foto');
            $table->unsignedBigInteger('id_contacto');
            $table->unsignedBigInteger('id_puesto');
            $table->foreign('id_contacto')->references('id')->on('contacto')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_puesto')->references('id')->on('puesto')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('empleado');
    }
}
