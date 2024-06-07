@extends('layouts.layout_default')
@section('conteudo')
    <section id="header-secao-adicionar">
        <h4>
            <!-- <img src="{{ asset('icones/icone-checklist.svg') }}"> -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M58.9 42.1c3-6.1 9.6-9.6 16.3-8.7L320 64 564.8 33.4c6.7-.8 13.3 2.7 16.3 8.7l41.7 83.4c9 17.9-.6 39.6-19.8 45.1L439.6 217.3c-13.9 4-28.8-1.9-36.2-14.3L320 64 236.6 203c-7.4 12.4-22.3 18.3-36.2 14.3L37.1 170.6c-19.3-5.5-28.8-27.2-19.8-45.1L58.9 42.1zM321.1 128l54.9 91.4c14.9 24.8 44.6 36.6 72.5 28.6L576 211.6v167c0 22-15 41.2-36.4 46.6l-204.1 51c-10.2 2.6-20.9 2.6-31 0l-204.1-51C79 419.7 64 400.5 64 378.5v-167L191.6 248c27.8 8 57.6-3.8 72.5-28.6L318.9 128h2.2z"/></svg>
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