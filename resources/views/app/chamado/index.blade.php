@extends('layouts.layout_default')
@section('conteudo')
<section id="header-secao">
    <h4>
        <img src="{{ asset('icones/icone-checklist.svg') }}">
        <span>Chamados</span>
    </h4>
    <a href="{{ route('app.novo_chamado') }}">
        <img src="{{ asset('icones/add.svg') }}" alt="">
        <span>Novo chamado</span>
    </a>
</section>


@if (isset($msg) && $msg !='')
<div class="alerta alerta-sucesso">
    {{$msg}}
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