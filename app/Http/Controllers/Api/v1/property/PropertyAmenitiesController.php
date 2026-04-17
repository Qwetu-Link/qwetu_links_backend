<?php

namespace App\Http\Controllers\Api\v1\property;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\property\StorePropertyAmenitiesRequest;
use App\Http\Requests\v1\property\UpdatePropertyAmenitiesRequest;
use App\Models\property\PropertyAmenities;

class PropertyAmenitiesController extends Controller
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
    public function store(StorePropertyAmenitiesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PropertyAmenities $propertyAmenities)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PropertyAmenities $propertyAmenities)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePropertyAmenitiesRequest $request, PropertyAmenities $propertyAmenities)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PropertyAmenities $propertyAmenities)
    {
        //
    }
}
