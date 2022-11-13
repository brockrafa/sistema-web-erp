@extends('layouts.layout_site')
@section('conteudo')
    <div class="container">
        <div class="row mt-5">
            <div class="offset-3 col-6">
                <div class="card">
                    <div class="card-header">
                        Recuperação de senha
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login.password.sendRecoveryMail') }}">
                            @csrf
                            <div class="mb-3">
                              <label for="exampleInputEmail1" class="form-label">Email de recuperação</label>
                              <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            @if ($request->get('sts'))
                                <p class="{{ $request->get('sts') == 1 ? 'text-success' : 'text-danger' }}">
                                    {{$request->get('msg')}}
                                </p>
                            @endif
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection