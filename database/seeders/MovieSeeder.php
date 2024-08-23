<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\Movie;
use App\Models\Performer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Performer::factory()
            ->count(20)
            ->create();


        DB::table('genres')->insert([
            ['name' => 'comedy'],
            ['name' => 'action'],
            ['name' => 'adventure'],
            ['name' => 'fantasy'],
            ['name' => 'horror'],
            ['name' => 'thriller'],
        ]);


        Movie::factory()
            ->count(25)
            ->hasUserRatings(10)
            ->create();

        $genres = Genre::all();
        $performers = Performer::all();

        Movie::all()->each(function ($movie) use ($genres) {
            $movie->genres()->attach(
                $genres->random(rand(1,3))->pluck('id')->toArray()
            );
        });
        Movie::all()->each(function ($movie) use ($performers) {
            $movie->performers()->attach(
                $performers->random(rand(1,5))->pluck('id')->toArray()
            );
        });

    }
}
