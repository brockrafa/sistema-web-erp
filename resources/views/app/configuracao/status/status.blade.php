@extends('layouts.layout_default')
@section('conteudo')
    <section id="header-secao-adicionar">
        <h4>
            <img src="{{ asset('icones/icone-checklist.svg') }}">
            <span>Configurações de chamado</span>
        </h4>
        <a href="{{ route('configuracao.status.adicionar') }}">
            <img src="{{ asset('icones/add.svg') }}" alt="">
            <span>Novo status</span>
        </a>
    </section>
    @if (isset($msg) && $msg != '')
        <div class="alerta alerta-sucesso">
            <p>{{$msg}}</p>
        </div>
    @endif

    <section class="body-secao" id="novo-chamado">
        @component('app.configuracao._componentes.tabela_status',['status'=>$status])@endcomponent
    </section>
    
@endsection