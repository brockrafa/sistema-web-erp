@extends('layouts.layout_default')
@section('conteudo')
    <section id="header-secao-adicionar">
        <h4>
            <img src="{{ asset('icones/icone-checklist.svg') }}">
            <span>Novo Cliente</span>
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