<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'M Aly Perdana P',
            'email' => 'rafly@gmail.com',
            'password' => Hash::make('aly123'),
            'jabatan' => 'Administrator',
            'roletype' => 'admin',
        ]);
    }
}
