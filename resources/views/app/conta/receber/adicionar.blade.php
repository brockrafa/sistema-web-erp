@extends('layouts.layout_default')
@section('conteudo')

    <section id="header-secao">
        <h4>
            <img src="{{ asset('icones/icone-checklist.svg') }}">
            <span>Contas a receber</span>
        </h4>
    </section>

    <form id="modalNovaContaReceber" action="{{ route('contas.receber.store') }}" method="POST">
        @csrf

        <section class="body-secao">
            <div class="titulo-subsection"> 
                Dados da venda
            </div>

            <div class="form-section">

                <div class="form-grupo lista-autocomplete-input-teste">
                    <label for="lista-clientes-input">Cliente<small id="avisoInputClienteNovaContaReceber">{{ $errors->has('cliente') ? $errors->first('cliente') : ''}}</small></label>

                    <input value="{{old('cliente')}}" required autocomplete="off" onkeyup="verificaCampo('lista-clientes',true)" class="lista-autocomplete-input"  id="lista-clientes-input">
                    <input name="cliente" type="hidden" id="lista-clientes-input-hiden">

                    <img id="autoselect-arrow-down-lista-clientes"  class="autoselect-arrow-down" src="/icones/arrow-down.svg" alt="">
                    <div id="lista-clientes" class="lista-autocomplete">
                        <span>Digite o nome de um cliente</span>
                    </div>
                </div>

                <div class="form-grupo">
                    <label for="valor_total">
                        Valor total
                        <small>{{ $errors->has('valor_total_itens') ? $errors->first('valor_total_itens') : ''}}</small>
                    </label>
                    <input value="{{old('valor_total_itens')}}" required type="text" name="valor_total" id="valor_total"  disabled>
                </div>

                <div class="form-grupo">
                    <label for="data_venda">
                        Data da venda
                    </label>
                    <input required type="date" disabled id="data-venda">
                </div>

                <div class="form-grupo">
                    <label for="usuario_id">
                        Usuario responsavel
                        <small></small>
                    </label>
                    <input value="{{$_SESSION['nome'] }}" required disabled  onkeyup="verificaCampo('lista-usuarios',true)" class="lista-autocomplete-input" id="lista-usuarios-input">
                </div>
            </div>
        </section>

        <section class="body-secao">
            <div class="titulo-subsection"> 
                Itens da venda
            </div>
            <div class="form-section">
                <input required required type="hidden"  name="valor_total_itens" id="valor_total_itens">
                <div class="form-grupo w-flex">
                    <label for="nome_item_add">
                        Produto/Serviço
                        <small>{{ $errors->has('valor_total_itens') ? 'Insira pelo menos 1 produto' : ''}}</small>
                    </label>
                    <input type="text" id="nome_item_add">
                </div>
                <div class="form-grupo w-flex">
                    <label for="valor_item_add">
                        Valor do item
                        <small></small>
                    </label>
                    <input type="number" id="valor_item_add">
                </div>
                <div class="form-grupo w-flex">
                    <label for="quantidade_item_add">
                        Quantidade
                        <small></small>
                    </label>
                    <input type="number" id="quantidade_item_add" value="1">
                </div>
                <div class="grupo-botoes btn-right">
                    <button type="button" class="btn-default" onclick="adicionarItemContaReceber()">
                        <img src="{{ asset('icones/add.svg') }}" alt="">
                        <span>Adicionar item</span>
                    </button>
                </div>
            </div>
            <hr style="margin:40px 0px;border: 1px solid rgb(222, 222, 222)">
            <div class="tabela-tamanho-fixo">
                <table id="tabela-default">
                    <thead>
                    <tr>
                        <th scope="col">Produto/Serviço</th>
                        <th scope="col">Valor unitário</th>
                        <th scope="col">Quantidade</th>
                        <th scope="col">Valor total</th>
                        <th scope="col">Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr id="tabela-vazia"><td style="text-align: center;padding:40px 0" colspan="6">
                            <h3> Nenhum item adicionado</h3>
                        </td></tr>
                    </tbody>
                </table>
            </div>
        </section>

        <section class="body-secao">
            <div class="titulo-subsection"> 
                Meio de pagamento
            </div>
            <div class="form-section">
                <div class="form-grupo w-flex">
                    <label for="forma-pagamento">
                        Forma de pagamento
                    </label>
                    <select required id="forma-pagamento" name="meio_pagamento">
                        <option value="">Selecione uma forma de pagamento</option>
                        <option value="601">A vista</option>
                        <option value="900">Cartão de crédito</option>
                        <option value="600">Cartão de débito</option>
                        <option value="602">PIX</option>
                        <option value="901">Dinheiro parcelado</option>
                    </select>
                </div>
                <div class="form-grupo w-flex">
                    <label for="qtd_parcelas">
                        Número de parcelas
                    </label>
                    <select required id="qtd-parcelas" name="qtd_parcelas" disabled></select>
                </div>
                {{-- <div class="form-grupo w-flex"> 
                    <label for="data_primeira_parcela">
                        Data primeira parcela
                    </label>
                    <input disabled required type="date" name="data_primeira_parcela" id="data-primeira-parcela">
                </div>--}}
                <div class="form-grupo w-flex">
                    <label for="data_vencimento" id="label-data-vencimento">
                        Data de vencimento
                    </label>
                    <input required type="date" name="data_vencimento" id="data-vencimento">
                </div>
                <div class="grupo-botoes" style="margin-top: 70px">
                    <button onclick="voltar('contas/receber')" type="button">
                        <img src="{{ asset('icones/angle-left-solid.svg') }}" alt="">
                        <span>Voltar</span>
                    </button>
                    <button onclick="finalizarNovaConta('modalNovaContaReceber',event)">
                        <img src="{{ asset('icones/save.svg') }}" alt="">
                        <span>Finalizar conta</span>
                    </button>
                </div>
            </div>
        </section>

    </form>

@endsection