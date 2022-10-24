<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumnoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumno', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre',100);
            $table->string('ap_p',60);
            $table->string('matricula',100)->unique();
            $table->date('f_nacimiento');
            $table->string('curp',20)->unique();
            $table->integer('status');
            $table->date('f_ingreso');
            $table->date('f_egreso');
            $table->string('url_foto'); 
            $table->binary('foto');
            $table->string('url_qr'); 
            $table->binary('qr');



            $table->unsignedBigInteger('id_domicilio');
            $table->unsignedBigInteger('id_contacto');
            $table->unsignedBigInteger('id_grupo');
            $table->unsignedBigInteger('id_carrera');
            $table->unsignedBigInteger('id_plantel');

            $table->foreign('id_domicilio')->references('id')->on('domicilio')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_contacto')->references('id')->on('contacto')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_grupo')->references('id')->on('grupo')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_carrera')->references('id')->on('carrera')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_plantel')->references('id')->on('plantel')->onDelete('cascade')->onUpdate('cascade');







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
        Schema::dropIfExists('alumno');
    }
}
