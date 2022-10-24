<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalificacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calificaciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_alumno');
            $table->unsignedBigInteger('id_grupo_materia');
            $table->string('p1',30);
            $table->string('p2',30);
            $table->string('p3',30);
            $table->string('pfinal',30);
            $table->date('fecha');

            $table->foreign('id_alumno')->references('id')->on('alumno')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_grupo_materia')->references('id')->on('grupo_materia')->onDelete('cascade')->onUpdate('cascade');







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
        Schema::dropIfExists('calificaciones');
    }
}
