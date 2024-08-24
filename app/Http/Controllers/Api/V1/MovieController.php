<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Movie;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Http\Resources\V1\MovieCollection;
use App\Http\Resources\V1\MovieResource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $genre_query = $request->query('genre');
        $genres = explode(',',  $genre_query);

        // dd($genres);

        if (isset($genre_query)) {
            $movies = Movie::has('genres');
            foreach ($genres as $genre) {
                $movies->whereHas('genres', function (Builder $query) use ($genre) {
                    $query->where('name', 'like', '%' . $genre . '%');
                });
            }
            $movies = $movies->get();

            return new MovieCollection($movies);
        }

        return new MovieCollection(Movie::paginate());
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
    public function store(StoreMovieRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie)
    {
        return new MovieResource($movie);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMovieRequest $request, Movie $movie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        //
    }
}
