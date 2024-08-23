<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $mpaa_rating = 'PG-' . $this->faker->numberBetween(12,18);

        $length = $this->faker->numberBetween(30,180);
        
        $start_time = $this->faker->dateTimeThisYear();
        $end_time = Carbon::parse($start_time)->addminutes($length);
        
        return [
            'title' => $this->faker->city(),
            'release' => $this->faker->date(),
            'length' => $length,
            'description' => $this->faker->text(),
            'mpaa_rating' => $mpaa_rating,
            'director' => $this->faker->name(),
            'language' => $this->faker->randomElement(['English', 'Malay', 'Mandarin', 'Tamil']),
            'theater_name' => $this->faker->randomElement(['pcari movies', 'abc movies', 'golden movies']),
            'theater_room_no' => $this->faker->numberBetween(1,15),
            'start_time' => $start_time,
            'end_time' => $end_time,

        ];
    }
}
