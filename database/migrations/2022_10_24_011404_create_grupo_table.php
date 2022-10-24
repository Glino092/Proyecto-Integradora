<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGrupoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre',30);
            $table->string('turno',60);
            $table->unsignedBigInteger('id_carrera');
            $table->unsignedBigInteger('id_cuatrimestre');
            $table->unsignedBigInteger('id_empleado');
            $table->foreign('id_carrera')->references('id')->on('carrera')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_cuatrimestre')->references('id')->on('cuatrimestre')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_empleado')->references('id')->on('empleado')->onDelete('cascade')->onUpdate('cascade');





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
        Schema::dropIfExists('grupo');
    }
}
