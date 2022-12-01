<div class="">
    <table id="tabela-default">
        <thead>
        <tr>
            <th scope="col">Nome</th>
            <th scope="col">Vencimento</th>
            <th scope="col">Valor</th>
            <th scope="col">Data pagamento</th>
            <th scope="col">Status</th>
            <th scope="col">Ações</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($contas as $conta)
                
                <tr id="conta_{{$conta->id}}">
                    <td>{{$conta->venda->cliente->nome}}</td>
                    <td>{{date('d/m/Y', strtotime($conta->data_vencimento)) }}</td>
                    <td>R$ {{ number_format($conta->valor_receber, 2, ',', '') }}</td>
                    <td> {{$conta->data_pagamento ? date('d/m/Y', strtotime($conta->data_pagamento)) : 'N/I'}}</td>
                    <td>
                        @if ($conta->data_pagamento)
                            <span class="status-table" style="color:white;background-color:rgb(42, 181, 0)">
                                Conta Paga
                            </span>
                        @endif
                        @if(strtotime($conta->data_vencimento) < strtotime(date('Y-m-d')) && $conta->data_pagamento == null )
                            <span class="status-table" style="color:white;background-color:rgb(188, 0, 0)">
                                Atrasado
                            </span>
                        @endif
                        @if(strtotime($conta->data_vencimento) > strtotime(date('Y-m-d')) && $conta->data_pagamento == null)
                            <span class="status-table" style="color:white;background-color:rgb(0, 122, 188)">
                                Pendente
                            </span>
                        @endif
                    </td>
                    <td>
                        <button title="Visualizar conta" onclick="receberConta({{$conta->id}})" class="view">
                            <img src="{{ asset('icones/eye-solid.svg') }}" alt="">
                        </button>
                        @if ($conta->STATUS == 0)
                            <button title="Receber conta" onclick="receberConta({{$conta->id}})" class="receber">
                                <img src="{{ asset('icones/dollar.svg') }}" alt="">
                            </button>
                        @endif
                    </td>
                </tr>
            
            @endforeach
        
        </tbody>
    </table>
    <div class="paginacao">{{$contas->appends($request->all())->links()}}</div>
</div>