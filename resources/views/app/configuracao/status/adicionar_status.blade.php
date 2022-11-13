@extends('layouts.layout_default')
@section('conteudo')
    <section id="header-secao-adicionar">
        <h4>
            <img src="{{ asset('icones/icone-checklist.svg') }}">
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