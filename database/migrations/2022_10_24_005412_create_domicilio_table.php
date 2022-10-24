<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDomicilioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domicilio', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('calle',100);
            $table->integer('no_exterior');
            $table->integer('no_interior');
            $table->integer('cp');
            $table->string('estado',100);
            $table->string('municipio',100);
            $table->string('colonia',100);
            $table->string('descripcion',120);

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
        Schema::dropIfExists('domicilio');
    }
}
