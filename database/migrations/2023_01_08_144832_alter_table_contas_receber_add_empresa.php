<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableContasReceberAddEmpresa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contas_receber',function (Blueprint $table){
            $table->unsignedBigInteger('id_empresa')->references('id')->on('empresas')->nullable()->after('id')->default('1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contas_receber',function (Blueprint $table){
            $table->dropColumn('id_empresa');
        });
    }
}
