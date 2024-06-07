@extends('layouts.layout_default')
@section('conteudo')
    <section id="header-secao">
        <h4>
            <!-- <img src="{{ asset('icones/icone-checklist.svg') }}"> -->
             <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.1.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M224 256c70.7 0 128-57.31 128-128s-57.3-128-128-128C153.3 0 96 57.31 96 128S153.3 256 224 256zM274.7 304H173.3C77.61 304 0 381.6 0 477.3c0 19.14 15.52 34.67 34.66 34.67h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304z"/></svg>
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