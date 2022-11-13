@extends('layouts.layout_default')
@section('conteudo')
<section id="header-secao">
    <h4>
        <img src="{{ asset('icones/icone-checklist.svg') }}">
        <span>Dashboard</span>
    </h4>
</section>

<section class="body-secao" style="display: flex;justify-content:space-between">


    <div style="width: 49%;">
        <h1  class="titulo-grap">
            Chamados abertos nesse mês 
        </h1>
        <script>
            const labels = [
                @foreach($chamados as $chamado)
                    '{{
                        //  ucfirst(strftime('%B', strtotime('2022-'.$chamado->mes.'-01')));
                        date('d/m',strtotime($chamado->data_abertura))
                    }}',
                @endforeach
            ];
            const data = {
                labels: labels,
                datasets: [{
                    label: 'Chamados',
                    backgroundColor: 'rgb(0, 210, 150)',
                    borderColor: 'rgb(0, 210, 150)',
                    data: [
                        @foreach($chamados as $chamado)
                            '{{$chamado->sum}}',
                        @endforeach
                    ],
    
                }]
            };
            
            const config = {
                type: 'line',
                data: data,
                options: {
                    plugins: {
                        legend: {
                            position: 'right',
                        }
                    }
                }
            };
        </script>
        <div style="width:100%">
            <canvas  id="myChart">
            </canvas>
        </div>
    </div>


    <div style="width: 49%;">
        <h1 class="titulo-grap">Clientes novos neste mes</h1>
        <script>
            const labelsClientes = [
                @foreach($clientes as $cliente)
                    '{{
                        // ucfirst(strftime('%B', strtotime('2022-'.$cliente->mes.'-01')));
                        date('d/m',strtotime($cliente->data_cadastro))
                    }}',
                @endforeach
            ];
            const dataClientes = {
                labels: labelsClientes,
                datasets: [{
                    label: 'Clientes',
                    backgroundColor: ['rgb(255, 99, 132)'],
                    borderColor: 'rgb(255, 99, 132)',
                    data: [
                        @foreach($clientes as $cliente)
                            '{{$cliente->sum}}',
                        @endforeach
                    ],
    
                }],
            };
            
            const configClientes = {
                type: 'bar',
                data: dataClientes,
                options: {
                    plugins: {
                        legend: {
                            position: 'right',
                        }
                    },
                    
                }
            };
        </script>
        <div style="width:100%"><canvas  id="graficoClientes"></canvas></div>
    </div>
    
    
</section>
@endsection