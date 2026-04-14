<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\accounts\Business;
use App\Http\Requests\accounts\StoreBusinessRequest;
use App\Http\Requests\accounts\UpdateBusinessRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\accounts\BusinessResource;
use App\Http\Resources\v1\accounts\BusinessCollection;
use App\Filters\v1\accounts\BusinessFilter;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new BusinessFilter();
        $filterItems = $filter->transform($request); //[['column', 'operator', 'value']]

        $includeUsers = $request->query('includeUsers');

        //This applies filters to your query. and Split it into pages 
        $business = Business::where($filterItems);

        if($includeUsers){
            $business->with('users');
        }
            //Appends -> It keeps your filters when switching pages.
        return new BusinessCollection($business->paginate()->appends($request->query())); 
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
    public function store(StoreBusinessRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Business $business)
    {
        $includeUsers = request()->query('includeUsers');

        if($includeUsers){
            return new BusinessResource($business->loadMissing('users'));
        }

        return new BusinessResource($business);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Business $business)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBusinessRequest $request, Business $business)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Business $business)
    {
        //
    }
}
