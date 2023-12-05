<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            ['name' => 'super-admin', 'display_name' => "Super Admin"],
            ['name' => 'admin', 'display_name' => "Admin"],
            ['name' => 'ward-admin', 'display_name' => "Ward Admin"],
            ['name' => 'heath-worker', 'display_name' => 'Health Post User'],
            ['name' => 'doctor', 'display_name' => 'Doctor'],
            ['name' => 'nurse', 'display_name' => 'Nurse']
        ]);
    }
}
