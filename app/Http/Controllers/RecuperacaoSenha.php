<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\RecuperarSenha;
use App\Mail\RecuperacaoSenhaMail;
use Illuminate\Support\Facades\Mail;

class RecuperacaoSenha extends Controller
{
    public function passwordReset(Request $request){
        return view('site.password-reset',['request'=>$request]);
    }

    // Enviar email de recuperação de senha com token
    public function passwordRecoveryMail(Request $request){
        
        $email = $request->get('email');
        $user = Usuario::where('email','=',$email)->first();

        $rec = RecuperarSenha::where('email',$email)->first();
        if($rec){
            $rec->delete();
        }

        if(!isset($user->id)){
            return redirect()->route('login.password.reset',['sts'=>2,'msg'=>'O email informado não pertence a nenhum usuario válido']);
        }
        $token = $this->gerarToken($email);
        $rec = RecuperarSenha::create([
            'token'=>$token,
            'email'=>$email
        ]);

        Mail::to($email)->send(new RecuperacaoSenhaMail($user,$token));
        return redirect()->route('login.password.reset',['sts'=>1,'msg'=>'E-mail de recuperação enviado com sucesso']);
    }

    // Rota para renderizar nova senha com link de email
    public function passwordNovaSenha($token){
        $rec = RecuperarSenha::where('token',$token)->first();

        if(!isset($rec)){
            return redirect()->route('login.password.reset',['sts'=>2,'msg'=>'O token já expirou ou já foi utilizado! Por favor solicite novamente a troca de senha.']);
        };

        $user = Usuario::where('email',$rec->email)->first();

        if(!isset($user)){
            return redirect()->route('login.password.reset',['sts'=>2,'msg'=>'O email informado não pertence a nenhum usuario válido']);
        }

        return view('site.reset-password.nova-senha',['user'=>$user,'token'=>$token]);
    }

    // Armazenar nova senha
    public function storeNovaSenha(Request $request){
        $filtros = [
            'password'=>'required | confirmed | min:6'
        ];
        $feedback = [
            'password.require'=>'É necessario preencher o campo senha',
            'password.confirmed'=>'* As duas senhas precisam ser iguais',
            'password.min'=>'A senha deve ter no minimo 6 caracteres'
        ];
        $request->validate($filtros,$feedback);

        $user = Usuario::find($request->get('id'));
        $user->senha = md5($request->get('password'));
        $user->save();
        $rec = RecuperarSenha::where('email',$user->email)->where('token','=',$request->get('token'))->first();
        $rec->delete();
        return redirect()->route('login.index',['mensagem'=>'Senha recuperada com sucesso']);
    }

    public function gerarToken($email){
        $token = md5($email);
        return uniqid($token); 
    }
}
