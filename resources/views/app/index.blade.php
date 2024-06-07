@extends('layouts.layout_default')
@section('conteudo')
<section id="header-secao">
    <h4>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M304 240V16.6c0-9 7-16.6 16-16.6C443.7 0 544 100.3 544 224c0 9-7.6 16-16.6 16H304zM32 272C32 150.7 122.1 50.3 239 34.3c9.2-1.3 17 6.1 17 15.4V288L412.5 444.5c6.7 6.7 6.2 17.7-1.5 23.1C371.8 495.6 323.8 512 272 512C139.5 512 32 404.6 32 272zm526.4 16c9.3 0 16.6 7.8 15.4 17c-7.7 55.9-34.6 105.6-73.9 142.3c-6 5.6-15.4 5.2-21.2-.7L320 288H558.4z"/></svg>
        <span>Dashboards</span>
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
                        date('d/m',strtotime($cliente->data))
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