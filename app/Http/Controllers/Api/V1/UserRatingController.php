<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\UserRating;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRatingRequest;
use App\Http\Requests\UpdateUserRatingRequest;

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
        //
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
