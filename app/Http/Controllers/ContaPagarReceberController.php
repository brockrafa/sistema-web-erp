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
        return view('app.conta.receber.index',['request'=>$request]);
    }

    public function create(){
        return view('app.conta.receber.adicionar');
    }

    public function store(Request $request){
        echo '<pre>';
        print_r($request->all());
        dd(ContasReceber::find(1));
        exit;

        $regras = [
            'valor_total_itens' => 'required | min:1'
        ];

        $feedback = [
            'required' => '* O campo :attribute é obrigatório'
        ];
        $request->validate($regras,$feedback);

        $var = $request->get('cliente');
        $cliente = explode('-',$var);
        $cliente = Cliente::where('id',trim($cliente[0]))->where('nome',trim($cliente[1]))->first();

        $var = $request->get('usuario');
        $usuario = explode('-',$var);
        $usuario = Usuario::where('id',trim($usuario[0]))->where('nome',trim($usuario[1]))->first();
        
        $venda = new Venda();
        $venda->cliente_id = $cliente->id;
        $venda->usuario_id = $usuario->id;
        $venda->valor_total = $request->get("valor_total_itens");
        $venda->meio_pagamento_id = $request->get("meio_pagamento");
        $venda->qtd_parcelas = 1;
        $venda->valor_parcelas = $request->get("valor_total_itens");

        $parcelas = $request->get("qtd_parcelas") != "" ? explode('#', $request->get("qtd_parcelas")) : "";
        if(!empty($parcelas) && count($parcelas) > 1){
            $venda->qtd_parcelas = $parcelas[0];
            $venda->valor_parcelas = $parcelas[1];
        }

        $venda->data_primeira_parcela = $request->get("data_primeira_parcela");
        $venda->data_vencimento = $request->get("data_vencimento");
        $venda->status_venda_id = 1;
        $venda->save();
        $idVenda = $venda->id;
        $this->adicionarItensVenda($request,$idVenda);

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
}
