<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;


class ControleAcesso
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
        session_start();
        // Verificar se usuario está logado
        if(isset($_SESSION['id']) && $_SESSION['id']!=''){
            return $next($request);
        }else{
            return redirect()->route('login.index',['accessError'=>1]);
        }

    }
}
