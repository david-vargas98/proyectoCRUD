<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'patient_id' => function () {
                return Patient::inRandomOrder()->firstOrCreate()->id; //Esto busca el id de un elemento, sino existe, lo crea
            },
            'appointment_date' => $this->faker->date,
            'start_time' => $this->faker->time,
            'end_time' => $this->faker->optional()->time,
            'appointment_status' => $this->faker->randomElement(['programada', 'cancelada', 'completada']),
            'observations_location' => $this->faker->optional()->word,
            'observations_name' => $this->faker->optional()->word,
        ];
    }
}
