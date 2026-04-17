<?php

namespace App\Http\Controllers\Api\v1\property;

use App\Http\Controllers\Controller;
use App\Models\property\Units;
use App\Http\Requests\v1\property\StoreUnitsRequest;
use App\Http\Requests\v1\property\UpdateUnitsRequest;

class UnitsController extends Controller
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
    public function store(StoreUnitsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Units $units)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Units $units)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUnitsRequest $request, Units $units)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Units $units)
    {
        //
    }
}
