<?php

namespace App\Http\Controllers;
use App\Models\Cliente;
use App\Models\Venda;
use App\Models\Usuario;
use App\Models\ItensVenda;
use App\Models\ContasReceber;
use Illuminate\Http\Request;

class ContaPagarReceberController extends Controller
{
    public function index(Request $request){
        

        $contas = ContasReceber::with(['venda']);
        
        $cliente = $request->get('nome_cliente');
        $exibicao = $request->get('exibicao');
        $status = $request->get('status');

        $filtros = "data_vencimento between DATE_SUB(CURRENT_DATE,INTERVAL DAYOFMONTH(CURRENT_DATE)- 1 DAY) and LAST_DAY(CURRENT_DATE)";

        if( $exibicao){
            switch($exibicao){
                case 1: 
                    $filtros = "data_vencimento BETWEEN DATE_SUB( DATE_ADD(current_date(), INTERVAL 1 MONTH),INTERVAL DAYOFMONTH( DATE_ADD(current_date(), INTERVAL 1 MONTH))- 1 DAY) AND LAST_DAY(DATE_ADD(current_date(), INTERVAL 1 MONTH))";
                    break;
                case 7:
                    $filtros = "data_vencimento BETWEEN CURRENT_DATE() AND DATE_ADD(current_date(), INTERVAL 7 DAY)";
                    break;
                case 15:
                    $filtros = "data_vencimento BETWEEN CURRENT_DATE() AND DATE_ADD(current_date(), INTERVAL 15 DAY)";
                    break;
                case 90:
                    $filtros = "1=1";
                    break;
            }
        }

        if($cliente){
            $contas->whereHas('venda',function ($query) use ($request){
                $query->whereHas('cliente',function($q) use ($request){
                    $q->where('nome','like','%'.$request->get('nome_cliente').'%');
                });
            });
        }

        if($status){
            switch($status){
                case 91:
                    $contas->whereNull('data_pagamento');
                    break;
                case 92:
                    $contas->whereNotNull('data_pagamento');
                    break;

            }
        }

        
        $contas = $contas->whereRaw($filtros)->orderBy('STATUS','ASC')->orderBy('DATA_VENCIMENTO','ASC')->paginate(15);
        $msg = $request->get('msg');


        return view('app.conta.receber.index',[
            'request'=>$request,
            'contas'=>$contas,
            'cliente' => $cliente,
            'exibicao' => $exibicao,
            'status' => $status,
            'msg'=>$msg
        ]);
    }

    public function create(){
        return view('app.conta.receber.adicionar');
    }

    public function store(Request $request){

        $regras = [
            'valor_total_itens' => 'required | min:1'
        ];

        $feedback = [
            'required' => '* O campo :attribute é obrigatório'
        ];

        $var = $request->get('cliente');
        $cliente = explode('-',$var);

        $var = $request->get('usuario');
        $usuario = explode('-',$var);

        if(!isset($cliente[1]) || !isset($usuario[1]) ){
            return redirect()->route('contas.receber.create');
        }

        $cliente = Cliente::where('id',trim($cliente[0]))->where('nome',trim($cliente[1]))->first();
        $usuario = Usuario::where('id',trim($usuario[0]))->where('nome',trim($usuario[1]))->first();
      
        $request->validate($regras,$feedback);
        
        $venda = new Venda();
        $venda->cliente_id = $cliente->id;
        $venda->usuario_id = $usuario->id;
        $venda->valor_total = $request->get("valor_total_itens");
        $venda->meio_pagamento_id = $request->get("meio_pagamento");
        $venda->qtd_parcelas = $request->get("qtd_parcelas");
        $venda->valor_parcelas = $request->get("valor_total_itens") / $request->get("qtd_parcelas");
        $venda->data_primeira_parcela = $request->get("data_vencimento") ? $request->get("data_vencimento") : date('Y-m-d');
        $venda->data_vencimento = $request->get("data_vencimento") ? $request->get("data_vencimento") : date('Y-m-d');
        $venda->status_venda_id = 0;
        if($venda->meio_pagamento_id != '901'){
            $venda->data_pagamento = date('Y-m-d');
            $venda->status_venda_id = 1;
        }
        $venda->save();
        $idVenda = $venda->id;
        $this->adicionarItensVenda($request,$idVenda);
        $this->adicionarParcelas($venda);
        return redirect()->route('contas.receber.index');

    }

    private function adicionarItensVenda(Request $request,int $idVenda){
        $itens = $request->get('item');
        $valor = $request->get('valor');
        $quantidade = $request->get('quantidade');
        for($i = 0;$i < count($itens);$i++){
            $item = new ItensVenda();
            $item->venda_id = $idVenda;
            $item->item = $itens[$i];
            $val = str_replace("R$","",$valor[$i]);
            $val = str_replace(",",".",$val);
            $item->valor = $val;
            $item->quantidade = $quantidade[$i];
            $item->save();
        }
        return true;
    }

    private function adicionarParcelas($venda){
        
        $parcelas = $venda->qtd_parcelas;
        $contas = [];
        if($parcelas == 1 && $venda->meio_pagamento_id != '901'){
            $contaReceber = new ContasReceber();
            $contaReceber->venda_id = $venda->id;
            $contaReceber->valor_receber = $venda->valor_parcelas;
            $contaReceber->parcela_atual = 1;
            $contaReceber->total_parcelas = $venda->qtd_parcelas;
            $contaReceber->data_vencimento = $venda->data_vencimento;
            $contaReceber->data_pagamento = $venda->data_vencimento;
            $contaReceber->save();
        }else{
            for($i = 1; $i <= $parcelas;$i++){
                $contaReceber = new ContasReceber();
                $contaReceber->venda_id = $venda->id;
                $contaReceber->valor_receber = $venda->valor_parcelas;
                $contaReceber->parcela_atual = $i;
                $contaReceber->total_parcelas = $venda->qtd_parcelas;
                $contaReceber->data_vencimento = $venda->data_primeira_parcela;
                if($i != 1){ 
                    $contaReceber->data_vencimento = date('Y-m-d', strtotime($venda->data_primeira_parcela.' +' .($i-1). 'month'));
                }
                $contaReceber->STATUS = 0;
                $contaReceber->save();
            }
        }
        return 1;
    }

    public function receive(int $id){
        $conta = ContasReceber::with(['venda','venda.cliente'])->find($id);
        $conta->data_vencimento = date('d/m/Y', strtotime($conta->data_vencimento));
        return json_encode($conta);
    }

    public function receiveStore(Request $request){
        $conta = ContasReceber::with(['venda','venda.cliente'])->find($request->get('id'));
        $conta->data_pagamento = $request->data_pagamento;
        $conta->valor_recebido = str_replace(',','.',$request->valor_pago);
        $conta->valor_recebido = str_replace('R$','',$conta->valor_recebido);
        $conta->STATUS = 1; 
        if($request->get('decisao_conta')){
            $this->recalcularParcelas($conta,$request);
            dd("Recalcular parcela");
        }
        $conta->update();
        return redirect()->route('contas.receber.index',['msg'=>'Conta recebida com sucesso!']);
    }

    private function recalcularParcelas($conta,Request $request){
        $parcelas = $conta->qtd_parcelas;
        if($request->get('decisao_conta') == 'manter'){
            echo 'Manter esse mes aberto';
        }else{
            echo 'Passar para proximas';
        }
        dd($conta);
        return 1;
    }
}
