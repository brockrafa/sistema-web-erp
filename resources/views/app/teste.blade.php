@extends('layouts.layout_default')
@section('conteudo')

<button id="" onclick="$('#modal-escolha').show()">
    <img src="{{ asset('icones/dollar.svg') }}" alt="">
    <span>Receber</span>
</button>


@component('componentes.modal',['titulo' => 'Modal novo','modalId'=>'modalTeste'])
    @slot('bodyModal')

        <div class="texto">
            <p>
                <span class="texto-alerta">O valor recebido é menor do que o valor da parcela atual.</span><br>
                Deseja manter a conta deste mês aberta ou passar a diferença para as proximas parcelas?
            </p>
        </div>
    @endslot

    @slot('footerModal')
        <div id="grupo-botoes-modal-confirmacao" class="grupo-botoes">
            <button onclick="alert('cancela')" type="button">
                <span>Cancelar</span>
            </button>
            <button onclick="alert('confirma')" type="button">
                <span>Confirmar</span>
            </button>
        </div>
    @endslot

@endcomponent

@endsection