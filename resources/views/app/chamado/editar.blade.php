@extends('layouts.layout_default')
@section('conteudo')
    <section id="header-secao-adicionar">
        <h4>
            <!-- <img src="{{ asset('icones/icone-checklist.svg') }}"> -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path  d="M256 48C141.1 48 48 141.1 48 256v40c0 13.3-10.7 24-24 24s-24-10.7-24-24V256C0 114.6 114.6 0 256 0S512 114.6 512 256V400.1c0 48.6-39.4 88-88.1 88L313.6 488c-8.3 14.3-23.8 24-41.6 24H240c-26.5 0-48-21.5-48-48s21.5-48 48-48h32c17.8 0 33.3 9.7 41.6 24l110.4 .1c22.1 0 40-17.9 40-40V256c0-114.9-93.1-208-208-208zM144 208h16c17.7 0 32 14.3 32 32V352c0 17.7-14.3 32-32 32H144c-35.3 0-64-28.7-64-64V272c0-35.3 28.7-64 64-64zm224 0c35.3 0 64 28.7 64 64v48c0 35.3-28.7 64-64 64H352c-17.7 0-32-14.3-32-32V240c0-17.7 14.3-32 32-32h16z"/></svg>
            <span>Atualização de chamado</span>
        </h4>
        <button type="button" class="btn-limpar" onclick="limparNovoChamado()">
            <img src="{{ asset('icones/lixeira.svg') }}" alt="">
            <span>Limpar</span>
        </button>
    </section>
    @if (isset($msg) && $msg !='')
        <div class="alerta alerta-sucesso">
            {{$msg}}
        </div>
    @endif

    <section class="body-secao" id="novo-chamado">
        <form action="{{ route('app.chamado.armazenar') }}" method="POST">
            @csrf
            <input type="hidden" value="{{$chamado->id}}" name="id">
            
            <div class="form-grupo">
                <label for="cliente">Cliente</label>
                <select disabled name="cliente" id="cliente">
                    <option value="{{$chamado->cliente->id}}" >{{$chamado->cliente->nome}}</option>
                </select>
            </div>

            <div class="form-grupo">
                <label for="data_abertura">Data abertura<small>{{ $errors->has('data_abertura') ? $errors->first('data_abertura') : ''}}</small></label>
                <input name="data_abertura" disabled value="{{$chamado->data_abertura ?? old('data_abertura')}}" type="date" id="data_abertura">
            </div>
            
            <div class="form-grupo">
                <label for="data_modificacao">Data ultima modificação<small>{{ $errors->has('data_modificacao') ? $errors->first('data_modificacao') : ''}}</small></label>
                <input name="updated_at" disabled value="{{date('Y-m-d',  strtotime($chamado->updated_at)) ?? old('data_modificacao')}}" type="date" id="data_modificacao">
            </div>

            <div class="form-grupo">
                <label for="setor">Setor responsável</label>
                <select name="setor" id="setor">
                    <option value="1" {{$chamado->setor == 1 ? 'selected':''}}>Suporte tecnico</option>
                    <option value="2" {{$chamado->setor == 2 ? 'selected':''}}>Manutenção</option>
                    <option value="3" {{$chamado->setor == 3 ? 'selected':''}}>Acesso remoto</option>
                    <option value="4" {{$chamado->setor == 4 ? 'selected':''}}>Tecnico de rua</option>
                </select>
            </div>

            <div class="form-grupo">
                <label for="tipo">Tipo problema</label>
                <select name="tipo_problema" id="tipo">
                    <option value="1" {{$chamado->tipo_problema == 1 ? 'selected':''}}>Software</option>
                    <option value="2" {{$chamado->tipo_problema == 2 ? 'selected':''}}>Hardware</option>
                    <option value="3" {{$chamado->tipo_problema == 3 ? 'selected':''}}>Configuração</option>
                </select>
            </div>

            <div class="form-grupo">
                <label for="prioridade">Nivel prioridade</label>
                <select name="prioridade" id="prioridade">
                    <option value="1" {{$chamado->prioridade == 1 ? 'selected':''}}>Baixo</option>
                    <option value="2" {{$chamado->prioridade == 2 ? 'selected':''}}>Medio</option>
                    <option value="3" {{$chamado->prioridade == 3 ? 'selected':''}}>Alto</option>
                </select>
            </div>

            <div class="form-grupo">
                <label for="responsavel">Usuario responsavel</label>
                <select name="id_responsavel" id="responsavel">
                    <option value="">Selecione um responsavel</option>
                    @foreach ($usuarios as $usuario)
                        <option value="{{$usuario->id}}" {{ ($chamado->id_responsavel == $usuario->id) || ($usuario->id == old('id_responsavel') ) ? 'selected' : ''  }}>{{$usuario->nome}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-grupo">
                <label for="status">Status atual</label>
                <select name="id_status_chamado" id="status">
                    @foreach ($status as $state)
                        <option value="{{ $state->id }}" {{ ($chamado->id_status_chamado == $state->id) || ($state->id == old('id_status_chamado')) ? 'selected' : ''  }}>
                            {{ $state->status }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-grupo full">
                <label for="problema">Descrição do chamado <small>{{ $errors->has('problema') ? $errors->first('problema') : ''}}</small></label>
                <textarea  style="background-color: rgb(229, 229, 229)" disabled name="problema" id="problema" rows="8">{{$chamado->problema ?? old('problema')}}</textarea>
            </div>
    
            <div class="form-grupo full">
                <label for="descricao">Descrição de atualização no chamado<small>{{ $errors->has('update_descricao') ? $errors->first('update_descricao') : ''}}</small></label>
                <textarea name="update_descricao" id="descricao" rows="10" placeholder="Ex: Foi solicitado a troca da peça X">{{old('update_descricao')}}</textarea>
            </div>
            <button type="button" id="btn-visualizar-atualizacoes">
                <img src="{{ asset('icones/eye-solid.svg') }}" alt="">
                <span>Visualizar atualizações</span>
            </button>

            <div class="grupo-botoes">
                <button type="button" onclick="voltar('chamado')">
                    <img src="{{ asset('icones/angle-left-solid.svg') }}" alt="">
                    <span>Voltar</span>
                </button>
                <button type="sumbit">
                    <img src="{{ asset('icones/save.svg') }}" alt="">
                    <span>Salvar</span>
                </button>
            </div>

        </form>
    </section>
@endsection