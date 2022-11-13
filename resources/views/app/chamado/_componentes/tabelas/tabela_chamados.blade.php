<div class="">
    <table id="tabela-default">
        <thead>
        <tr>
            <th scope="col">Titulo</th>
            <th scope="col">Data abertura</th>
            <th scope="col">Cliente</th>
            <th scope="col">Status</th>
            <th scope="col">Responsável</th>
            <th scope="col">Ações</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($chamados as $chamado)
                <tr>
                    <td>{{ $chamado->titulo }}</td>
                    <td>{{ date('d/m/Y',strtotime($chamado->data_abertura)); }}</td>
                    <td>{{ $chamado->cliente->nome }}</td>
                    <td>
                        <span class="status-table" style="color:{{$chamado->statusChamado->font_color}};background-color:{{$chamado->statusChamado->background_color}}">
                            {{ $chamado->statusChamado->status }}
                        </span>
                    </td>
                    <td>{{ $chamado->responsavel->nome ?? 'Não definido'}}</td>
                    <td>
                        <a href="{{route('app.chamado.editar',['id'=>$chamado->id] )}}">
                            <button class="view">
                                <img src="{{ asset('icones/lapis.svg') }}" alt="">
                            </button>
                        </a>
                        <button class="delete">
                            <a href="">
                                <img src="{{ asset('icones/lixeira.svg') }}" alt="">
                            </a>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="paginacao">{{$chamados->appends($request->all())->links()}}</div>
</div>