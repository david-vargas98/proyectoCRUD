<?php

namespace Database\Factories;

use App\Models\MilitaryElements;
use App\Models\Patient;
use App\Models\User;
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
                //Se selecciona un elemento militar aleatorio que aún no haya sido utilizado
                $usedMilitaryElementIds = Patient::pluck('military_element_id')->toArray();

                if (count($usedMilitaryElementIds) > 0) {
                    //Se excluye elementos militares ya utilizados
                    $availableMilitaryElements = MilitaryElements::whereNotIn('id', $usedMilitaryElementIds)->inRandomOrder()->first();
                } else {
                    //Sino hay elementos militares utilizados, crear uno nuevo
                    $availableMilitaryElements = MilitaryElements::factory()->create();
                }

                return $availableMilitaryElements->id;
            },
            'user_id' => function () {
                return User::inRandomOrder()->firstOrCreate()->id; //Esto busca el id de un usuario, sino existe, lo crea
            },
            'disorder' => 'TEPT',
            'severity' => $this->faker->randomElement(['Bajo', 'Medio', 'Alto']),
        ];
    }
}
