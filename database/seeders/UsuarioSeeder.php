<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Usuario::factory()->count(100)->create();
        Usuario::create([
            'nome'=> 'Rafael',
            'email'=> 'rafaelsuporte99@hotmail.com',
            'senha' => md5('123'),
            'permissao'=> 2,
            'created_at' => date("Y-m-d"),
            'updated_at'=>  date("Y-m-d"),
            'id_empresa' => 1
        ]);
    }
}
