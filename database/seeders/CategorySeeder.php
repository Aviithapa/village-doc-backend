<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ["name" => "Respiratory", "slug" => "respiratory"],
            ["name" => "Cardiology", "slug" => "cardiology"],
            ["name" => "GI", "slug" => "gi"],
            ["name" => "Genitourinary", "slug" => "genitourinary"],
            ["name" => "Neurology", "slug" => "neurology"],
            ["name" => "Psychiatry", "slug" => "psychiatry"],
            ["name" => "Ophthalmology", "slug" => "ophthalmology"],
            ["name" => "Orthopedics", "slug" => "orthopedics"],
            ["name" => "Hematology/Onchology", "slug" => "hematology-oncology"],
            ["name" => "Endocrine", "slug" => "endocrine"],
            ["name" => "Dermatology", "slug" => "dermatology"],
            ["name" => "ENT", "slug" => "ent"],
            ["name" => "Breast", "slug" => "breast"],
            ["name" => "Surgical", "slug" => "surgical"],
            ["name" => "Emergencies", "slug" => "emergencies"],
            ["name" => "Neurology", "slug" => "neurology"]
        ]);
    }
}
