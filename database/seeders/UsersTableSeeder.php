<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('users')->insert([
            [
                'username' => 'Super Admin User',
                'email' => 'superadmin@aeirc.com',
                'password' => Hash::make('Nepal@123'),
                'status' => 'active',
                'email_verified_at' => Carbon::now(),
                'reference' => 'Nepal@123',
            ],
            [
                'username' => 'Admin User',
                'email' => 'admin@aeirc.com',
                'password' => Hash::make('Nepal@123'),
                'status' => 'active',
                'email_verified_at' => Carbon::now(),
                'reference' => 'Nepal@123'
            ],
            [
                'username' => 'Ward Admin',
                'email' => 'ward@aeirc.com',
                'password' => Hash::make('Nepal@123'),
                'status' => 'active',
                'email_verified_at' => Carbon::now(),
                'reference' => 'Nepal@123'
            ],
            [
                'username' => 'Health Post User',
                'email' => 'heathpost@aeirc.com',
                'password' => Hash::make('Nepal@123'),
                'status' => 'active',
                'email_verified_at' => Carbon::now(),
                'reference' => 'Nepal@123'
            ],
            [
                'username' => 'Doctor',
                'email' => 'doctor@aeirc.com',
                'password' => Hash::make('Nepal@123'),
                'status' => 'active',
                'email_verified_at' => Carbon::now(),
                'reference' => 'Nepal@123'
            ],
        ]);

        DB::table('role_user')->insert([
            ['role_id' => 1, 'user_id' => 1],
            ['role_id' => 2, 'user_id' => 2],
            ['role_id' => 3, 'user_id' => 3],
            ['role_id' => 4, 'user_id' => 4],
            ['role_id' => 5, 'user_id' => 5],
        ]);
    }
}
