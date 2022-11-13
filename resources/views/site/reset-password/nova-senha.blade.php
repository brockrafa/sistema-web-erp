@extends('layouts.layout_site')
@section('conteudo')
    <div class="container">
        <div class="row mt-5">
            <div class="offset-3 col-6">
                <div class="card">
                    <div class="card-header py-3 font-weight-bold">
                        <span class="font-weight-bold">Recuperação de senha</span> 
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login.password.recovery.store') }}">
                            @csrf
                            <div class="mb-3">
                              <label class="form-label">Email da conta</label>
                              <input disabled type="email" class="form-control" value="{{$user->email}}">
                              <input type="hidden" value="{{$user->id}}" name="id">
                              <input type="hidden" value="{{$token}}" name="token">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nova senha</label>
                                <small>{{ $errors->has('password') ? $errors->first('password') : ''}}</small>
                                <input name="password" type="password" class="form-control">
                              </div>
                            <div class="mb-3">
                            <label class="form-label">Confirmação da nova senha</label>
                            <small>{{ $errors->has('password') ? $errors->first('password') : ''}}</small>
                            <input name="password_confirmation" type="password" class="form-control">
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-success mt-3">Alterar senha</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection