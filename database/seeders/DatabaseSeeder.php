<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
//         User::factory(10)->create();

        User::factory()->create([
            'name' => 'BaBaYKA',
            'email' => 'mei.babayka@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => '$2y$12$MoFEHQGajx58iZQdhVy5Vu9bSWr2z4HM3aWLLDZDKgQJ8Upq64EA2',
        ]);

        Team::query()->create([
            'user_id' => 1,
            'name' => 'BaBaYKA Team',
            'personal_team' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $this->call([
            TypeSeeder::class,
            GenreSeeder::class,
            StudioSeeder::class,
            CountrySeeder::class,
//            Folders::class,
//            Permissions::class,
//            Roles::class,
//            Users::class,
        ]);


    }
}
