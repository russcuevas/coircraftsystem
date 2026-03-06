<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'email' => 'russelcuevas0@gmail.com',
                'password' => Hash::make('123456789'),
                'fullname' => 'Russel Vincent Cuevas',
                'address' => 'Batangas, Philippines',
                'phone_number' => '09495748301',
            ],
            [
                'email' => 'jane.doe@example.com',
                'password' => Hash::make('123456789'),
                'fullname' => 'Jane Doe',
                'address' => 'Manila, Philippines',
                'phone_number' => '09171234567',
            ],
            [
                'email' => 'john.smith@example.com',
                'password' => Hash::make('123456789'),
                'fullname' => 'John Smith',
                'address' => 'Cebu, Philippines',
                'phone_number' => '09281234567',
            ],
            [
                'email' => 'mary.jones@example.com',
                'password' => Hash::make('123456789'),
                'fullname' => 'Mary Jones',
                'address' => 'Davao, Philippines',
                'phone_number' => '09391234567',
            ],
            [
                'email' => 'peter.parker@example.com',
                'password' => Hash::make('123456789'),
                'fullname' => 'Peter Parker',
                'address' => 'Quezon City, Philippines',
                'phone_number' => '09451234567',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
