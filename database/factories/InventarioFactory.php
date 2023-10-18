<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inventario>
 */
class InventarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //Se define como se crearán los datos ficticios para el modelo Inventario
            'descripcion' => $this->faker->randomElement(['Harina', 'Azúcar', 'Chocolate']), //Returns a random element from the given array.
        ];
    }
}
