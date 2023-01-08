<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterChamadosTableAlterColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('chamados', function (Blueprint $table) {
            $table->unsignedBigInteger('id_responsavel')->nullable()->change();
            $table->dropForeign(['id_responsavel']);
            $table->foreign('id_responsavel')->references('id')->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chamados', function (Blueprint $table) {
            $table->unsignedBigInteger('id_responsavel')->change();
            $table->foreign('id_responsavel')->references('id')->on('usuarios')->change();
        });
    }
}
