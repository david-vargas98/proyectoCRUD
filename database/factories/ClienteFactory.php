<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //Se define los atributos predeterminados para la creación de instancias de Cliente
        return [
            'nombrecliente' => $this->faker->name(),
            'apellidopat' => $this->faker->lastName(),
            'apellidomat' => $this->faker->lastName(),
            'fechanacimiento' => $this->faker->date(),
            'correo' => $this->faker->email(),
            'telefono' => $this->faker->phoneNumber(),
            'direccion' => $this->faker->address(),
            'ciudad' => $this->faker->city(),
            'estado' => $this->faker->state(),
            'pais' => $this->faker->country(),
        ];
    }
}
