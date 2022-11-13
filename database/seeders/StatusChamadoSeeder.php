<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StatusChamado;

class StatusChamadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StatusChamado::create(['status'=>'Aberto']);
        StatusChamado::create(['status'=>'Fechado']);
        StatusChamado::create(['status'=>'Em andamento']);

    }
}
