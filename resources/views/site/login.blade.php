@extends('layouts.layout_site')
@section('conteudo')
<section class="row">
    <div class="col-12">
        @if (isset($accessError))
            <div class="alert alert-danger fixed-top" role="alert">
                Você precisa estar logado para acessar essa página
            </div>
        @endif
    </div>
</section>
<section class="row justify-content-center align-items-center" style="min-height: 99vh">
    <div class="col-4">
        <div class="card ">
            <div class="card-header bg-primary text-white py-3 text-center" style="font-size:18px;font-family:roboto">
                Area de login
            </div>
            <div class="card-body">
                <form action="{{route('login.autenticar')}}" method="POST">
                    @csrf
                    @if($msg !='')
                        <p class="alert alert-success">
                            {{$msg}}
                        </p>
                    @endif
                    <div class="my-3">
                        <label class="form-label" for="">Email</label>
                        <input type="text" name="email" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="">Senha</label>
                        <input type="password" name="senha" class="form-control">
                    </div>
                    <a href="{{route('login.password.reset')}}" class="">Esqueci minha senha</a>
                    <div class="text-center mt-5">
                        <button type="submit" class="btn btn-primary px-5">Entrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection