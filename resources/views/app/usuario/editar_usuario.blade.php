@extends('layouts.layout_default')
@section('conteudo')
    <section id="header-secao-adicionar">
        <h4>
            <img src="{{ asset('icones/icone-checklist.svg') }}">
            <span>Editar Usuário</span>
        </h4>
        <button type="button" class="btn-limpar" onclick="limparNovoChamado()">
            <img src="{{ asset('icones/lixeira.svg') }}" alt="">
            <span>Limpar</span>
        </button>
    </section>

    @if (isset($msg) && $msg != '')
        <div class="alerta-sucesso">
            <p>{{$msg}}</p>
        </div>
    @endif

    <section class="body-secao" id="novo-chamado">

        <form action="{{ route('usuario.update',['usuario'=>$usuario->id]) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-grupo">
                <label for="username">
                    Username
                    <small>{{ $errors->has('nome') ? $errors->first('nome') : ''}}</small>
                </label>
                <input type="text"  autocomplete="off" name="nome" id="username" value="{{ $usuario->nome ?? old('nome') }}">
            </div>

            <div class="form-grupo">
                <label for="email">Email<small>{{ $errors->has('email') ? $errors->first('email') : ''}}</small></label>
                <input type="text" name = "email" value="{{ $usuario->email ?? old('email') }}" id="email">
            </div>

            <div class="form-grupo">
                <label for="senha">Senha<small>{{ $errors->has('senha') ? $errors->first('senha') : ''}}</small></label>
                <input type="password"  autocomplete="off" name="senha" value="{{ $usuario->senha ??  old('senha') }}" id="senha">
            </div>

            <div class="form-grupo">
                <label for="permissao">Permissão<small>{{ $errors->has('permissao') ? $errors->first('permissao') : ''}}</small></label>
                <select name="permissao" id="permissao">
                    <option value="">Selecione uma permissão</option>
                    <option value="1" {{ $usuario->permissao == 1 ? 'selected' : '' }}>Usuario</option>
                    <option value="2" {{ $usuario->permissao == 2 ? 'selected' : '' }}>Administrador</option>
                </select>
            </div>

            <div class="grupo-botoes">
                <button onclick="voltar('usuario')" type="button">
                    <img src="{{ asset('icones/angle-left-solid.svg') }}" alt="">
                    <span>Voltar</span>
                </button>
                <button>
                    <img src="{{ asset('icones/save.svg') }}" alt="">
                    <span>Salvar</span>
                </button>
            </div>

        </form>
    </section>
@endsection