<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Cliente;
use App\Models\Usuario;
use App\Models\StatusChamado;

class ChamadoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_empresa' => 1,
            'id_cliente' => Cliente::inRandomOrder()->first()->id,
            'data_abertura'=> $this->faker->dateTimeBetween('-15 days', 'now'),
            'setor'=> $this->faker->numberBetween(1,4),
            'tipo_problema'=>  $this->faker->numberBetween(1,2),
            'prioridade'=>  $this->faker->numberBetween(1,2),
            'id_responsavel'=>Usuario::inRandomOrder()->first()->id,
            'id_status_chamado'=>StatusChamado::inRandomOrder()->first()->id,
            'titulo'=> $this->faker->sentence(),
            'problema'=> $this->faker->sentence(),
            'created_at' => $this->faker->date(),
            'updated_at'=>$this->faker->date(),
        ];
    }
}
