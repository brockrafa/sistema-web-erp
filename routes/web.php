<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ControleAcesso;


Route::get('/login/{mensagem?}', [\App\Http\Controllers\LoginController::class,'index'])->name('login.index');
Route::post('/login/autenticar', [\App\Http\Controllers\LoginController::class,'autenticar'])->name('login.autenticar');
Route::get('/logoff', [\App\Http\Controllers\LoginController::class,'logoff'])->name('login.logoff');
Route::get('/login/password/reset/{status?}/{mensagem?}', [\App\Http\Controllers\RecuperacaoSenha::class,'passwordReset'])->name('login.password.reset');
Route::post('/login/password/recovery-mail', [\App\Http\Controllers\RecuperacaoSenha::class,'passwordRecoveryMail'])->name('login.password.sendRecoveryMail');
Route::get('/login/password/recovery/{token}', [\App\Http\Controllers\RecuperacaoSenha::class,'passwordNovaSenha'])->name('login.password.recovery');
Route::post('/login/password/recovery/store', [\App\Http\Controllers\RecuperacaoSenha::class,'storeNovaSenha'])->name('login.password.recovery.store');


Route::middleware('controle.acesso')->prefix('app')->group(function(){

    Route::get('/home', [\App\Http\Controllers\AppController::class,'index'])->name('app.home');
    Route::get('/menu/{status?}', [\App\Http\Controllers\AppController::class,'menuState'])->name('app.menu');

    // Chamados
    Route::get('/chamado', [\App\Http\Controllers\ChamadoController::class,'index'])->name('app.chamados');
    Route::post('/chamado', [\App\Http\Controllers\ChamadoController::class,'index'])->name('app.chamados');
    Route::get('/chamado/novo-chamado', [\App\Http\Controllers\ChamadoController::class,'novoChamado'])->name('app.novo_chamado');
    Route::post('/chamado/novo-chamado', [\App\Http\Controllers\ChamadoController::class,'novoChamado'])->name('app.novo_chamado');
    Route::get('/chamado/editar/{id}', [\App\Http\Controllers\ChamadoController::class,'editar'])->name('app.chamado.editar');
    Route::post('/chamado/editar', [\App\Http\Controllers\ChamadoController::class,'armazenar'])->name('app.chamado.armazenar');


    // Clientes
    Route::get('/cliente', [\App\Http\Controllers\ClienteController::class,'index'])->name('app.clientes');
    Route::post('/cliente', [\App\Http\Controllers\ClienteController::class,'index'])->name('app.clientes');
    Route::get('/novo-cliente', [\App\Http\Controllers\ClienteController::class,'novoCliente'])->name('app.novo_cliente');
    Route::post('/novo-cliente', [\App\Http\Controllers\ClienteController::class,'novoCliente'])->name('app.novo_cliente');
    Route::get('/cliente/delete/{id?}', [\App\Http\Controllers\ClienteController::class,'delete'])->name('app.clientes.delete');
    Route::get('/cliente/editar/{id}/{msg?}', [\App\Http\Controllers\ClienteController::class,'editar'])->name('app.clientes.editar');
    Route::get('/get-table-clientes', [\App\Http\Controllers\ClienteController::class,'getTable'])->name('app.get_table');

    // Usuarios
    Route::resource('usuario','App\Http\Controllers\UsuarioController');

    //Contas
    Route::get('/contas/receber', [\App\Http\Controllers\ContaPagarReceberController::class,'index'])->name('contas.receber.index');
    Route::post('/contas/receber', [\App\Http\Controllers\ContaPagarReceberController::class,'index'])->name('contas.receber.index');

    Route::get('/contas/receber/create', [\App\Http\Controllers\ContaPagarReceberController::class,'create'])->name('contas.receber.create');
    Route::post('/contas/receber/store', [\App\Http\Controllers\ContaPagarReceberController::class,'store'])->name('contas.receber.store');
    Route::get('/contas/receber/receive/{id}', [\App\Http\Controllers\ContaPagarReceberController::class,'receive'])->name('contas.receber.receive');
    Route::post('/contas/receber/receive', [\App\Http\Controllers\ContaPagarReceberController::class,'receiveStore'])->name('contas.receber.receiveStore');


    // Configurações
    Route::get('/configuracao/status', [\App\Http\Controllers\ConfiguracaoController::class,'index'])->name('configuracao.status');
    Route::get('/configuracao/status/novo', [\App\Http\Controllers\ConfiguracaoController::class,'novoStatus'])->name('configuracao.status.adicionar');
    Route::post('/configuracao/status/store', [\App\Http\Controllers\ConfiguracaoController::class,'statusStore'])->name('configuracao.status.store');
    Route::get('/configuracao/status/delete/{id?}', [\App\Http\Controllers\ConfiguracaoController::class,'statusDelete'])->name('configuracao.status.delete');
    Route::get('/configuracao/status/edit/{id?}', [\App\Http\Controllers\ConfiguracaoController::class,'editarStatus'])->name('configuracao.status.edit');
    Route::post('/configuracao/status/update', [\App\Http\Controllers\ConfiguracaoController::class,'updateStatus'])->name('configuracao.status.update');



});


Route::middleware('controle.acesso')->prefix('list')->group(function(){
    Route::get('/clientes/{nome?}', [\App\Http\Controllers\AppController::class,'clientesList'])->name('list.clientes');
    Route::get('/usuarios/{nome?}', [\App\Http\Controllers\AppController::class,'usuariosList'])->name('list.usuarios');
});

Route::fallback([\App\Http\Controllers\AppController::class,'fallback']);