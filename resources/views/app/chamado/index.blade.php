@extends('layouts.layout_default')
@section('conteudo')
<section id="header-secao">
    <h4>
        <!-- <img src="{{ asset('icones/icone-checklist.svg') }}"> -->
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path  d="M256 48C141.1 48 48 141.1 48 256v40c0 13.3-10.7 24-24 24s-24-10.7-24-24V256C0 114.6 114.6 0 256 0S512 114.6 512 256V400.1c0 48.6-39.4 88-88.1 88L313.6 488c-8.3 14.3-23.8 24-41.6 24H240c-26.5 0-48-21.5-48-48s21.5-48 48-48h32c17.8 0 33.3 9.7 41.6 24l110.4 .1c22.1 0 40-17.9 40-40V256c0-114.9-93.1-208-208-208zM144 208h16c17.7 0 32 14.3 32 32V352c0 17.7-14.3 32-32 32H144c-35.3 0-64-28.7-64-64V272c0-35.3 28.7-64 64-64zm224 0c35.3 0 64 28.7 64 64v48c0 35.3-28.7 64-64 64H352c-17.7 0-32-14.3-32-32V240c0-17.7 14.3-32 32-32h16z"/></svg>
        <span>Chamados</span>
    </h4>
    <a href="{{ route('app.novo_chamado') }}">
        <img src="{{ asset('icones/add.svg') }}" alt="">
        <span>Novo chamado</span>
    </a>
</section>


@if (isset($msg) )
<div class="alerta alerta-{{$msg['status']}}">
    {{$msg['msg']}}
</div>
@endif
@if ($errors->has('cliente'))
<div class="alerta alerta-erro">
    {{$errors->first('cliente')}}
</div>
@endif


<section id="filtro-chamados" class="body-secao">
    <div id="titulo-filtro-chamados">
        <img src="{{ asset('icones/lupa.svg') }}" alt="">
        <span>Filtro</span> 
    </div>
    <form action="{{route('app.chamados')}}" method="POST">
        @csrf
        <div class="form-grupo">
            <label for="cliente">
                Cliente
            </label>
            <input type="text" name="cliente"  autocomplete="off" id="cliente"  value="{{ $request->input('cliente')  ?? old('cliente')}}">
        </div>

        <div class="form-grupo">
            <label for="titulo">Titulo do chamado</label>
            <input type="text" autocomplete="off" id="titulo" name="titulo"  value="{{ $request->input('titulo') ?? '' }}">
        </div>

        <div class="form-grupo">
            <label for="data_abertura">Data abertura</label>
            <input type="date" id="data_abertura" name="data_abertura"  value="{{ $request->input('data_abertura') ?? '' }}">
        </div>

        <div class="form-grupo">
            <label for="status">Status após abertura</label>
            <select name="id_status_chamado" id="status">
                <option value="">Todos status</option>
                @foreach ($status as $state)
                    <option value="{{ $state->id }}" {{ old('id_status_chamado') && $state->id == old('id_status_chamado') ? 'selected' : '' }}>{{ $state->status }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-grupo">
            <label for="responsavel">Usuario responsavel</label>
            <select name="id_responsavel" id="responsavel">
                <option value="">Todos usuário</option>
                <option value="0">Não definido</option>
                @foreach ($usuarios as $usuario)
                    <option value="{{$usuario->id}}">{{ucfirst($usuario->nome)}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-grupo">
            <label for="setor">Setor responsável</label>
            <select id="setor" name="setor">
                <option value="">Todos</option>
                <option value="1">Manutenção</option>
                <option value="2">Fechado</option>
            </select>
        </div>

        <div class="form-grupo">
            <label for="prioridade">Nivel prioridade</label>
            <select name="prioridade" id="prioridade">
                <option value="">Todos niveis</option>
                <option value="1">Baixo</option>
                <option value="2">Medio</option>
                <option value="3">Alto</option>
            </select>
        </div>

        <div class="grupo-botoes">
            <button>
                <img src="{{ asset('icones/lupa-white.svg') }}" alt="">
                <span>Filtrar</span>
            </button>
            <button type="button" onclick="limparFiltroChamados()">
                <img src="{{ asset('icones/lixeira.svg') }}" alt="">
                <span>Limpar</span>
            </button>
        </div>

    </form>
</section>

<section class="body-secao">
    @component('app.chamado._componentes.tabelas.tabela_chamados',['chamados'=>$chamados,'request'=>$request])@endcomponent
</section>
@endsection