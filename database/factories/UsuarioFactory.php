<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UsuarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nome'=> $this->faker->name,
            'email'=> $this->faker->unique()->safeEmail(),
            'senha' => md5('123'),
            'permissao'=> $this->faker->numberBetween(1,2),
            'created_at' => $this->faker->date(),
            'updated_at'=>$this->faker->date(),
            'id_empresa' => $this->faker->numberBetween(1,1)
        ];
    }
}
