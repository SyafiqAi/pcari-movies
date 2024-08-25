<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\UserRating;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreUserRatingRequest;
use App\Http\Requests\V1\UpdateUserRatingRequest;
use App\Models\Movie;
use Throwable;

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

    #region store
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRatingRequest $request)
    {
        $movie_title = $request->movie_title;

        try {
            Movie::query()
                ->where('title', $movie_title)
                ->first()
                ->userRatings()
                ->create([
                    'username' => $request->username,
                    'rating' => $request->rating,
                    'r_description' => $request->r_description,
                ]);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Movie ' . $movie_title . ' not found'], 409);
        }


        return response()->json([
            "message" => "Successfully added review for " . $request->movie_title . " by user: " . $request->username,
            "success" => true
        ]);
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
