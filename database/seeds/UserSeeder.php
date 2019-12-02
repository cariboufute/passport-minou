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
            'name' => User::MINETTE,
            'email' => 'minette@minette.com',
            'email_verified_at' => now(),
            'password' => Hash::make('minette'),
            'image' => 'img/minette.jpg',
            'personal_access_token' => env('MINETTE_PERSONAL_TOKEN'),
            'remember_token' => Str::random(10),
        ]);

        $minou = User::create([
            'name' => 'Minou',
            'email' => 'minou@minette.com',
            'email_verified_at' => now(),
            'password' => Hash::make('minou'),
            'image' => 'img/minou.jpg',
            'personal_access_token' => env('MINOU_PERSONAL_TOKEN'),
            'remember_token' => Str::random(10),
            'is_husband' => true,
            'is_sexy' => true,
        ]);

        $matou = User::create([
            'name' => 'Matou',
            'email' => 'matou@minette.com',
            'email_verified_at' => now(),
            'password' => Hash::make('matou'),
            'image' => 'img/matou.jpg',
            'personal_access_token' => env('MATOU_PERSONAL_TOKEN'),
            'remember_token' => Str::random(10),
            'is_husband' => false,
            'is_sexy' => true,
        ]);

        $crackhead = User::create([
            'name' => 'Crackhead',
            'email' => 'crackhead@minette.com',
            'email_verified_at' => now(),
            'password' => Hash::make('crackhead'),
            'image' => 'img/crackhead.jpg',
            'personal_access_token' => env('CRACKHEAD_PERSONAL_TOKEN'),
            'remember_token' => Str::random(10),
            'is_husband' => false,
            'is_sexy' => false,
        ]);
    }
}
