<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChamadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chamados', function (Blueprint $table) {
            $table->id();   
            $table->unsignedBigInteger('id_cliente');
            $table->date('data_abertura');
            $table->integer('setor');
            $table->integer('tipo_problema');
            $table->integer('prioridade');
            $table->unsignedBigInteger('id_responsavel');
            $table->unsignedBigInteger('id_status_chamado');
            $table->string('contrato')->nullable();
            $table->string('titulo');
            $table->longText('problema');
            $table->foreign('id_cliente')->references('id')->on('clientes');
            $table->foreign('id_status_chamado')->references('id')->on('status_chamados');
            $table->foreign('id_responsavel')->references('id')->on('usuarios');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chamados');
    }
}
