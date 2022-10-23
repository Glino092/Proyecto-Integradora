<?php
namespace App\Http\Controllers;
use App\Models\mod_clie;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use  Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use PhpParser\Node\Stmt\TryCatch;

class clientes_controller extends Controller
{
    public function lista(){
        return view('pages.clientes');
    }
    
    public function lista_clientes(){
        $clientes = mod_clie::all();
        Try{
            foreach($clientes as $cliente){
        
                $cliente->direccion_cliente = Crypt::decryptString($cliente->direccion_cliente);
                $cliente->telefono_cliente = Crypt::decryptString($cliente->telefono_cliente);
            
        }
        return $clientes;
        }catch (DecryptException $e){
            return("Ya no te salio crack");
        }
        
}

    public function guardar_cliente(Request  $request){
        if($request->id == 0)
            $cliente = new mod_clie();
        else
             $cliente = mod_clie::find($request->id);
         
         $cliente->nombre_cliente = $request->nombre_cliente;
         $cliente->apaterno_cliente = $request->apaterno_cliente;
         $cliente->amaterno_liente = $request->amaterno_liente;
         $cliente->edad_cliente = $request->edad_cliente;

         $cliente->telefono_cliente = Crypt::encryptString($request->telefono_cliente);
         $cliente->direccion_cliente = Crypt::encryptString($request->direccion_cliente);

         $cliente->correo_cliente = $request->correo_cliente;
         $cliente->save();
        return "Registro cliente con exito";
    }

        public function eliminar_cliente(Request  $request){
        $cliente = mod_clie::find($request->id);
        $cliente->delete();
        return "Cliente eliminado con exito";
    }

}
