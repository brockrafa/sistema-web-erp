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
        StatusChamado::create(['status'=>'Aberto','font_color'=>'#ffffff','background_color'=>'black']);
        StatusChamado::create(['status'=>'Fechado','font_color'=>'#ffffff','background_color'=>'red']);
        StatusChamado::create(['status'=>'Em andamento','font_color'=>'#ffffff','background_color'=>'blue']);

    }
}
