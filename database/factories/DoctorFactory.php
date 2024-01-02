<?php

namespace Database\Factories;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AppDoctor>
 */
class DoctorFactory extends Factory
{
    protected $model = Doctor::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'salutation' => $this->faker->title,
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'Specialization' => $this->faker->word,
            'nmc_number' => $this->faker->unique()->word,
            'gender' => $this->faker->randomElement(['MALE', 'FEMALE', 'OTHER']),
            'contact_number' => $this->faker->phoneNumber,
            'emergency_contact_number' => $this->faker->phoneNumber,
            'hiring_date' => $this->faker->date,
            'email' => $this->faker->email,
            'address' => $this->faker->address,
            'created_at' => $this->faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
            'updated_at' => $this->faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
            'created_by' => $this->faker->numberBetween(1, 2),
            'updated_by' => $this->faker->numberBetween(1, 2),
        ];
    }
}
