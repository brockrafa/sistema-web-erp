@extends('layouts.layout_default')
@section('conteudo')
    <section id="header-secao">
        <h4>
            <!-- <img src="{{ asset('icones/icone-checklist.svg') }}"> -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M58.9 42.1c3-6.1 9.6-9.6 16.3-8.7L320 64 564.8 33.4c6.7-.8 13.3 2.7 16.3 8.7l41.7 83.4c9 17.9-.6 39.6-19.8 45.1L439.6 217.3c-13.9 4-28.8-1.9-36.2-14.3L320 64 236.6 203c-7.4 12.4-22.3 18.3-36.2 14.3L37.1 170.6c-19.3-5.5-28.8-27.2-19.8-45.1L58.9 42.1zM321.1 128l54.9 91.4c14.9 24.8 44.6 36.6 72.5 28.6L576 211.6v167c0 22-15 41.2-36.4 46.6l-204.1 51c-10.2 2.6-20.9 2.6-31 0l-204.1-51C79 419.7 64 400.5 64 378.5v-167L191.6 248c27.8 8 57.6-3.8 72.5-28.6L318.9 128h2.2z"/></svg>
            <span>Produtos</span>
        </h4>
        <a href="{{ route('app.produto.cadastrar') }}">
            <img src="{{ asset('icones/add.svg') }}" alt="">
            <span>Cadastrar produto</span>
        </a>
    </section>

    @if (isset($msg) && $msg != '')
    <div class="alerta alerta-sucesso">
        <p>{{$msg}}</p>
    </div>
    @endif

    <section  class="body-secao table">
        <div class="">
            <table id="tabela-default">
                <thead>
                    <tr>
                        <th scope="col">Produto</th>
                        <th scope="col">Preço</th>
                        <th scope="col">Quantidade</th>
                        <th scope="col">Disponível</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($produtos as $produto)
                        <tr>
                            <td>{{$produto->produto}}</td>
                            <td>R${{$produto->preco}}</td>
                            <td>{{$produto->quantidade}}</td>
                            <td>
                                <form id="form-atualiza-status-produto-{{$produto->id}}">
                                    <div class="switch__container" style="">
                                            @csrf
                                            <input type="hidden" value="{{$produto->id}}" name="produto">    
                                            <input onChange="alterarStatusProduto({{$produto->id}},event)" id="switch-shadow-{{$produto->id}}" class="switch switch--shadow" type="checkbox" name="disponivel" {{$produto->disponibilidade ? 'checked' : ''}}>
                                            <label for="switch-shadow-{{$produto->id}}"></label>
                                    </div>
                                </form>
                            </td>
                            <td>
                                <button onclick="" class="view">
                                    <img src="{{ asset('icones/lapis.svg') }}" alt="">
                                </button>
                                <button class="delete" onclick="">
                                    <img src="{{ asset('icones/lixeira.svg') }}" alt="">
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        <div class="paginacao"></div>
    </section>
@endsection