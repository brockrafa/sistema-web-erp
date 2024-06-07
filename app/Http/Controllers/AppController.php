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
        ->selectRaw('DAY(data_abertura) AS dia,count(*) as sum,data_abertura')->orderBy("data_abertura",'asc')
        ->get();

        $clientes = Cliente::whereRaw('month(created_at) = month(now())')
        ->selectRaw('DAY(created_at) AS dia,count(*) as sum,DATE(created_at) as data')->orderBy("data",'asc')
        ->groupBy('data','dia')
        ->get();
        return view('app.index',['chamados'=>$chamados,'clientes'=>$clientes]);
    }

    public function teste(Request $request){
        return view('app.teste');

    }

    public function menuState(Request $request,$status){
        $_SESSION['menu'] = $status;
    }

    public function fallback(Request $request){
        return redirect()->route('app.home');
    }

    public function clientesList(Request $request){
        $nome = $request->get('nome');
        $clientes = Cliente::where("nome",'like',"%$nome%")->where('id_empresa',$_SESSION['id_empresa'])->get();
        return json_encode($clientes);
    }
    public function usuariosList(Request $request){
        $nome = $request->get('nome');
        $usuarios = Usuario::where("nome",'like',"%$nome%")->where('id_empresa',$_SESSION['id_empresa'])->get();
        return json_encode($usuarios);
    }
}
