<?php

namespace App\Http\Resources\V1;

use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    private function number_format_short($n, $precision = 1)
    {
        if ($n < 900) {
            // 0 - 900
            $n_format = number_format($n, $precision);
            $suffix = '';
        } else if ($n < 900000) {
            // 0.9k-850k
            $n_format = number_format($n / 1000, $precision);
            $suffix = 'K';
        } else if ($n < 900000000) {
            // 0.9m-850m
            $n_format = number_format($n / 1000000, $precision);
            $suffix = 'M';
        } else if ($n < 900000000000) {
            // 0.9b-850b
            $n_format = number_format($n / 1000000000, $precision);
            $suffix = 'B';
        } else {
            // 0.9t+
            $n_format = number_format($n / 1000000000000, $precision);
            $suffix = 'T';
        }

        // Remove unecessary zeroes after decimal. "1.0" -> "1"; "1.00" -> "1"
        // Intentionally does not affect partials, eg "1.50" -> "1.50"
        if ($precision > 0) {
            $dotzero = '.' . str_repeat('0', $precision);
            $n_format = str_replace($dotzero, '', $n_format);
        }

        return $n_format . $suffix;
    }

    public function toArray(Request $request): array
    {
        return [
            'Movie_ID' => $this->id,
            'Title' => $this->title,
            'Duration' => CarbonInterval::make($this->length, 'minutes')->cascade()->forHumans(),
            'Views' => $this->number_format_short($this->views),
            'Genres' => $this->genres()->get()->pluck('name'),
            'Description' => $this->description,
            'Overall_rating' => $this->userRatings()->get()->pluck('rating')->average(),
            'Start_time' => $this->start_time,
            'End_time' => $this->end_time,
            'Theater_name' => $this->theater_name,
            'Theater_room_no' => $this->theater_room_no,
            'Director' => $this->director,
            'Performers' => $this->performers()
                // ->select('name', 'performer_id')
                ->get()
                ->pluck('name'),
            'Release_date' => $this->release,
        ];
    }
}
