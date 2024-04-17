<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
            $users = [
                [
                    'name' => 'Serdar Terzi2',
                    'email' => 'srdrtrz@gmail.com',
                    'password' => Hash::make('123456')
                ],
                [
                    'name' => 'Serdar Terzi',
                    'email' => 'srdrtrz2@gmail.com',
                    'password' => Hash::make('123456')
                ],
                [
                    'name' => 'Serdar Terzi',
                    'email' => 'srdrtrz3@gmail.com',
                    'password' => Hash::make('123456')
                ],            
            ];

            foreach ($users as $user) {
                User::insert($user);
            }
        }

}
