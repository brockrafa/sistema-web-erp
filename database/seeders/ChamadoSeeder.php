<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Chamado;

class ChamadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Chamado::factory()->count(1000)->create();
    }
}
