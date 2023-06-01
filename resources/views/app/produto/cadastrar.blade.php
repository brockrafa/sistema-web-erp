@extends('layouts.layout_default')
@section('conteudo')
    <section id="header-secao-adicionar">
        <h4>
            <img src="{{ asset('icones/icone-checklist.svg') }}">
            <span>Cadastrar produto ou serviço</span>
        </h4>
        <button type="button" class="btn-limpar" onclick="limparNovoChamado()">
            <img src="{{ asset('icones/lixeira.svg') }}" alt="">
            <span>Limpar</span>
        </button>
    </section>

    <section class="body-secao form-default"  id="novo-chamado">
        <form action="{{ route('app.produto.cadastrar.store') }}" method="POST">
            @csrf
            <div class="form-grupo">
                <label for="produto">Nome do produto/serviço<small>{{ $errors->has('produto') ? $errors->first('produto') : ''}}</small></label>
                <input type="text"  value="{{old('produto')}}" placeholder="Ex: Notebook Dell I5" name="produto" id="produto">

            </div>
           
            <div class="form-grupo">
                <label for="titulo">Preço do produto<small>{{ $errors->has('preco') ? $errors->first('preco') : ''}}</small></label>
                <input type="text"  value="{{old('preco')}}" placeholder="Ex: R$1219,99" name="preco" id="preco">
            </div>

            <div class="form-grupo">
                <label for="titulo">Quantidade atual em estoque<small>{{ $errors->has('quantidade') ? $errors->first('quantidade') : ''}}</small></label>
                <input type="number"  value="{{old('quantidade') ?? 1}}" placeholder="Ex: 0" name="quantidade" id="quantidade">
            </div>

            <div class="form-grupo">
                <label for="titulo">Disponivel para venda<small>{{ $errors->has('quantidade') ? $errors->first('quantidade') : ''}}</small></label>

                <div class="switch__container" style="margin-top:10px">
                    <input id="switch-shadow" class="switch switch--shadow" type="checkbox" checked name="disponivel">
                    <label for="switch-shadow"></label>
                </div>
            </div>

            <div class="grupo-botoes">
                <button type="button">
                    <img src="{{ asset('icones/angle-left-solid.svg') }}" alt="">
                    <span>Voltar</span>
                </button>
                <button>
                    <img src="{{ asset('icones/save.svg') }}" alt="">
                    <span>Cadastrar</span>
                </button>
            </div>

        </form>
    </section>
@endsection