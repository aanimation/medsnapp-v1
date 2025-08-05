<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\{Role, User};

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $item = New Role();
        $item->role_name = 'Administrator';
        $item->save();

        $item = New Role();
        $item->role_name = 'Operator';
        $item->save();

        $item = New Role();
        $item->role_name = 'Player';
        $item->save();

        User::create([
            'role_id' => 1,
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@medsnapp.com',
            'password' => Hash::make('admin'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'role_id' => 2,
            'name' => 'Operator',
            'username' => 'operator',
            'email' => 'operator@medsnapp.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'role_id' => 3,
            'name' => 'User Tester',
            'username' => 'user-tester',
            'email' => 'tester@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'role_id' => 3,
            'name' => 'Player Tester',
            'username' => 'player-tester',
            'email' => 'tester@player.xyz',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
    }
}
