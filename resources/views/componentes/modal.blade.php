
<div class="modal-area" onmousedown="fecharModais('{{$modalId}}',event)" id="modal-area-{{$modalId}}">
    <div class="modal" id="modal-{{$modalId}}">

        <div class="modal-header">
            <section class="modal-titulo"><p>{{$titulo}}</p></section>
            <section class="modal-btn-fechar"><img onclick="closeModal('{{$modalId}}')" src="{{ asset('icones/fechar-x.svg') }}" alt=""></section>
        </div>
    
        <div class="modal-body">
            {{$bodyModal}}
        </div>
    
        <div class="modal-footer">
            {{$footerModal}}
        </div>
    
    </div>
</div>
