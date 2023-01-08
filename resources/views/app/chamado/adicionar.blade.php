@extends('layouts.layout_default')
@section('conteudo')
    <section id="header-secao-adicionar">
        <h4>
            <img src="{{ asset('icones/icone-checklist.svg') }}">
            <span>Novo chamado</span>
        </h4>
        <button type="button" class="btn-limpar" onclick="limparNovoChamado()">
            <img src="{{ asset('icones/lixeira.svg') }}" alt="">
            <span>Limpar</span>
        </button>
    </section>

    <section class="body-secao" id="novo-chamado">
        <form action="{{ route('app.novo_chamado') }}" method="POST">
            @csrf
            <div class="form-grupo">
                <label for="cliente">Cliente<small>{{ $errors->has('id_cliente') ? $errors->first('id_cliente') : ''}}</small></label>
                <select name="id_cliente" id="cliente">
                    <option value="">Selecione um cliente</option>
                    @foreach ($clientes as $cliente)
                        <option value="{{$cliente->id}}" {{ old('id_cliente') && $cliente->id == old('id_cliente') ? 'selected' : '' }} >{{$cliente->nome}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-grupo">
                <label for="data_abertura">Data abertura<small>{{ $errors->has('data_abertura') ? $errors->first('data_abertura') : ''}}</small></label>
                <input name="data_abertura" value="{{date('Y-m-d') ?? old('data_abertura')}}" type="date" id="data_abertura">
            </div>

            <div class="form-grupo">
                <label for="setor">Setor responsável</label>
                <select name="setor" id="setor">
                    <option value="1">Suporte tecnico</option>
                    <option value="2">Manutenção</option>
                    <option value="3">Acesso remoto</option>
                    <option value="4">Tecnico de rua</option>
                </select>
            </div>

            <div class="form-grupo">
                <label for="tipo">Tipo problema</label>
                <select name="tipo_problema" id="tipo">
                    <option value="1">Software</option>
                    <option value="2">Hardware</option>
                    <option value="3">Configuração</option>
                </select>
            </div>

            <div class="form-grupo">
                <label for="prioridade">Nivel prioridade</label>
                <select name="prioridade" id="prioridade">
                    <option value="1">Baixo</option>
                    <option value="2">Medio</option>
                    <option value="3">Alto</option>
                </select>
            </div>

            <div class="form-grupo">
                <label for="responsavel">Atendente responsavel</label>
                <select name="id_responsavel" id="responsavel">
                    <option value="">Selecione um responsavel</option>
                    @foreach ($usuarios as $usuario)
                        <option value="{{$usuario->id}}">{{$usuario->nome}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-grupo">
                <label for="status">Status após abertura</label>
                <select name="id_status_chamado" id="status">
                    @foreach ($status as $state)
                        <option value="{{ $state->id }}" {{ old('id_status_chamado') && $state->id == old('id_status_chamado') ? 'selected' : '' }}>{{ $state->status }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-grupo">
                <label for="titulo">Titulo do chamado<small>{{ $errors->has('titulo') ? $errors->first('titulo') : ''}}</small></label>
                <input type="text"  value="{{old('titulo')}}" placeholder="Ex: Impressora parou de imprimir" name="titulo" id="titulo">
            </div>
            
            <div class="form-grupo full">
                <label for="descricao">Descrição do problema<small>{{ $errors->has('problema') ? $errors->first('problema') : ''}}</small></label>
                <textarea name="problema" id="descricao" rows="10">{{old('problema')}}</textarea>
            </div>

            <div class="grupo-botoes">
                <button type="button">
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