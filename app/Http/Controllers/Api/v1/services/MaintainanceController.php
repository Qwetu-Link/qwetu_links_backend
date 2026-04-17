<?php

namespace App\Http\Controllers\Api\v1\services;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\services\StoreMaintainanceRequest;
use App\Http\Requests\v1\services\UpdateMaintainanceRequest;
use App\Models\services\Maintainance;

class MaintainanceController extends Controller
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
    public function store(StoreMaintainanceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Maintainance $maintainance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Maintainance $maintainance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMaintainanceRequest $request, Maintainance $maintainance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Maintainance $maintainance)
    {
        //
    }
}
