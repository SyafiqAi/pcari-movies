<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Performer;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePerformerRequest;
use App\Http\Requests\UpdatePerformerRequest;

class PerformerController extends Controller
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
    public function store(StorePerformerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Performer $performer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Performer $performer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePerformerRequest $request, Performer $performer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Performer $performer)
    {
        //
    }
}
