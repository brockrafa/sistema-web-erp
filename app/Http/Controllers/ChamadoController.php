<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chamado;
use App\Models\Cliente;
use App\Models\StatusChamado;
use App\Models\Usuario;
use App\Models\DetalhesChamado;


class ChamadoController extends Controller
{
    private $paginate = 10;

    public function index(Request $request){
        
        $query = Chamado::where('id_empresa','=',$_SESSION['id_empresa']);

        if($request->input('_token')){
            if($request->input('titulo') != ''){
                $query->where('titulo','like','%'.$request->input('titulo').'%');
            }
            if($request->input('data_abertura') != ''){
                $query->where('data_abertura','=',$request->input('data_abertura'));
            }
            if($request->input('id_status_chamado') != ''){
                $query->where('id_status_chamado','=',$request->input('id_status_chamado'));
            }
            if($request->input('id_responsavel') != ''){
                if($request->input('id_responsavel') > 0){
                    $query->where('id_responsavel','=',$request->input('id_responsavel'));
                }else{
                    $query->whereNull('id_responsavel');
                }
            }
            if($request->input('setor') != ''){
                $query->where('setor','=',$request->input('setor'));
            }
            if($request->input('prioridade') != ''){
                $query->where('prioridade','=',$request->input('prioridade'));
            }
            if($request->input('cliente') != ''){
                $request->validate(['cliente' => 'min:4'],['min' => 'O campo :attribute precisa ter mínimo 4 caracteres.']);

                $clientes = Cliente::where('nome','like','%'.$request->input('cliente').'%')->get();
                if(count($clientes)){
                    foreach($clientes as $cliente){
                        $query->where('id_cliente','=',$cliente->id);
                    }
                }else{
                    $query->where('id_cliente','=','-1');
                }
            }
        }
        $msg = $request->get('msg');
        $request->request->remove('msg');
        $status = StatusChamado::all();
        $chamados = $query->orderBy('id_status_chamado', 'asc')->paginate($this->paginate); 
        $usuarios = Usuario::all();
        return view('app.chamado.index',['chamados'=>$chamados,'msg'=>$msg,'request'=>$request,'usuarios'=>$usuarios,'status'=>$status]);
    }

    public function novoChamado(Request $request){
        if($request->isMethod('post')){
            $regras = [
                'id_cliente' => 'required',
                'data_abertura' => 'required',
                'setor' => 'required',
                'tipo_problema' => 'required',
                'prioridade' => 'required',
                'id_status_chamado' => 'required',
                'contrato' => 'required',
                'titulo' => 'required',
                'problema' => 'required'
            ];

            $feedback = [
                'required' => '* O campo :attribute é obrigatório.'
            ];
            $request->validate($regras,$feedback);

            $chamado = $request->all();

            $chamado['id_empresa'] = $_SESSION['id_empresa'];

            Chamado::create($chamado);

            $msg = [
                'status'=>'sucesso',
                'msg'=>'Chamado aberto com sucesso'
            ];
            return redirect()->route('app.chamados',['msg'=>$msg]);
        }
        $clientes = Cliente::where('id_empresa',$_SESSION['id_empresa'])->get();
        $status   = StatusChamado::all();
        $usuarios   = Usuario::where('id_empresa',$_SESSION['id_empresa'])->get();
        return view('app.chamado.adicionar',['clientes'=>$clientes,'status'=>$status,'usuarios'=>$usuarios]);
    }

    public function editar($id,Request $request){
        $msg = $request->get('msg');
        $chamado = Chamado::where('id_empresa', '=', $_SESSION['id_empresa'])->where('id', '=', $id)->get()->first();

        if($chamado == null){
            $msg = [
                'status'=>'erro',
                'msg'=>'O chamado não existe'
            ];
            return redirect()->route('app.chamados',['msg'=>$msg]);
        }

        $usuarios = Usuario::where('id_empresa', '=', $_SESSION['id_empresa'])->get();
        $status   = StatusChamado::all();
        return view('app.chamado.editar',['chamado'=>$chamado,'usuarios'=>$usuarios,'status'=>$status,'msg'=>$msg]);
    }

    public function armazenar(Request $request){
        $chamado = Chamado::find($request->input('id'));
        $alteracoes = [];

        // VERIFICAÇÃO PARA VER SE HOUVE ALTERAÇÃO EM ALGUM CAMPO IMPORTANTE DO CHAMADO
        if($chamado->setor != $request->get('setor')){
            $setor = $request->input('setor');
            $alteracoes['setor'] = 'O(a) usuario '.$_SESSION['nome'].' alterou o setor responsavel pelo chamado de: '.$chamado->setor. ' para: '.$setor;    
        }
        if($chamado->tipo_problema != $request->get('tipo_problema')){
            $problema = $request->input('tipo_problema');
            $alteracoes['tipo_problema'] = 'O(a) usuario '.$_SESSION['nome'].' alterou o tipo_problema do chamado de: '.$chamado->tipo_problema. ' para: '.$problema;    
        }
        if($chamado->prioridade != $request->get('prioridade')){
            $prioridade = $request->input('prioridade');
            $alteracoes['prioridade'] = 'O(a) usuario '.$_SESSION['nome'].' alterou a prioridade do chamado de: '.$chamado->prioridade. ' para: '.$prioridade;    
        }
        if($chamado->id_responsavel != $request->get('id_responsavel')){
            $responsavel = $request->input('id_responsavel') != '' ? Usuario::find($request->input('id_responsavel'))->nome : 'Não definido';
            $responsavel_old = $chamado->id_responsavel!='' ? Usuario::find($chamado->id_responsavel)->nome : 'Não definido';
            $usuario = isset($_SESSION['id']) ? $_SESSION['nome'] : 'Não definido';
            $alteracoes['id_responsavel'] = 'O(a) usuario '.$usuario.' alterou o usuario responsavel pelo chamado de: '.$responsavel_old. ' para: '.$responsavel;    
        }
        if($chamado->id_status_chamado != $request->get('id_status_chamado')){
            $status = StatusChamado::find($request->input('id_status_chamado'));
            $usuario = isset($_SESSION['id']) ? $_SESSION['nome'] : 'Não definido';
            $alteracoes['status'] = 'O(a) usuario '.$usuario.' alterou o status do chamado de: '.$chamado->statusChamado->status. ' para: '.$status->status;    
        }
        $usuario = isset($_SESSION['id']) ? $_SESSION['id'] : 0;
        foreach($alteracoes as $alteracao){
            DetalhesChamado::create([
                'update_descricao'=>$alteracao,
                'id_chamado'=>$chamado->id,
                'id_usuario'=>$usuario
            ]);
        }
        if($request->input('update_descricao') != ''){
            DetalhesChamado::create([
                'update_descricao'=>$request->input('update_descricao'),
                'id_chamado'=>$chamado->id,
                'id_usuario'=>$_SESSION['id']
            ]);
        }
        $chamado->setor = $request->input('setor');
        $chamado->tipo_problema = $request->input('tipo_problema');
        $chamado->prioridade = $request->input('prioridade');
        $chamado->id_responsavel = $request->input('id_responsavel');
        $chamado->id_status_chamado = $request->input('id_status_chamado');
        $chamado->updated_at = date('Y-m-d H:i:s');
        $chamado->save();
        $msg = [
            'status'=>'sucesso',
            'msg'=>'Chamado atualizado com sucesso'
        ];
        return redirect()->route('app.chamados',['msg'=>$msg]);
    }
}
