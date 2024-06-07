@extends('layouts.layout_default')
@section('conteudo')
<section id="header-secao">
    <h4>
        <!-- <img src="{{ asset('icones/icone-checklist.svg') }}"> -->
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M384 0H96C60.65 0 32 28.65 32 64v384c0 35.35 28.65 64 64 64h288c35.35 0 64-28.65 64-64V64C448 28.65 419.3 0 384 0zM240 128c35.35 0 64 28.65 64 64s-28.65 64-64 64c-35.34 0-64-28.65-64-64S204.7 128 240 128zM336 384h-192C135.2 384 128 376.8 128 368C128 323.8 163.8 288 208 288h64c44.18 0 80 35.82 80 80C352 376.8 344.8 384 336 384zM496 64H480v96h16C504.8 160 512 152.8 512 144v-64C512 71.16 504.8 64 496 64zM496 192H480v96h16C504.8 288 512 280.8 512 272v-64C512 199.2 504.8 192 496 192zM496 320H480v96h16c8.836 0 16-7.164 16-16v-64C512 327.2 504.8 320 496 320z "/></svg>
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