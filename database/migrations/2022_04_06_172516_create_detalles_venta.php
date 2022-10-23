<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallesVenta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalles_venta', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ventas_id');
            $table->unsignedBigInteger('productos_id');
            $table->string('cantidad_ventas');
            $table->string('precio_ventas');
            $table->foreign('ventas_id')->references('id')->on('ventas');
            $table->foreign('productos_id')->references('id')->on('productos');
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
        Schema::dropIfExists('detalles_venta');
    }
}
