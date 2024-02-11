<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {

            $admin = User::create([
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
            ]);
    }
}
