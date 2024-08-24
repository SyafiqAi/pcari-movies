<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Movie;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Http\Resources\V1\MovieCollection;
use App\Http\Resources\V1\MovieResource;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        #region genre
        $genre_query = $request->query('genre');
        $genres = explode(',',  $genre_query);

        $movies = Movie::query();

        if (isset($genre_query)) {
            foreach ($genres as $genre) {
                $movies->whereHas('genres', function (Builder $query) use ($genre) {
                    $query->where('name', 'like', '%' . $genre . '%');
                });
            }
        }
        #endregion

        #region theater desired date
        $theater_name_query = $request->query('theater_name');
        if (isset($theater_name_query)) {
            $movies = $movies->where('theater_name', $theater_name_query);
        }
        $desired_date_query = $request->query('d_date');
        if (isset($desired_date_query)) {
            $desired_date = Carbon::parse($desired_date_query);
            $movies = $movies->whereDate('start_time', $desired_date);
        }
        #endregion

        #region performer
        $performer_query = $request->query('performer');
        $performers = explode(',',  $performer_query);

        if (isset($performer_query)) {
            foreach ($performers as $performer) {
                $movies->whereHas('performers', function (Builder $query) use ($performer) {
                    $query->where('name', 'like', '%' . $performer . '%');
                });
            }
        }
        #endregion

        return new MovieCollection($movies->paginate());
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
