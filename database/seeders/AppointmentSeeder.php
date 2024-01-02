<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\MedicalRecord;
use App\Models\Patients;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Patients::factory()->count(100)->create();
        MedicalRecord::factory()->count(100)->create();
        Appointment::factory()->count(50)->create();
    }
}
