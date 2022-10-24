<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plantel', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cct',30);
            $table->string('nombre',100);
            $table->unsignedBigInteger('id_domicilio');
            $table->unsignedBigInteger('id_contacto');
            $table->unsignedBigInteger('id_empleado');
            $table->foreign('id_domicilio')->references('id')->on('domicilio')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_contacto')->references('id')->on('contacto')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('plantel');
    }
}
