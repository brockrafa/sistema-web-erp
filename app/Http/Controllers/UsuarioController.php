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
        $usuarios = Usuario::paginate(5);
        return view('app.usuario.index',['usuarios'=>$usuarios,'mensagem'=>$mensagem]);
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
        $usuario->save();
        $mensagem = 'Usuario criado com sucesso';
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
        $user = Usuario::find($id);
        $user->permissao = $request->get('permissao');
        $user->nome = $request->get('nome');
        $user->email = $request->get('email');
        $user->senha = md5($request->get('senha'));
        $user->update();
        $mensagem = 'Usuario modificado com sucesso';
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
        $usuario->delete();
        $mensagem = 'Usuario deletado com sucesso';
        return redirect()->route('usuario.index',['mensagem'=>$mensagem]);
    }
}
