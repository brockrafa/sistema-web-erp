@extends('layouts.layout_default')
@section('conteudo')
    <section id="header-secao">
        <h4>
            <img src="{{ asset('icones/icone-checklist.svg') }}">
            <span>Usuarios</span>
        </h4>
        @if($permissao == 2)
            <a href="{{ route('usuario.create') }}">
                <img src="{{ asset('icones/add.svg') }}" alt="">
                <span>Novo usuario</span>
            </a>
        @endif
    </section>


    @if (isset($mensagem) )
    <div class="alerta alerta-{{$mensagem['status']}}">
        {{$mensagem['msg']}}
    </div>
    @endif

    <section  class="body-secao table">
        @component('app.usuario._componentes.tabela_usuarios',['usuarios'=>$usuarios,'permissao'=>$permissao])@endcomponent
    </section>
@endsection