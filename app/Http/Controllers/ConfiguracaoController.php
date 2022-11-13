<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StatusChamado;

class ConfiguracaoController extends Controller
{
    private $page = 'config';

    public function index(Request $request){
        $status = StatusChamado::all();
        $msg = $request->get('msg');
        return view('app.configuracao.status.status',['status'=>$status,'msg'=>$msg]);
    }
    public function novoStatus(){
        return view('app.configuracao.status.adicionar_status');
    }
    public function statusStore(Request $request){
        StatusChamado::create($request->all());
        return redirect()->route('configuracao.status');
    }
    public function statusDelete($id){
        try{
            StatusChamado::find($id)->delete();
            return true;
        }catch(\Illuminate\Database\QueryException $e){
            return 0;
        }
    }

    public function editarStatus(Request $request,$id){
        $status = StatusChamado::find($id);
        return view('app.configuracao.status.adicionar_status',['status'=>$status]);
    }

    public function updateStatus(Request $request){
        $status = StatusChamado::find($request->get('id'));
        $status->update($request->all());
        return redirect()->route('configuracao.status',['msg'=>'Status atualizado com sucesso']);
    }
}
