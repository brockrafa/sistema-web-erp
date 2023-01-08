<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $mensagem = $request->get('mensagem');
        $id_empresa = $_SESSION['id_empresa'];
        $usuarios = Usuario::where('id_empresa','=',$id_empresa)->paginate(5);
        $permissao = $_SESSION['permissao'];
        return view('app.usuario.index',['usuarios'=>$usuarios,'mensagem'=>$mensagem,'permissao'=>$permissao]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.usuario.novo_usuario');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usuario = new Usuario();
        $usuario->nome = $request->get('nome');
        $usuario->email = $request->get('email');
        $usuario->senha = md5($request->get('senha'));
        $usuario->permissao = $request->get('permissao');
        $usuario->id_empresa = $_SESSION['id_empresa'];
        $usuario->save();
        $mensagem = ['msg'=>'Usuario criado com sucesso','status'=>'sucesso'];
        return redirect()->route('usuario.index',['mensagem'=>$mensagem]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(Usuario $usuario)
    {
        dd($usuario);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit(Usuario $usuario)
    {
        if($usuario->id_empresa != $_SESSION['id_empresa']){
            $mensagem = ['msg'=>'Usuario criado com sucesso','status'=>'sucesso'];
            return redirect()->route('usuario.index',['mensagem'=> $mensagem]);
        }
        return view('app.usuario.editar_usuario',['usuario'=>$usuario]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = Usuario::where('id',$id)->where('id_empresa',$_SESSION['id_empresa'])->first();
        if(!$user){
            return redirect()->route('usuario.index',['mensagem'=>"Usuario não cadastrado"]);
        }
        $user->permissao = $request->get('permissao');
        $user->nome = $request->get('nome');
        $user->email = $request->get('email');
        //$user->senha = md5($request->get('senha'));
        $user->update();
        $mensagem = ['msg'=>'Usuario modificado com sucesso','status'=>'sucesso'];
        return redirect()->route('usuario.index',['mensagem'=>$mensagem]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuario $usuario)
    {
        try{
            if($usuario->id == $_SESSION['id']){
                $mensagem = ['msg'=>'Você não pode deletar o usuario que está logado','status'=>'erro'];
                return redirect()->route('usuario.index',['mensagem'=>$mensagem]);
            }
            $usuario->delete();
            $mensagem = ['msg'=>'Usuario deletado com sucesso','status'=>'sucesso'];
            return redirect()->route('usuario.index',['mensagem'=>$mensagem]);
        }catch(\Illuminate\Database\QueryException $e){
            $mensagem = ['msg'=>'Usuario não pode ser deletado, pois existem chamados atrelados a ele','status'=>'erro'];
            return redirect()->route('usuario.index',['mensagem'=>$mensagem]);
        }
    }
}
