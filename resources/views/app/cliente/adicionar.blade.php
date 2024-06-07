@extends('layouts.layout_default')
@section('conteudo')
    <section id="header-secao-adicionar">
        <h4>
            <!-- <img src="{{ asset('icones/icone-checklist.svg') }}"> -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M384 0H96C60.65 0 32 28.65 32 64v384c0 35.35 28.65 64 64 64h288c35.35 0 64-28.65 64-64V64C448 28.65 419.3 0 384 0zM240 128c35.35 0 64 28.65 64 64s-28.65 64-64 64c-35.34 0-64-28.65-64-64S204.7 128 240 128zM336 384h-192C135.2 384 128 376.8 128 368C128 323.8 163.8 288 208 288h64c44.18 0 80 35.82 80 80C352 376.8 344.8 384 336 384zM496 64H480v96h16C504.8 160 512 152.8 512 144v-64C512 71.16 504.8 64 496 64zM496 192H480v96h16C504.8 288 512 280.8 512 272v-64C512 199.2 504.8 192 496 192zM496 320H480v96h16c8.836 0 16-7.164 16-16v-64C512 327.2 504.8 320 496 320z "/></svg>
            <span>@if(isset($cliente))Editar cliente @else Novo Cliente @endif</span>
        </h4>
        <button type="button" class="btn-limpar" onclick="limparNovoChamado()">
            <img src="{{ asset('icones/lixeira.svg') }}" alt="">
            <span>Limpar</span>
        </button>
    </section>
    @if (isset($msg) && $msg != '')
        <div class="alerta alerta-sucesso">
            <p>{{$msg}}</p>
        </div>
    @endif

    <section class="body-secao" id="novo-chamado">
        
        @if(isset($cliente))
            <form action="{{ route('app.novo_cliente') }}" method="GET">
        @else
            <form action="{{ route('app.novo_cliente') }}" method="POST">
        @endif
            @csrf
            <input type="hidden" name="id"value="{{ $cliente->id ?? '' }}">

            <div class="form-grupo">
                <label for="nome_cliente">
                    Nome completo 
                    <small>{{ $errors->has('nome') ? $errors->first('nome') : ''}}</small>
                </label>
                <input type="text" name="nome" id="nome_cliente" value="{{ $cliente->nome ?? old('nome') }}">
            </div>

            <div class="form-grupo">
                <label for="data_abertura">Data nascimento<small>{{ $errors->has('data_nascimento') ? $errors->first('data_nascimento') : ''}}</small></label>
                <input type="date" name="data_nascimento" value="{{ $cliente->data_nascimento ?? old('data_nascimento') }}" id="data_abertura">
            </div>

            <div class="form-grupo">
                <label for="cpf">CPF/CNPJ<small>{{ $errors->has('documento') ? $errors->first('documento') : ''}}</small></label>
                <input type="text" name = "documento" value="{{$cliente->documento ?? old('documento') }}" id="cpf">
            </div>

            <div class="form-grupo">
                <label for="sexo">Sexo<small>{{ $errors->has('sexo') ? $errors->first('sexo') : ''}}</small></label>
                <select name="sexo" id="sexo">
                    <option value="1" {{isset($cliente->sexo) && $cliente->sexo == 1 ? 'selected': ''}}>Masculino</option>
                    <option value="2" {{isset($cliente->sexo) && $cliente->sexo  == 2 ? 'selected': ''}}>Feminino</option>
                    <option value="3" {{isset($cliente->sexo) && $cliente->sexo  == 3 ? 'selected': ''}}>Outros</option>
                </select>
            </div>

            <div class="form-grupo">
                <label for="cep">Cep<small>{{ $errors->has('cep') ? $errors->first('cep') : ''}}</small></label>
                <input onblur="pesquisarCep()" type="text" name="cep" value="{{ $cliente->cep ?? old('cep') }}" id="cep">
            </div>

            <div class="form-grupo">
                <label for="cidade">Cidade<small>{{ $errors->has('cidade') ? $errors->first('cidade') : ''}}</small></label>
                <input type="text" name="cidade" value="{{$cliente->cidade ?? old('cidade') }}" id="cidade">
            </div>

            <div class="form-grupo">
                <label for="bairro">Bairro<small>{{ $errors->has('bairro') ? $errors->first('bairro') : ''}}</small></label>
                <input type="text" name="bairro"  value="{{$cliente->bairro ?? old('bairro') }}"id="bairro">
            </div>

            <div class="form-grupo">
                <label for="logradouro">Logradouro<small>{{ $errors->has('logradouro') ? $errors->first('logradouro') : ''}}</small></label>
                <input type="text" name="logradouro"  value="{{$cliente->logradouro ?? old('logradouro') }}" id="logradouro">
            </div>

            <div class="form-grupo">
                <label for="logradouro">Uf<small>{{ $errors->has('uf') ? $errors->first('uf') : ''}}</small></label>
                <input type="text" name="uf"  value="{{$cliente->uf ?? old('uf') }}" id="uf">
            </div>

            <div class="grupo-botoes">
                <button onclick="voltar('cliente')" type="button">
                    <img src="{{ asset('icones/angle-left-solid.svg') }}" alt="">
                    <span>Voltar</span>
                </button>
                <button>
                    <img src="{{ asset('icones/save.svg') }}" alt="">
                    <span>Salvar</span>
                </button>
            </div>

        </form>
    </section>
@endsection