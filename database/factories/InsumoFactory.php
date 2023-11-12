<?php

namespace Database\Factories;

use App\Models\Inventario; //Se incluye el modelo a usar en el factory
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Insumo>
 */
class InsumoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //Se define los datos a crear
            'insumodescripcion'=> $this->faker->word,
            'insumocantidad' => $this->faker->randomNumber(2),
            'inventario_id' => function () {
                return Inventario::inRandomOrder()->firstOrCreate()->id; //Esto busca el id de un inventario, sino existe, lo crea
            },
        ];
    }
}
