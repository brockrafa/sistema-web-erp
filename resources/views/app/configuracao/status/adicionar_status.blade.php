@extends('layouts.layout_default')
@section('conteudo')
    <section id="header-secao-adicionar">
        <h4>
            <!-- <img src="{{ asset('icones/icone-checklist.svg') }}"> -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M256 96c38.4 0 73.7 13.5 101.3 36.1l-32.6 32.6c-4.6 4.6-5.9 11.5-3.5 17.4s8.3 9.9 14.8 9.9H448c8.8 0 16-7.2 16-16V64c0-6.5-3.9-12.3-9.9-14.8s-12.9-1.1-17.4 3.5l-34 34C363.4 52.6 312.1 32 256 32c-10.9 0-21.5 .8-32 2.3V99.2c10.3-2.1 21-3.2 32-3.2zM132.1 154.7l32.6 32.6c4.6 4.6 11.5 5.9 17.4 3.5s9.9-8.3 9.9-14.8V64c0-8.8-7.2-16-16-16H64c-6.5 0-12.3 3.9-14.8 9.9s-1.1 12.9 3.5 17.4l34 34C52.6 148.6 32 199.9 32 256c0 10.9 .8 21.5 2.3 32H99.2c-2.1-10.3-3.2-21-3.2-32c0-38.4 13.5-73.7 36.1-101.3zM477.7 224H412.8c2.1 10.3 3.2 21 3.2 32c0 38.4-13.5 73.7-36.1 101.3l-32.6-32.6c-4.6-4.6-11.5-5.9-17.4-3.5s-9.9 8.3-9.9 14.8V448c0 8.8 7.2 16 16 16H448c6.5 0 12.3-3.9 14.8-9.9s1.1-12.9-3.5-17.4l-34-34C459.4 363.4 480 312.1 480 256c0-10.9-.8-21.5-2.3-32zM256 416c-38.4 0-73.7-13.5-101.3-36.1l32.6-32.6c4.6-4.6 5.9-11.5 3.5-17.4s-8.3-9.9-14.8-9.9H64c-8.8 0-16 7.2-16 16l0 112c0 6.5 3.9 12.3 9.9 14.8s12.9 1.1 17.4-3.5l34-34C148.6 459.4 199.9 480 256 480c10.9 0 21.5-.8 32-2.3V412.8c-10.3 2.1-21 3.2-32 3.2z"/></svg>
            <span>Novo Status</span>
        </h4>
    </section>
    @if (isset($msg) && $msg != '')
        <div class="alerta alerta-sucesso">
            <p>{{$msg}}</p>
        </div>
    @endif

    <section class="body-secao" id="novo-chamado">
         
        @if (isset($status) && $status != '')
            <form action="{{ route('configuracao.status.update') }}" method="POST">
        @else
            <form action="{{ route('configuracao.status.store') }}" method="POST">
        @endif
            @csrf
            <input type="hidden" name="id" value="{{$status->id ?? ''}}">
            <div class="form-grupo full">
                <label for="status">
                    Nome do status
                    <small>{{ $errors->has('status') ? $errors->first('status') : ''}}</small>
                </label>
                <input onchange="changeColorStatus()" type="text" name="status" id="status" value="{{$status->status ?? 'Novo status'}}">
            </div>
            
            <div class="form-grupo full">
                <label for="background_color">Cor do background<small>{{ $errors->has('background_color') ? $errors->first('background_color') : ''}}</small></label>
                <input onchange="changeColorStatus()" type="color" name="background_color" value="{{$status->background_color ??'#000000'}}" id="background_color">
            </div>
            
            <div class="form-grupo">
                <label for="font_color">Cor da fonte<small>{{ $errors->has('font_color') ? $errors->first('font_color') : ''}}</small></label>
                <input onchange="changeColorStatus()" type="color" name="font_color" id="font_color" value="{{$status->font_color ??'#ffffff'}}" >
            </div>

            <table id="tabela-default" style="margin:40px 0">
                <thead>
                <tr>
                    <th scope="col">Titulo</th>
                    <th scope="col">Data abertura</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Status</th>
                    <th scope="col">Responsável</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#</td>
                        <td>#</td>
                        <td>#</td>
                        <td>
                            <span class="status-table" id="exemplo-status-novo" style="color:white;background-color:black">
                                Teste
                            </span>
                        </td>
                        <td>#</td>
                    </tr>
                </tbody>
            </table>


            <div class="grupo-botoes">
                <a href="{{route('configuracao.status')}}">
                    <button type="button">
                        <img src="{{ asset('icones/angle-left-solid.svg') }}" alt="">
                        <span>Voltar</span>
                    </button>
                </a>
                <button>
                    <img src="{{ asset('icones/save.svg') }}" alt="">
                    <span>Salvar</span>
                </button>
            </div>

        </form>
    </section>
@endsection