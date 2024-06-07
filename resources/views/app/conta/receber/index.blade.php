@extends('layouts.layout_default')
@section('conteudo')
    <section id="header-secao">
        <h4>
            <!-- <img src="{{ asset('icones/icone-checklist.svg') }}"> -->
            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="clipboard-list" class="svg-inline--fa fa-clipboard-list fa-w-12" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M336 64h-80c0-35.3-28.7-64-64-64s-64 28.7-64 64H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48zM96 424c-13.3 0-24-10.7-24-24s10.7-24 24-24 24 10.7 24 24-10.7 24-24 24zm0-96c-13.3 0-24-10.7-24-24s10.7-24 24-24 24 10.7 24 24-10.7 24-24 24zm0-96c-13.3 0-24-10.7-24-24s10.7-24 24-24 24 10.7 24 24-10.7 24-24 24zm96-192c13.3 0 24 10.7 24 24s-10.7 24-24 24-24-10.7-24-24 10.7-24 24-24zm128 368c0 4.4-3.6 8-8 8H168c-4.4 0-8-3.6-8-8v-16c0-4.4 3.6-8 8-8h144c4.4 0 8 3.6 8 8v16zm0-96c0 4.4-3.6 8-8 8H168c-4.4 0-8-3.6-8-8v-16c0-4.4 3.6-8 8-8h144c4.4 0 8 3.6 8 8v16zm0-96c0 4.4-3.6 8-8 8H168c-4.4 0-8-3.6-8-8v-16c0-4.4 3.6-8 8-8h144c4.4 0 8 3.6 8 8v16z"></path></svg>
            <span>Contas a receber</span>
        </h4>
        <a href="{{ route('contas.receber.create') }}">
            <img src="{{ asset('icones/add.svg') }}" alt="">
            <span>Nova conta</span>
        </a>
    </section>


    @if (isset($msg) && $msg != '')
    <div class="alerta alerta-sucesso">
        <p>{{$msg}}</p>
    </div>
    @endif

    <section id="filtro-contas" class="body-secao">
        <div id="titulo-filtro-chamados">
            <img src="{{ asset('icones/lupa.svg') }}" alt="">
            <span>Filtro</span> 
        </div>
        <form action="{{ route('contas.receber.index') }}" method="POST">
            @csrf

            <div class="form-grupo-cliente-filtro">
                <label for="">Nome cliente </label>
                <input autocomplete="off"  type="text" name='nome_cliente' id="nome_cliente" value=" {{ $cliente  ?? $cliente }}">
            </div>

            <div class="form-grupo ordernar-filtro">
                <label for="">Exibir: </label>
                <select name="exibicao" id="modo-exibicao">
                    <option value="0" >Este mês</option>
                    <option value="1" {{ $exibicao == 1 ? 'selected' : ''}}>Proximo mês</option>
                    <option value="7" {{ $exibicao == 7 ? 'selected' : ''}}>Proximos 7 dias</option>
                    <option value="15" {{ $exibicao == 15 ? 'selected' : ''}}>Proximos 15 dias</option>
                    <option value="90" {{ $exibicao == 90 ? 'selected' : ''}}>Todos registros</option>
                </select>
            </div>

            <div class="form-grupo ordernar-filtro">
                <label for="">Status: </label>
                <select name="status" id="modo-exibicao-status">
                    <option value="">Sem filtro</option>
                    <option value="91" {{ $status == 91 ? 'selected' : ''}}>Pagamento pendente</option>
                    <option value="92" {{ $status == 92 ? 'selected' : ''}}>Pagamento realizado</option>
                </select>
            </div>

            <div class="grupo-botoes form-grupo-cliente-filtro">
                <button >
                    Filtrar 
                </button>
            </div>
        </form>

        <section  class="table"> 
            @component('app.conta.receber._componentes.tabela_contas_receber',['contas'=>$contas,'request'=>$request])@endcomponent
        </section>

    </section>

    <div id="modalReceberConta" class="modal-area">
        <div class="modal">
            <section class="modal-titulo">
                <img src="{{ asset('icones/dollar.svg') }}" alt="">
                <p>Receber conta</p>
            </section>

            <section class="modal-btn-fechar">
                <img onclick="fecharModal()" src="{{ asset('icones/fechar-x.svg') }}" alt="">
            </section>

            <section class="form-modal">
                <form method="POST" action="{{ route('contas.receber.receiveStore') }}" id="form-receber-conta">
                    @csrf

                <input type="hidden" name="id"  id="id_conta">
                <input type="hidden" name="decisao_conta"  id="decisao-conta">
        
                <div class="form-grupo">
                        <label for="cliente_nome">Nome cliente</label>
                        <input type="text" disabled  id="cliente_nome">
                    </div>

                    <div class="form-grupo">
                        <label for="valor_parcela">Valor da parcela<small>{{ $errors->has('valor_parcela') ? $errors->first('valor_parcela') : ''}}</small></label>
                        <input type="text"  disabled id="valor_parcela">
                    </div>
        
                    <div class="form-grupo">
                        <label for="valor_pago">Valor pago<small>{{ $errors->has('valor_pago') ? $errors->first('valor_pago') : ''}}</small></label>
                        <input type="text" required name = "valor_pago"  id="valor_pago">
                    </div>

                    <div class="form-grupo">
                        <label for="data_vencimento">Data vencimento<small>{{ $errors->has('data_vencimento') ? $errors->first('data_vencimento') : ''}}</small></label>
                        <input type="datetime" disabled  id="data_vencimento">
                    </div>

                    <div class="form-grupo">
                        <label for="data_pagamento">Data pagamento<small>{{ $errors->has('data_pagamento') ? $errors->first('data_pagamento') : ''}}</small></label>
                        <input type="date" required name ="data_pagamento"  id="data_pagamento">
                    </div>
        
                    <div class="grupo-botoes">
                        <button onclick="fecharModal()" type="button">
                            <span>Fechar</span>
                        </button>
                        <button id="btnFormReceberConta">
                            <img src="{{ asset('icones/dollar.svg') }}" alt="">
                            <span>Receber</span>
                        </button>
                    </div>
                </form>
            </section>
        </div>
    </div>

    <div id="modal-escolha" class="modal-escolha-area">
        <div class="modal">
            <section class="modal-titulo">
                {{-- <img src="{{ asset('icones/dollar.svg') }}" alt=""> --}}
                <p>Receber conta</p>
            </section>

            <section class="modal-btn-fechar">
                <img onclick="fecharModal('escolha-')" src="{{ asset('icones/fechar-x.svg') }}" alt="">
            </section>

            <section class="secao-modal-confirmacao">
                <div id="mensagem-modal-confirmacao">
                    <p>
                        <span class="texto-alerta">O valor recebido é menor do que o valor da parcela atual.</span><br>
                        Deseja manter a conta deste mês aberta ou passar a diferença para as proximas parcelas?
                    </p>
                </div>
                <div id="grupo-botoes-modal-confirmacao" class="grupo-botoes">
                    <button onclick="escolhaContaModal('manter')" type="button">
                        <span>Manter conta aberta</span>
                    </button>
                    <button onclick="escolhaContaModal('passar')" type="button">
                        <span>Passar para proximas parcelas</span>
                    </button>
                </div>
            </section>

        </div>
    </div>


    @component('componentes.modal',['titulo' =>'Visualizar conta','modalId'=>'visualizarConta'])
        @slot('bodyModal')
            <form method="POST" action="" id="form-receber-conta">

                <div class="form-grupo">
                    <label for="cliente_nome">Nome cliente</label>
                    <input type="text" disabled  id="cliente_nome_view">
                </div>

                <div class="form-grupo">
                    <label for="valor_parcela">Valor da parcela<small>{{ $errors->has('valor_parcela') ? $errors->first('valor_parcela') : ''}}</small></label>
                    <input type="text"  disabled id="valor_parcela_view">
                </div>

                <div class="form-grupo">
                    <label for="data_vencimento">Data vencimento</label>
                    <input type="datetime" disabled  id="data_vencimento_view">
                </div>

                <div class="form-grupo">
                    <label for="">Data pagamento</label>
                    <input type="datetime" disabled  id="data_pagamento_view">
                </div>

                <div class="form-grupo">
                    <label for="valor_pago">Valor recebido</label>
                    <input type="text"  disabled id="valor_pago_view">
                </div>

                <div class="form-grupo">
                    <label for="data_vencimento">Parcelas</label>
                    <input type="text" disabled  id="quantidade_parcelas_view">
                </div>
                
            </form>
        @endslot

        @slot('footerModal')
            <div class="grupo-botoes">
                <button onclick="fecharModal()" type="button">
                    <span>Fechar</span>
                </button>
            </div>
        @endslot

    @endcomponent


@endsection

@section('scripts')
    <script src="{{ asset('js/contas/contas.js') }}"></script>   
@endsection