<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Usuario;
use App\Repositories\ClienteRepository;


class ClienteApiController extends ControllerApi
{
    public function __construct(Request $request,Cliente $cliente) {
        parent::__construct($request);
        $this->cliente = $cliente;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $clienteRepository = new ClienteRepository($this->cliente);
        if($request->has('filtro')){
            $clienteRepository->filtro($request->get('filtro'));
        }

        if($request->has('atributos')){
            $clienteRepository->selectAtributtes($request->get("atributos"));
        }

        if($request->has('isNull')){
            $this->cliente = $this->cliente->whereNull($request->get('isNull'));
        }

        if($request->has('isNotNull')){
            $this->cliente = $this->cliente->whereNotNull($request->get('isNotNull'));
        }

        $clientes = $clienteRepository->getResults($this->usuario->id_empresa);

        $clientes = count($clientes) > 0 ? $clientes : 'Nenhum cliente encontrado';

        return response()->json($clientes,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function token(){

        $key = env('DECRYPT_KEY_BRK');

        $algoritmo = 'AES-256-CBC';
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($algoritmo));
        $validade = time();
        $validade += 60 * 60;


        $data = [
            'user_id' => 1,
            'timestamp_create' => time(),
            'timestamp_validate' => $validade
        ];

        //Faz a criptografia do token
        $ciphertext = openssl_encrypt(json_encode($data), "aes-256-cbc", $key, OPENSSL_RAW_DATA, $iv);

        //Converte em um hash que de pra salvar no banco
        $iv = bin2hex($iv);
        $token = base64_encode($ciphertext).'.'.$iv;

        $user = Usuario::find(1);
        $user->token_user = $token;
        $user->update();

        //retorna o hash
        return response()->json(['token' => $token]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return response()->json(["status" => 'Metodo ainda nao implementado'],200);
   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cliente = $this->cliente->find($id);

        $cliente = $cliente ? $cliente : ['Status' => 'Nenhum cliente encontrado'];
        return response()->json($cliente,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
