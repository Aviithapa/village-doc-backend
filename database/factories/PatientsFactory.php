<?php

namespace Database\Factories;

use App\Models\Patients;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AppPatient>
 */
class PatientsFactory extends Factory
{

    protected $model = Patients::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'date_of_birth' => $this->faker->date,
            'gender' => $this->faker->randomElement(['MALE', 'FEMALE', 'OTHER']),
            'contact_number' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => $this->faker->uuid,
            'ward_no' => $this->faker->numberBetween(1, 10),
            'created_by' => $this->faker->numberBetween(3, 4),
            'updated_by' => $this->faker->numberBetween(3, 4),
            'age' => $this->faker->numberBetween(18, 80),
            'religion' => $this->faker->word,
            'marital_status' => $this->faker->randomElement(['SINGLE', 'MARRIED', 'DIVORCED']),
            'is_house_head' => $this->faker->boolean,
            'househead_no' => $this->faker->uuid,
            'province_id' => $this->faker->numberBetween(1, 7),
            'district_id' => $this->faker->numberBetween(1, 75),
            'municipality_id' => $this->faker->numberBetween(1, 600),
            'blood_group' => $this->faker->randomElement(['A', 'B', 'AB', 'O']),
            'citizenship_no' => $this->faker->uuid,
            'insurance_no' => $this->faker->uuid,
            'nid_no' => $this->faker->uuid,
            'relationship' => $this->faker->word,
        ];
    }
}
