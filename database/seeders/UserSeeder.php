<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{

    public function run(): void
    {
        User::query()->create([
            'name' => 'BaBaYKA',
            'email' => 'mei.babayka@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('q1w2e3r4t5y6'),
        ]);

        User::query()->create([
            'name' => 'Misaki',
            'email' => 'misaki.babayka@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('q1w2e3r4t5y6'),
        ]);

        User::query()->create([
            'name' => 'Aika',
            'email' => 'aika.babayka@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('q1w2e3r4t5y6'),
        ]);

        Team::query()->create([
            'user_id' => 1,
            'name' => 'BaBaYKA Team',
            'personal_team' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Team::query()->create([
            'user_id' => 2,
            'name' => 'Misaki Team',
            'personal_team' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Team::query()->create([
            'user_id' => 3,
            'name' => 'Aika Team',
            'personal_team' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
