<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class ControllerApi extends Controller
{
    public function __construct(Request $request){

        if($request->hasHeader('_token')){
            $usuario = Usuario::where('token_user',$request->header('_token'))->first();
            $this->usuario = $usuario;
        }
        else{
            $this->usuario = 'Usuario não definido';
        }

    }
}
