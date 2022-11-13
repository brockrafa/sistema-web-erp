@extends('layouts.layout_default')
@section('conteudo')
    <section id="header-secao">
        <h4>
            <img src="{{ asset('icones/icone-checklist.svg') }}">
            <span>Usuarios</span>
        </h4>
        <a href="{{ route('usuario.create') }}">
            <img src="{{ asset('icones/add.svg') }}" alt="">
            <span>Novo usuario</span>
        </a>
    </section>


    @if (isset($mensagem) && $mensagem !='')
    <div class="alerta  alerta-sucesso">
        <p>{{$mensagem}}</p>
    </div>
    @endif

    <section  class="body-secao table">
        @component('app.usuario._componentes.tabela_usuarios',['usuarios'=>$usuarios])@endcomponent
    </section>
@endsection