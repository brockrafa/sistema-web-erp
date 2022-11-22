@extends('layouts.layout_default')
@section('conteudo')
<section id="header-secao">
    <h4>
        <img src="{{ asset('icones/icone-checklist.svg') }}">
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
        

        {{-- <div class="form-grupo ordernar-filtro"> 
            <label for="">Ordenar por</label>
            <select name="" id="">
                <option value="">Data de vencimento</option>
                <option value="">Status pendente</option>
                <option value="">Status pago</option>
                <option value="">Vencido</option>
            </select>
        </div>--}}

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
            <form action="" method="POST" id="form-receber-conta">
                @csrf
    
    
                <div class="form-grupo">
                    <label for="valor_parcela">Valor da parcela<small>{{ $errors->has('valor_parcela') ? $errors->first('valor_parcela') : ''}}</small></label>
                    <input type="text" name="valor_parcela"  id="valor_parcela">
                </div>
    
                <div class="form-grupo">
                    <label for="valor_pago">Valor pago<small>{{ $errors->has('valor_pago') ? $errors->first('valor_pago') : ''}}</small></label>
                    <input type="text" name = "valor_pago"  id="valor_pago">
                </div>

                <div class="form-grupo">
                    <label for="data_vencimento">Data vencimento<small>{{ $errors->has('data_vencimento') ? $errors->first('data_vencimento') : ''}}</small></label>
                    <input type="date" name = "data_vencimento"  id="data_vencimento">
                </div>

                <div class="form-grupo">
                    <label for="data_pagamento">Data pagamento<small>{{ $errors->has('data_pagamento') ? $errors->first('data_pagamento') : ''}}</small></label>
                    <input type="date" name = "data_pagamento"  id="data_pagamento">
                </div>
    
                <div class="grupo-botoes">
                    <button onclick="voltar('cliente')" type="button">
                        <img src="{{ asset('icones/angle-left-solid.svg') }}" alt="">
                        <span>Voltar</span>
                    </button>
                    <button>
                        <img src="{{ asset('icones/dollar.svg') }}" alt="">
                        <span>Receber</span>
                    </button>
                </div>
    
            </form>
        </section>
    </div>
</div>
@endsection