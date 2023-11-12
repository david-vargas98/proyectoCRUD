<?php

namespace Database\Factories;

use App\Models\Cliente; //Se incluye el modelo Cliente para usarlo en el factory
use App\Models\User; //Se incluye el modelo User para usarlo en el factory
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClienteUser>
 */
class ClienteUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //Se define los datos a crear, usando los modelos correspondientes para las claves foráneas
            'cliente_id' => Cliente::factory(),
            'user_id' => User::factory(),
            'proyecto' => $this->faker->word,
            'presupuesto' => $this->faker->randomFloat(2,1000,1000000),
            'estado' => $this->faker->randomElement(['Iniciado', 'Activo', 'Suspendido', 'Cancelado', 'Terminado']),
        ];
    }
}
