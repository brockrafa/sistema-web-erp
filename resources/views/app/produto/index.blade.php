@extends('layouts.layout_default')
@section('conteudo')
    <section id="header-secao">
        <h4>
            <img src="{{ asset('icones/icone-checklist.svg') }}">
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