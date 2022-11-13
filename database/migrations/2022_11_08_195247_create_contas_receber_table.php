<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContasReceberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contas_receber', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('venda_id')->references('id')->on('vendas');
            $table->double('valor_receber');
            $table->integer('parcela_atual');
            $table->integer('total_parcelas');
            $table->datetime('data_vencimento');
            $table->datetime('data_pagamento')->nullable();
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
        Schema::dropIfExists('contas_receber');
    }
}
