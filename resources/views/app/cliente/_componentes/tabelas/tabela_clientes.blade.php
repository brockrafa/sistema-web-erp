<div class="">
    <table id="tabela-default">
        <thead>
        <tr>
            <th scope="col">Nome</th>
            <th scope="col">Documento</th>
            <th scope="col">Cidade</th>
            <th scope="col">Cep</th>
            <th scope="col">Ações</th>
        </tr>
        </thead>
        <tbody>

            @foreach ($clientes as $cliente)
                
                <tr id="cliente_{{$cliente->id}}">
                    <td>{{$cliente->nome}}</td>
                    <td>{{$cliente->documento}}</td>
                    <td>{{$cliente->cidade}}</td>
                    <td>{{$cliente->cep}}</td>
                    <td>
                        <button onclick="editar({{$cliente->id}})" class="view">
                            <img src="{{ asset('icones/lapis.svg') }}" alt="">
                        </button>
                        <button class="delete" onclick="deleteCliente({{$cliente->id}})">
                            <img src="{{ asset('icones/lixeira.svg') }}" alt="">
                        </button>
                    </td>
                </tr>
           
            @endforeach
            
        </tbody>
    </table>
    <div class="paginacao">{{$clientes->appends($filters)->links()}}</div>
</div>