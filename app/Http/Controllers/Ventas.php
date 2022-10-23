<?php

namespace App\Http\Controllers;
use App\Models\mod_ventas;
use Illuminate\Http\Request;

class Ventas extends Controller
{
    public function lista(){
        return view('pages.ventas');
    }
    
    public function lista_ventas(){
        $ventas = mod_ventas::all();
        return $ventas;
    }

    public function guardar_venta(Request  $request){
        if($request->id == 0)
            $venta = new mod_ventas();
        else
             $venta = mod_ventas::find($request->id);

       
         $venta->clientes_id = $request->clientes_id;
         $venta->detalle_venta = $request->detalle_venta;
         
         $venta->save();
        return "Registro venta con exito";
    }

        public function eliminar_venta(Request  $request){
        $venta = mod_ventas::find($request->id);
        $venta->delete();
        return "Cliente eliminado con exito";
    }

}
