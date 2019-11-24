<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $minette = User::create([
            'name' => 'Minette',
            'email' => 'minette@minette.com',
            'email_verified_at' => now(),
            'password' => \Illuminate\Support\Facades\Hash::make('minette'),
            'remember_token' => Str::random(10),
        ]);

        $minou = User::create([
            'name' => 'Minou',
            'email' => 'minou@minette.com',
            'email_verified_at' => now(),
            'password' => \Illuminate\Support\Facades\Hash::make('minou'),
            'remember_token' => Str::random(10),
            'is_husband' => true,
            'is_sexy' => true,
        ]);

        $matou = User::create([
            'name' => 'Matou',
            'email' => 'matou@minette.com',
            'email_verified_at' => now(),
            'password' => \Illuminate\Support\Facades\Hash::make('matou'),
            'remember_token' => Str::random(10),
            'is_husband' => false,
            'is_sexy' => true,
        ]);

        $crackhead = User::create([
            'name' => 'Crackhead',
            'email' => 'crackhead@minette.com',
            'email_verified_at' => now(),
            'password' => \Illuminate\Support\Facades\Hash::make('crackhead'),
            'remember_token' => Str::random(10),
            'is_husband' => false,
            'is_sexy' => false,
        ]);
    }
}
