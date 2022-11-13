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
            <tr id="cliente_1">
                <td>Rafael raposo leite</td>
                <td>24/03/2023</td>
                <td>R$299,99</td>
                <td>N/A</td>
                <td>
                    <span class="status-table" style="color:white;background-color:rgb(188, 0, 0)">
                        Pendente
                    </span>
                </td>
                <td>
                    <button onclick="editar()" class="view">
                        <img src="{{ asset('icones/lapis.svg') }}" alt="">
                    </button>
                    <button class="delete" onclick="deleteCliente()">
                        <img src="{{ asset('icones/lixeira.svg') }}" alt="">
                    </button>
                </td>
            </tr>
            <tr id="cliente_1">
                <td>Rafael raposo leite</td>
                <td>30/10/2022</td>
                <td>R$59,90</td>
                <td>29/10/2022</td>
                <td>
                    <span class="status-table" style="color:white;background-color:rgb(22, 163, 0)">
                        Pago
                    </span>
                </td>
                <td>
                    <button onclick="editar()" class="view">
                        <img src="{{ asset('icones/lapis.svg') }}" alt="">
                    </button>
                    <button class="delete" onclick="deleteCliente()">
                        <img src="{{ asset('icones/lixeira.svg') }}" alt="">
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
</div>