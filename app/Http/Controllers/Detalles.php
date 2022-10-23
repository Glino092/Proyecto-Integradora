<?php

namespace App\Http\Controllers;
use App\Models\mod_detalles;
use Illuminate\Http\Request;

class Detalles extends Controller
{
    public function lista(){
        return view('pages.detalles');
    }
    
    public function lista_detalles(){
        $detalles = mod_detalles::all();
        return $detalles;
    }

    public function guardar_detalle(Request  $request){
        if($request->id == 0)
            $detalle = new mod_detalles();
        else
             $detalle = mod_detalles::find($request->id);

         $detalle->ventas_id = $request->ventas_id;
         $detalle->productos_id = $request->productos_id;
         $detalle->cantidad_ventas = $request->cantidad_ventas;
         $detalle->precio_ventas = $request->precio_ventas;
         
         $detalle->save();
        return "Registro detalle con exito";
    }

        public function eliminar_detalle(Request  $request){
        $detalle = mod_detalles::find($request->id);
        $detalle->delete();
        return "Detalle eliminado con exito";
    }

}
