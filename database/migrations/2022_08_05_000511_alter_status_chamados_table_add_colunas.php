<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterStatusChamadosTableAddColunas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('status_chamados', function (Blueprint $table) {
            $table->string('font_color',10)->after('status');
            $table->string('background_color',10)->after('font_color');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('status_chamados', function (Blueprint $table) {
            $table->dropColumn('font_color');
            $table->dropColumn('background_color');
        });
    }
}
