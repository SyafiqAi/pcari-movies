<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\UserRating;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreUserRatingRequest;
use App\Http\Requests\V1\UpdateUserRatingRequest;
use App\Models\Movie;

class UserRatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRatingRequest $request)
    {
        $movie_title = $request->movie_title;

        if (Movie::where('title', $movie_title)->exists()) {
            $movie_id = Movie::query()
                ->where('title', $movie_title)
                ->pluck('id')
                ->first();

            UserRating::create([
                'movie_id' => $movie_id,
                'username' => $request->username,
                'rating' => $request->rating,
                'r_description' => $request->r_description,
            ]);
            return response()->json(['message' => 'Created new rating']);
        } else {
            return response()->json(['message' => 'Movie '. $movie_title .' not found']);
        }

        return $request;
    }

    /**
     * Display the specified resource.
     */
    public function show(UserRating $userRating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserRating $userRating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRatingRequest $request, UserRating $userRating)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserRating $userRating)
    {
        //
    }
}
