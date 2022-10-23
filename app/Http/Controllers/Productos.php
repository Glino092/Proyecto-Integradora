<?php

namespace App\Http\Controllers;
use App\Models\mod_pro;
use Illuminate\Http\Request;

class Productos extends Controller
{
    public function lista(){
        return view('pages.productos');
    }
    
    public function lista_productos(){
        $productos = mod_pro::all();
        return $productos;
    }

    public function guardar_producto(Request  $request){
        if($request->id == 0)
            $producto = new mod_pro();
        else
             $producto = mod_pro::find($request->id);

         $ruta_archivo = $request->file('archivo')->store('public');
         $producto->nombre_producto = $request->nombre_producto;
         $producto->precio_producto = $request->precio_producto;
         $producto->stock_producto = $request->stock_producto;
         $producto->detalle_producto = $request->detalle_producto;
         $producto->area_producto = $request->area_producto;
         $producto->foto_producto = $ruta_archivo;
         
         $producto->save();
        return "Registro producto con exito";
    }

        public function eliminar_producto(Request  $request){
        $producto = mod_pro::find($request->id);
        $producto->delete();
        return "Cliente eliminado con exito";
    }

}
