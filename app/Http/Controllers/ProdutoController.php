<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutoController extends Controller
{
    public function index(Request $request){
        $msg = $request->get('msg');
        $produtos = Produto::where('id_empresa',$_SESSION['id_empresa'])->get();
        return view('app.produto.index',['mag'=>$msg ,'produtos' => $produtos]);
    }

    public function cadastrar(){
        return view('app.produto.cadastrar');
    }

    public function store(Request $request){
        $disponivel = $request->get('disponivel') ? 1 : 0;

        $regras = [
            'produto' => 'required',
            'quantidade' => 'required',
            'preco' => 'required'
        ];

        $feedback = [
            'required' => '* O campo :attribute é obrigatório'
        ];
        $request->validate($regras,$feedback);
        
        $produto = new Produto();
        $produto->produto = $request->get('produto');
        $produto->quantidade = $request->get('quantidade');
        $produto->preco = str_replace(',','.',$request->get('preco'));
        $produto->disponibilidade = $disponivel;
        $produto->id_empresa = $_SESSION['id_empresa'] ?? 1;
        $produto->save();
        return redirect()->route('app.produtos',['msg'=>'Produto cadastrado com sucesso!']);
    }

    public function atualizarStatus(Request $request){
        $disponivel = $request->get('disponivel') ? 1 : 0;
        $produto = Produto::find($request->produto);
        $produto->disponibilidade = $disponivel;
        $produto->update();
        return  1;
    }
}
