<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MilitaryElements>
 */
class MilitaryElementsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //Se agregan los datos a crear
            'name' => $this->faker->name,
            'birthdate' => $this->faker->date,
            'cellphone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'admission' => $this->faker->date,
            'militarygrade' => $this->faker->word,
            'location' => $this->faker->word,
            'unit' => $this->faker->word,
            'servicestate' => $this->faker->word,
        ];
    }
}
