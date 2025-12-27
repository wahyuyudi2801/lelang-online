<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                [
                    'name' => 'Admin',
                    'email' => 'admin@example.com',
                    'password' => Hash::make('12341234'),
                    'nomor' => '08123456789',
                    'address' => 'Surabaya',
                    'role_id' => 1,
                    'status' => 1,
                    'url_photo' => null
                ],
                [
                    'name' => 'Owner',
                    'email' => 'owner@example.com',
                    'password' => Hash::make('12341234'),
                    'nomor' => '08987654321',
                    'address' => 'Surabaya',
                    'role_id' => 2,
                    'status' => 1,
                    'url_photo' => null
                ]
            ]
        );
    }
}
