<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AuthApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $msg = [
            'status'=>'erro',
            'msg'=>'O token informado nao pertence a nenhum usuario'
        ];

        if($request->hasHeader('_token')){

            
            $key = env('DECRYPT_KEY_BRK');
            

            $token_composto = $request->header('_token');
            $token_composto = explode(".",$token_composto);


            $token = $token_composto[0];
            $iv = hex2bin($token_composto[1]);

            //No middleware, começamos a descriptografar utilizando o base 64
            $token_descript = base64_decode($token);

            //Fazemos a descriptografia com o decrypt
            $data_token = json_decode(openssl_decrypt($token_descript , "aes-256-cbc", $key, OPENSSL_RAW_DATA, $iv));


            if(time() < $data_token->timestamp_validate){
                if(Usuario::where('token_user',$request->header('_token'))->exists()){
                    return $next($request);
                }
            }else{
                $msg = [
                    'status'=>'erro',
                    'msg'=>'O token informado expirou em: '.date('d/m/Y H:i', $data_token->timestamp_validate).', por favor gere o token novamente'
                ];
            }
        }
        return response()->json($msg,401);
    }
}
