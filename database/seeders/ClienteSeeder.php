<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cliente;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*Cliente::create(['documento'=>'3123','nome'=>'Joao vitor','cep'=>'2312131212','cidade'=>'Rio das ostras','bairro'=>'Peró','sexo'=>'1','data_nascimento'=>'2002-07-21']);
        Cliente::create(['documento'=>'4321413','nome'=>'Raissa','cep'=>'675647345','cidade'=>'Rio das ostras','bairro'=>'Cabo frio','sexo'=>'1','data_nascimento'=>'1996-01-02']);
        Cliente::create(['documento'=>'6534621312334563','nome'=>'Dihh','cep'=>'65345245234','cidade'=>'Rio de janeiro','bairro'=>'Alemao','sexo'=>'2','data_nascimento'=>'1996-09-29']);
        Cliente::create(['documento'=>'342423423','nome'=>'Oliver','cep'=>'6345234234','cidade'=>'Rio de janeiro','bairro'=>'Leblon','sexo'=>'1','data_nascimento'=>'1991-09-29']);
        Cliente::create(['documento'=>'3123141231232523423','nome'=>'Pehh','cep'=>'231352345','cidade'=>'Rio de janeiro','bairro'=>'Alemao','sexo'=>'2','data_nascimento'=>'1996-09-29']);
        */

        Cliente::factory()->count(200)->create();
    }
}
