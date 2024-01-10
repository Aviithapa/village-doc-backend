<?php

namespace Database\Factories;

use App\Models\Appointment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Appointment>
 */
class AppointmentFactory extends Factory
{

    protected $model = Appointment::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'patient_id' => $this->faker->numberBetween(1, 100),
            'medical_record_id' => $this->faker->numberBetween(1, 100),
            'appointment_date' =>   $this->faker->date(),
            'appointment_time' => $this->faker->time(),
            'reason' => $this->faker->text()
        ];
    }
}
