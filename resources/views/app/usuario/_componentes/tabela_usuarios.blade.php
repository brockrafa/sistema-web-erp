<div class="">
    <table id="tabela-default">
        <thead>
        <tr>
            <th scope="col">Id usuario</th>
            <th scope="col">Username</th>
            <th scope="col">Email</th>
            <th scope="col">Permissão</th>
            <th scope="col">Ações</th>
        </tr>
        </thead>
        <tbody>

            @foreach ($usuarios as $usuario)
                
                <tr id="usuario_{{$usuario->id}}">
                    <td>{{$usuario->id}}</td>
                    <td>{{$usuario->nome}}</td>
                    <td>{{$usuario->email}}</td>
                    <td>{{$usuario->permissao}}</td>
                    <td>
                        <button onclick="document.getElementById('form_usuario_id_{{$usuario->id}}_edit').submit()" class="view">
                            <form id="form_usuario_id_{{$usuario->id}}_edit" action="{{ route('usuario.edit',['usuario'=>$usuario->id])}}" method="get">
                                @csrf
                            </form>
                            <img src="{{ asset('icones/lapis.svg') }}" alt="">
                        </button>
                        <button  onclick="document.getElementById('form_usuario_id_{{$usuario->id}}_delete').submit()" class="delete">
                            <form id="form_usuario_id_{{$usuario->id}}_delete" action="{{ route('usuario.destroy',['usuario'=>$usuario->id])}}" method="post">
                                @csrf
                                @method('DELETE')
                            </form>
                            <img src="{{ asset('icones/lixeira.svg') }}" alt="">
                        </button>
                    </td>
                </tr>
           
            @endforeach
            
        </tbody>
    </table>
    <div class="paginacao">{{$usuarios->links()}}</div>
</div>