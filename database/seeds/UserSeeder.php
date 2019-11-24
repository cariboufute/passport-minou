<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
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
        $minette = User::create([
            'name' => 'Minette',
            'email' => 'minette@minette.com',
            'email_verified_at' => now(),
            'password' => Hash::make('minette'),
            'image' => 'image/minette.jpg',
            'remember_token' => Str::random(10),
        ]);

        $minou = User::create([
            'name' => 'Minou',
            'email' => 'minou@minette.com',
            'email_verified_at' => now(),
            'password' => Hash::make('minou'),
            'image' => 'image/minou.jpg',
            'remember_token' => Str::random(10),
            'is_husband' => true,
            'is_sexy' => true,
        ]);

        $matou = User::create([
            'name' => 'Matou',
            'email' => 'matou@minette.com',
            'email_verified_at' => now(),
            'password' => Hash::make('matou'),
            'image' => 'image/matou.jpg',
            'remember_token' => Str::random(10),
            'is_husband' => false,
            'is_sexy' => true,
        ]);

        $crackhead = User::create([
            'name' => 'Crackhead',
            'email' => 'crackhead@minette.com',
            'email_verified_at' => now(),
            'password' => Hash::make('crackhead'),
            'image' => 'image/crackhead.jpg',
            'remember_token' => Str::random(10),
            'is_husband' => false,
            'is_sexy' => false,
        ]);
    }
}
