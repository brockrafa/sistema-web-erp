<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    private $paginacao = 10;

    public function index(Request $request){

        $query = Cliente::where('id_empresa',$_SESSION['id_empresa']);
        $filters = '';

        if($request->input('_token') != ''){

            if($request->input('nome') != ''){
                $query->where('nome','like','%'.$request->input('nome').'%');
            }
            if($request->input('documento') != ''){
                $query->where('documento','like','%'.$request->input('documento').'%');
            }
            if($request->input('data_nascimento') != ''){
                $query->where('data_nascimento','=',$request->input('data_nascimento'));
            }
            if($request->input('cep') != ''){
                $query->where('cep','like','%'.$request->input('cep').'%');
            }
            if($request->input('sexo') != ''){
                $query->where('sexo','=',$request->input('sexo'));
            }
            $clientes = $query->paginate($this->paginacao);   
            $filters = [
                'nome'=>$request->input('nome'),
                'documento'=>$request->input('documento'),
                'data_nascimento'=>$request->input('data_nascimento'),
                'cep'=> $request->input('cep'),
                'sexo'=>$request->input('sexo'),
                '_token'=> 1
            ];
        }
        
        $msg = $request->get('msg');
        $clientes = $query->paginate($this->paginacao);
        $request->request->remove('msg');
        return view('app.cliente.index',['clientes'=>$clientes,'msg'=>$msg,'filters'=>$filters,'request'=>$request]);
    }

    public function novoCliente(Request $request){
        $feedback = [];
        if($request->isMethod('post')){

            $regras = [
                'nome' => 'required',
                'documento' => 'required',
                'cep' => 'required',
                'cidade' => 'required',
                'bairro' => 'required'
            ];

            $feedback = [
                'required' => '* O campo :attribute é obrigatório'
            ];
            $request->validate($regras,$feedback);

            $request['id_empresa'] = $_SESSION['id_empresa'];
            Cliente::create($request->all());
            return redirect()->route('app.clientes',['msg'=>'Cliente adicionado com sucesso']);
        }
        else if($request->isMethod('get') && $request->input('id') != '') {
            $cliente = Cliente::where('id',$request->input('id'))->where('id_empresa',$_SESSION['id_empresa']);
            if($cliente == null){
                return redirect()->route('app.clientes',['msg'=>'Cliente não cadastrado']);
            }
            $request['id_empresa'] = $_SESSION['id_empresa'];
            $request->request->remove('_token');
            $update = $cliente->update($request->all());

            $feedback = 'Cliente atualizado com sucesso!';
            return redirect()->route('app.clientes',['msg'=>$feedback]);
        }
        return view('app.cliente.adicionar');
    }

    public function salvarCliente(Request $request){
        $request['id_empresa'] = $_SESSION['id_empresa'];
        Cliente::create($request->all());
        return redirect()->route('app.clientes',['erro'=>0]);
    }

    public function getTable(Request $request){
        $query = Cliente::where('id_empresa','=',$_SESSION['id_empresa']);

        if($request->get('cliente') != ''){
            $query->where('nome','like','%'.$request->get('cliente').'%');
        }
        if($request->get('documento') != ''){
            $query->where('documento','like','%'.$request->get('documento').'%');
        }
        if($request->get('data_nascimento') != ''){
            $query->where('data_nascimento','=',$request->get('data_nascimento'));
        }
        if($request->get('cep') != ''){
            $query->where('cep','like','%'.$request->get('cep').'%');
        }
        if($request->get('sexo') != ''){
            $query->where('sexo','=',$request->get('sexo'));
        }
        $clientes = $query->paginate($this->paginacao);
        
        return view('app.cliente._componentes.tabelas.tabela_clientes',['clientes'=>$clientes,'request'=>$request]);
    }

    public function delete($id){
        try{
            Cliente::where('id',$id)->where('id_empresa',$_SESSION['id_empresa'])->delete();
            return true;
        }catch(\Illuminate\Database\QueryException $e){
            return 0;
        }
    }

    public function editar($id,$msg = ''){
        $cliente = Cliente::where('id_empresa', '=', $_SESSION['id_empresa'])->where('id', '=', $id)->get()->first();
        if($cliente == null){
            $msg = 'O cliente não existe';
        }
        return view('app.cliente.adicionar',['cliente'=>$cliente,'msg'=>$msg]);
    }
}
