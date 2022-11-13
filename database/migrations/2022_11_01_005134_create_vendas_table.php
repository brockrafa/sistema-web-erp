<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id')->references('id')->on('clientes')->nullable();
            $table->datetime('data_venda')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->unsignedBigInteger('usuario_id')->references('id')->on('usuarios')->nullable();
            $table->double('valor_total');
            $table->unsignedBigInteger('meio_pagamento_id');
            $table->integer('qtd_parcelas')->nullable();
            $table->double('valor_parcelas')->nullable();
            $table->date('data_primeira_parcela');
            $table->date('data_vencimento');
            $table->date('data_pagamento')->nullable();
            $table->unsignedBigInteger('status_venda_id');
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
        Schema::dropIfExists('vendas');
    }
}
