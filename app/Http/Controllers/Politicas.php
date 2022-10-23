<?php

namespace App\Http\Controllers;
use App\Models\mod_poli;
use Illuminate\Http\Request;

class Politicas extends Controller
{
    public function lista(){
        return view('pages.politicas_privacidad');
    }
    
    public function lista_politicas(){
        $politicas = mod_poli::all();
        return $politicas;
    }

    
}
