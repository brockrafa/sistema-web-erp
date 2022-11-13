<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Cliente;

class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

     protected $model = Cliente::class;



    public function definition()
    {
        return [
            'documento'=> $this->faker->numberBetween(10000000000,99999999999),
            'nome'=> $this->faker->name,
            'logradouro'=> $this->faker->streetName,
            'cep'=> $this->faker->numberBetween(20000000,99999999),
            'cep'=> $this->faker->numberBetween(20000000,99999999),
            'bairro'=> $this->faker->state,
            'cidade'=> $this->faker->city,
            'uf'=> $this->faker->stateAbbr,
            'sexo'=>$this->faker->numberBetween(1,2)
        ];
    }
}
