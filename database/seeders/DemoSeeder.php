<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\{Role, User};

class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'role_id' => 3,
            'name' => 'Demo-User',
            'username' => 'demo-user',
            'email' => 'demo-user@medsnapp.com',
            'password' => Hash::make('demo-medsnapp'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        // User::create([
        //     'role_id' => 3,
        //     'name' => 'Demo-Asthma',
        //     'username' => 'demo-as',
        //     'email' => 'demo-asthma@medsnapp.com',
        //     'password' => Hash::make('demo-medsnapp'),
        //     'email_verified_at' => now(),
        //     'remember_token' => Str::random(10),
        // ]);

        // User::create([
        //     'role_id' => 3,
        //     'name' => 'Demo-DK',
        //     'username' => 'demo-dk',
        //     'email' => 'demo-dk@medsnapp.com',
        //     'password' => Hash::make('demo-medsnapp'),
        //     'email_verified_at' => now(),
        //     'remember_token' => Str::random(10),
        // ]);

        // User::create([
        //     'role_id' => 3,
        //     'name' => 'Demo-HF',
        //     'username' => 'demo-hf',
        //     'email' => 'demo-hf@medsnapp.com',
        //     'password' => Hash::make('demo-medsnapp'),
        //     'email_verified_at' => now(),
        //     'remember_token' => Str::random(10),
        // ]);

        // User::create([
        //     'role_id' => 3,
        //     'name' => 'Demo-COPD',
        //     'username' => 'demo-copd',
        //     'email' => 'demo-copd@medsnapp.com',
        //     'password' => Hash::make('demo-medsnapp'),
        //     'email_verified_at' => now(),
        //     'remember_token' => Str::random(10),
        // ]);

        // User::create([
        //     'role_id' => 3,
        //     'name' => 'Demo-TSS',
        //     'username' => 'demo-tss',
        //     'email' => 'demo-tss@medsnapp.com',
        //     'password' => Hash::make('demo-medsnapp'),
        //     'email_verified_at' => now(),
        //     'remember_token' => Str::random(10),
        // ]);

        // User::create([
        //     'role_id' => 3,
        //     'name' => 'Demo-Anaphylaxis',
        //     'username' => 'demo-aplx',
        //     'email' => 'demo-aplx@medsnapp.com',
        //     'password' => Hash::make('demo-medsnapp'),
        //     'email_verified_at' => now(),
        //     'remember_token' => Str::random(10),
        // ]);
    }
}
