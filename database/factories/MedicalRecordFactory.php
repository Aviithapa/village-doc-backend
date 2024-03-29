<?php

namespace Database\Factories;

use App\Models\MedicalRecord;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AppMedicalRecord>
 */
class MedicalRecordFactory extends Factory
{

    protected $model = MedicalRecord::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'patient_id' => $this->faker->numberBetween(1, 100),
            'record_date' => $this->faker->date,
            'treatment_history' => $this->faker->text,
            'reproductive_plan' => $this->faker->boolean,
            'status' => $this->faker->randomElement(['PENDING','APPOINTMENT BOOKED','CONSULTING','RESCHEDULED','FOLLOW UP','CLOSED']),
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => $this->faker->numberBetween(3, 4),
            'updated_by' => $this->faker->numberBetween(3, 4),
        ];
    }
}
