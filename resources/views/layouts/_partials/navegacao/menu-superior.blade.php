<aside class="menu-superior">
    <img onclick="toggleMenu()" class="icone-menu-ham" src="{{ asset('icones/hamburguer.svg') }}" alt="">
    <div style="position:relative;">
        <img onmouseOver="mostrarNotificacoes()" onmouseout="mostrarNotificacoes()" class="icone-notificacoes" src="{{ asset('icones/sino.svg')}}" alt="">
        <span class="quantidade-notificacoes">4</span>
        <div id="area-notificacoes">
            <p>Notificação 1</p>
            <p>Notificação 2</p>
            <p>Notificação 3</p>
            <p>Notificação 4</p>
        </div>
        <span>|</span>
        <div class="area-utilitarios-usuario">
            <img src="{{ asset('imagens/pngtree-user-vector-avatar-png-image_1541962.jpg')}}" alt="">
            <p>Rafael Raposo</p>
        </div>
    </div>
</aside>