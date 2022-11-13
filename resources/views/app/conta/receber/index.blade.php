@extends('layouts.layout_default')
@section('conteudo')
<section id="header-secao">
    <h4>
        <img src="{{ asset('icones/icone-checklist.svg') }}">
        <span>Contas a receber</span>
    </h4>
    <a href="{{ route('contas.receber.create') }}">
        <img src="{{ asset('icones/add.svg') }}" alt="">
        <span>Nova conta</span>
    </a>
</section>

@if (isset($msg) && $msg != '')
<div class="alerta alerta-sucesso">
    <p>{{$msg}}</p>
</div>
@endif

<section id="filtro-contas" class="body-secao">
    <div id="titulo-filtro-chamados">
        <img src="{{ asset('icones/lupa.svg') }}" alt="">
        <span>Filtro</span> 
    </div>
    <form action="{{ route('contas.receber.index') }}" method="POST">
        @csrf

        <div class="form-grupo-cliente-filtro">
            <input autocomplete="off" type="text" name='nome' id="cliente" value="" placeholder="Nome do cliente">
            <div class="grupo-botoes">
                <button>
                     Buscar cliente 
                </button>
            </div>
        </div>

        <div class="form-grupo ordernar-filtro">
            <label for="">Filtrar por</label>
            <select name="" id="">
                <option value="">Este mês</option>
                <option value="">Data de vencimento</option>
                <option value="">Status pendente</option>
                <option value="">Status pago</option>
                <option value="">Vencido</option>
            </select>
        </div>

        <div class="form-grupo ordernar-filtro">
            <label for="">Ordenar por</label>
            <select name="" id="">
                <option value="">Data de vencimento</option>
                <option value="">Status pendente</option>
                <option value="">Status pago</option>
                <option value="">Vencido</option>
            </select>
        </div>

    </form>

    <section  class="table"> 
        @component('app.conta.receber._componentes.tabela_contas_receber')@endcomponent
    </section>

</section>

     
@endsection