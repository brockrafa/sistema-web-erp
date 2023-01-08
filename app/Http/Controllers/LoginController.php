<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Cliente;
use App\Models\RecuperarSenha;
use App\Mail\RecuperacaoSenhaMail;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{

    public function index(Request $request,$msg = ''){
        $accessError = $request->get('accessError');
        return view('site.login',['accessError'=>$accessError,'msg'=>$msg]);
    }

    public function autenticar(Request $request){
        $email = $request->get('email');
        $password = $request->get('senha');
        $user = new Usuario();
        $usuario = $user->where('email',$email)->where('senha',md5($password))->get()->first();
        if(isset($usuario->id)){
            session_start();
            $_SESSION['id'] = $usuario->id;
            $_SESSION['email'] = $usuario->email;
            $_SESSION['permissao'] = $usuario->permissao;
            $_SESSION['nome'] = $usuario->nome;
            $_SESSION['id_empresa'] = $usuario->id_empresa;
            // Definir se menu irá iniciar aberto ou fechado
            if(!isset($_SESSION['menu'])){
                $_SESSION['menu'] = 0;
            }
            return redirect()->route('app.home');
        }else{
            return redirect()->route('login.index',['erro'=>1]);
        }
    }

    public function logoff(Request $request){
        session_start();
        session_destroy();
        return redirect()->route('login.index');
    }
}
