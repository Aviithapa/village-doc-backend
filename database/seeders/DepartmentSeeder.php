<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('departments')->insert([
            ['name' => 'BLOOD BANK','created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'BODY FLUIDS','created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'CLINICAL BIOCHEMISTRY','created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'CLINICAL PATHOLOGY','created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'CYTOPATHOLOGY','created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'HAEMATOLOGY','created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'HISTOPATHOLOGY','created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'MICROBIOLOGY / SEROLOGY','created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'MOLECULAR & GENOMIC PATHOLOGY','created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
        ]);
    }
}
