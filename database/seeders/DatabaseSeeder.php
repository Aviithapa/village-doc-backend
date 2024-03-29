<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(TestNameSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ProvinceSeeder::class);
        $this->call(AppointmentSeeder::class);
        $this->call(DoctorSeeder::class);
    }
}
