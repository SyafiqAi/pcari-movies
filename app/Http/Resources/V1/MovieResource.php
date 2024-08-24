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
    public function toArray(Request $request): array
    {
        return [
            'Movie_ID' => $this->id,
            'Title' => $this->title,
            'Duration' => CarbonInterval::make($this->length, 'minutes')->cascade()->forHumans(),
            'Views' => 'missing',
            'Genres' => $this->genres()->get()->pluck('name'),
            'Overall_rating' => $this->userRatings()->get()->pluck('rating')->average(),
            'Description' => $this->description,
            'Start_time' => $this->start_time,
            'End_time' => $this->end_time,
            'Theater_name' => $this->theater_name,
            'Theater_room_no' => $this->theater_room_no,
        ];
    }
}
