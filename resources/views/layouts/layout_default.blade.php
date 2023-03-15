<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistema de Gestão Brock Solution</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/autoselect.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/default-styles.css') }} ">
</head>
<body class="body {{ $_SESSION['menu'] == 1 ? 'body-max' : '' }}">
    @include('layouts._partials.navegacao.barra-navegacao')
    @include('layouts._partials.navegacao.menu-superior')
    <div class="quadro-exibicao">
        @yield('conteudo')
    </div> 
</body>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script type="text/javascript" src=" {{ asset('js/mask.js') }} "></script>
<script type="text/javascript" src=" {{ asset('js/mask2.js') }} "></script>  
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/js.js') }}"></script>
<script src="{{ asset('js/autoselect.js') }}"></script>
<script src="{{ asset('js/core.js') }}"></script>
@yield('scripts')
</html>