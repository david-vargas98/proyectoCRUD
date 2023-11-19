<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MediumSeverity>
 */
class MediumSeverityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //Se define los datos a crear:
            'engineer_services' => $this->faker->word,
            'management_services' => $this->faker->word,
            'health_services' => $this->faker->word,
            'war_material_services' => $this->faker->word,
            'transmission_services' => $this->faker->word,
            'transport_services' => $this->faker->word,
            'quartermasters_corp' => $this->faker->word,
            'justice_services' => $this->faker->word,
        ];
    }
}
