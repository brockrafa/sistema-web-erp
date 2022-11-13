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
            @foreach ($status as $state)
                <tr id="status_{{$state->id}}">
                    <td>#</td>
                    <td>#</td>
                    <td>#</td>
                    <td>
                        <span class="status-table" style="color:{{$state->font_color}};background-color:{{$state->background_color}}">
                            {{ $state->status }}
                        </span>
                    </td>
                    <td>#</td>
                    <td>
                        <a href="{{route('configuracao.status.edit',['id'=>$state->id])}}">
                            <button class="view">
                                <img src="{{ asset('icones/lapis.svg') }}" alt="">
                            </button>
                        </a>
                        <button class="delete" type="button" onclick="deleteStatus('{{$state->id}}')">
                            <a href="">
                                <img src="{{ asset('icones/lixeira.svg') }}" alt="">
                            </a>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>