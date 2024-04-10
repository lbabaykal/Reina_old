<?php

namespace Database\Seeders;

use App\Models\Studio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudioSeeder extends Seeder
{

    public function run(): void
    {
        Studio::query()->create([
            'title' => 'Bones',
        ]);
        Studio::query()->create([
            'title' => 'Studio Ghibli',
        ]);
        Studio::query()->create([
            'title' => 'Kyoto Animation',
        ]);
        Studio::query()->create([
            'title' => 'CoMix Wave Films',
        ]);
        Studio::query()->create([
            'title' => 'Artland',
        ]);
        Studio::query()->create([
            'title' => 'Madhouse',
        ]);
        Studio::query()->create([
            'title' => 'Gainax',
        ]);
        Studio::query()->create([
            'title' => 'A-1 Pictures',
        ]);
        Studio::query()->create([
            'title' => 'OLM',
        ]);
        Studio::query()->create([
            'title' => 'Manglobe',
        ]);
        Studio::query()->create([
            'title' => 'Daume',
        ]);
        Studio::query()->create([
            'title' => 'Studio Voln',
        ]);
        Studio::query()->create([
            'title' => 'Ufotable',
        ]);
        Studio::query()->create([
            'title' => 'Shuka',
        ]);
        Studio::query()->create([
            'title' => 'P.A. Works',
        ]);
        Studio::query()->create([
            'title' => 'tvN',
        ]);
        Studio::query()->create([
            'title' => 'JTBC',
        ]);
        Studio::query()->create([
            'title' => 'KBS2',
        ]);
        Studio::query()->create([
            'title' => 'Netflix',
        ]);
        Studio::query()->create([
            'title' => 'OCN',
        ]);
        Studio::query()->create([
            'title' => 'Channel A',
        ]);
        Studio::query()->create([
            'title' => 'MBC',
        ]);
        Studio::query()->create([
            'title' => 'SBS',
        ]);
        Studio::query()->create([
            'title' => 'J.C. Staff',
        ]);
        Studio::query()->create([
            'title' => 'Goldmoon Film',
        ]);
        Studio::query()->create([
            'title' => 'Youku',
        ]);
        Studio::query()->create([
            'title' => 'Tencent Video',
        ]);
    }
}
