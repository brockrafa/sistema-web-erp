<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chamado;
use App\Models\Cliente;
use App\Models\Usuario;
use App\Models\StatusChamado;

class AppController extends Controller
{
    public function index(){
        $chamados = Chamado::groupBy('data_abertura')
        ->selectRaw('DAY(data_abertura) AS dia,count(*) as sum,data_abertura')
        ->get();
        $clientes = Cliente::groupBy('dia')
        ->selectRaw('DAY(created_at) AS dia,count(*) as sum')
        ->get();
        return view('app.index',['chamados'=>$chamados,'clientes'=>$clientes]);
    }

    public function teste(Request $request){
        print_r($request->all());
    }

    public function menuState(Request $request,$status){
        $_SESSION['menu'] = $status;
    }

    public function fallback(Request $request){
        return redirect()->route('login.index');
    }

    public function clientesList(Request $request){
        $nome = $request->get('nome');
        $clientes = Cliente::where("nome",'like',"%$nome%")->get();
        return json_encode($clientes);
    }
    public function usuariosList(Request $request){
        $nome = $request->get('nome');
        $usuarios = Usuario::where("nome",'like',"%$nome%")->get();
        return json_encode($usuarios);
    }
}
