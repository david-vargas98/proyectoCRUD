<?php

namespace Database\Factories;

use App\Models\MilitaryElements;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //Se establecen los valores para los datos
            'military_element_id' => function () {
                return MilitaryElements::inRandomOrder()->firstOrCreate()->id; //Esto busca el id de un elemento, sino existe, lo crea
            },
            'disorder' => 'TEPT',
            'severity' => $this->faker->randomElement(['Bajo', 'Medio', 'Alto']),
        ];
    }
}
