@extends('layouts.layout_default')
@section('conteudo')
<section id="header-secao">
    <h4>
        <img src="{{ asset('icones/icone-checklist.svg') }}">
        <span>Clientes</span>
    </h4>
    <a href="{{ route('app.novo_cliente') }}">
        <img src="{{ asset('icones/add.svg') }}" alt="">
        <span>Novo cliente</span>
    </a>
</section>

@if (isset($msg) && $msg != '')
<div class="alerta alerta-sucesso">
    <p>{{$msg}}</p>
</div>
@endif

<section id="filtro-chamados" class="body-secao">
    <div id="titulo-filtro-chamados">
        <img src="{{ asset('icones/lupa.svg') }}" alt="">
        <span>Filtro</span> 
    </div>
    <form action="{{ route('app.clientes') }}" method="POST">
        @csrf
        <div class="form-grupo">
            <label for="cliente">Cliente</label>
            <input type="text" name='nome' id="cliente" value="{{ $request->input('nome') ?? '' }}">
        </div>

        <div class="form-grupo">
            <label for="data_nascimento">Data nascimento</label>
            <input type="date" name='data_nascimento' id="data_nascimento" value="{{ $request->input('data_nascimento') ?? '' }}">
        </div>

        <div class="form-grupo">
            <label for="cpf">Documento</label>
            <input type="text" name='documento' id="cpf" value="{{ $request->input('documento') ?? '' }}">
        </div>

        <div class="form-grupo">
            <label for="cep">Cep</label>
            <input type="text" name='cep' id="cep" value="{{ $request->input('cep') ?? '' }}">
        </div>

        <div class="form-grupo">
            <label for="sexo">Sexo</label>
            <select id="sexo"  name='sexo'>
                <option value="">Todos</option>
                <option value="1" {{ $request->input('sexo') == 1 ? 'selected' :  '' }}>Masculino</option>
                <option value="2" {{ $request->input('sexo') == 2 ? 'selected' :  '' }}>Feminino</option>
                <option value="3" {{ $request->input('sexo') == 3 ? 'selected' :  '' }}>Outros</option>
            </select>
        </div>

        <div class="grupo-botoes">
            <button>
                <img src="{{ asset('icones/lupa-white.svg') }}" alt="">
                <span>Filtrar</span>
            </button>
            <button type="button" onclick="limparFiltroCliente()">
                <img src="{{ asset('icones/lixeira.svg') }}" alt="">
                <span>Limpar</span>
            </button>
        </div>

    </form>
</section>

<section  class="body-secao table">
    @component('app.cliente._componentes.tabelas.tabela_clientes',['clientes'=>$clientes,'filters'=>$filters])@endcomponent
</section>
@endsection