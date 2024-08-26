<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Movie;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreMovieRequest;
use App\Http\Requests\V1\UpdateMovieRequest;
use App\Http\Resources\V1\MovieCollection;
use App\Http\Resources\V1\MovieResource;
use App\Models\Genre;
use App\Models\Performer;
use Carbon\Carbon;
use Exception;
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
        $performer_query = $request->query('performer_name');
        $performers = explode(',',  $performer_query);

        if (isset($performer_query)) {
            foreach ($performers as $performer) {
                $movies->whereHas('performers', function (Builder $query) use ($performer) {
                    $query->where('name', 'like', '%' . $performer . '%');
                });
            }
        }
        #endregion

        #region release date
        $release_date_query = $request->query('r_date');
        if (isset($release_date_query)) {
            $movies = $movies->whereDate('release', '<=', $release_date_query)->orderByDesc('release');
        }
        #endregion

        #region timeslot


        if (
            $request->query('time_start') !== null
            && $request->query('time_end') !== null
        ) {
            $time_start_query = Carbon::parse($request->query('time_start'));
            $time_end_query = Carbon::parse($request->query('time_end'));
            $movies = $movies->where('start_time', '>=', $time_start_query)->where('end_time', '<=', $time_end_query);
        }

        // dd($time_start_query);


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
        $movie = Movie::create([
            ...$request->all(),
            'views' => 0,
        ]);

        #region attaching genres
        $genres = $request->genres;
        if (isset($genres)) {
            $genre_ids = [];
            foreach ($genres as $genre) {
                $genre_id = Genre::firstOrCreate(['name' => $genre]) -> id;
                $genre_ids[] = $genre_id;
            }
            $movie->genres()->attach($genre_ids);
        }
        #endregion

        #region attaching performers
        $performers = $request->performers;
        if (isset($performers)) {
            $performer_ids = [];
            foreach ($performers as $performer) {
                $performer_id = Performer::firstOrCreate(['name' => $performer]) -> id;
                $performer_ids[] = $performer_id;
            }
            $movie->performers()->attach($performer_ids);
        }
        #endregion

        return response()->json([
            "message" => "Successfully added movie " . $request->title .  " with Movie_ID " . $movie->id,
            "success" => true

        ]);
        // return new MovieResource($movie);
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
