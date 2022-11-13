<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalhesChamadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalhes_chamados', function (Blueprint $table) {
            $table->id();
            $table->longText('update_descricao');
            $table->unsignedBigInteger('id_chamado');
            $table->unsignedBigInteger('id_usuario');
            $table->timestamps();
            $table->foreign('id_chamado')->references('id')->on('chamados');
            $table->foreign('id_usuario')->references('id')->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalhes_chamados');
    }
}
