<nav class="barra-navegacao-container {{ $_SESSION['menu'] == 1 ? 'fechado' : '' }}">
    <div class="header-barra-navegacao">
        <img src="{{ asset('imagens/pngtree-user-vector-avatar-png-image_1541962.jpg')  }} " class="foto-usuario-barra-navegacao" alt="">
        <p class="nome-usuario-barra-navegacao">
            @if ($_SESSION['menu'] == 1)
                {{substr($_SESSION['nome'],0,1)}}
            @else
                {{$_SESSION['nome']}}
            @endif
        </p>
        <span class="nome-usuario-barra-navegacao-completo" style="display: none">{{$_SESSION['nome']}}</span>
    </div>
    <div class="body-barra-navegacao">
        <ul>
            <li id="home">
                <a href="{{ route('app.home') }}">
                    <img src="{{ asset('icones/house-solid.svg') }}" alt="">
                    <span>Home</span>
                </a>
            </li>
            <li id="chamado"> 
                <a href="{{ route('app.chamados') }}">
                    <img src="{{ asset('icones/headset-solid.svg') }}" alt="">
                    <span>Chamados</span>
                </a>
            </li>
            <li id="cliente">
                <a href="{{ route('app.clientes')}}">
                    <img src="{{ asset('icones/contatos.svg') }}" alt="">
                    <span>Clientes</span>
                </a>
            </li>
            <li id="produtos">
                <a href="{{ route('app.produtos')}}">
                    <img src="{{ asset('icones/box-open-solid.svg') }}" alt="">
                    <span>Produtos/Serviços</span>
                </a>
            </li>
            <li id="conta" onclick="">
                <a href="#" class="dropdown" onclick="expandDropDown('conta',event)">
                    <img src="{{ asset('icones/money-bill-transfer-solid.svg') }}" alt="">
                    <span>Contas</span>
                    <img id="conta-img" src="{{ asset('icones/arrow-right.svg') }}" alt="">
                </a>
                    <ul id="conta-dropdown" class="first-lv">
                        <li class="dropdown">
                            <a href="{{route('contas.receber.index')}}">
                                <img src="{{ asset('icones/planilha.svg') }}" alt="">
                                <span>A receber</span>
                            </a>
                        </li>
                    </ul>
            </li>

            <li id="configuracao" onclick="">
                <a href="#" class="dropdown" onclick="expandDropDown('config',event)">
                    <img src="{{ asset('icones/config.svg') }}" alt="">
                    <span>Configurações</span>
                    <img id="config-img" src="{{ asset('icones/arrow-right.svg') }}" alt="">
                </a>
                    <ul id="config-dropdown" class="first-lv">
                        <li class="dropdown">
                            <a href="#" onclick="expandDropDown('status')">
                                <img src="{{ asset('icones/headset-solid.svg') }}" alt="">
                                <span>Chamados</span>
                                <img id="status-img" src="{{ asset('icones/arrow-right.svg') }}" alt="">
                            </a>
                                <ul id="status-dropdown" class="second-lv" style="display:none;">
                                    <li>
                                        <a href="{{route('configuracao.status')}}">
                                            <img src="{{ asset('icones/arrows-spin-solid.svg') }}" alt="">
                                            <span>Status</span>
                                        </a>
                                    </li>
                                </ul>
                        </li>
                        <li class="dropdown">
                            <a href="{{route('usuario.index')}}">
                                <img src="{{ asset('icones/usuarios.svg') }}" alt="">
                                <span>Usuarios</span>
                            </a>
                        </li>
                    </ul>
            </li>

            <li>
                <a href="{{ route('login.logoff')}}">
                    <img src="{{ asset('icones/sign-out-alt-solid.svg') }}" alt="">
                    <span>Sair</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="footer-barra-navegacao">
        <h4>@2022- BrockSolution</h4>
    </div>
</nav>