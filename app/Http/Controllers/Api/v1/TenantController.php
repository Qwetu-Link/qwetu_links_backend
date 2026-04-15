<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\accounts\Tenant;
use App\Http\Requests\v1\accounts\StoreTenantRequest;
use App\Http\Requests\v1\accounts\UpdateTenantRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\accounts\TenantCollection;
use App\Http\Resources\v1\accounts\TenantResource;
use App\Filters\v1\accounts\TenantFilter;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new TenantFilter();
        $filterItems = $filter->transform($request); //[['column', 'operator', 'value']]

        if(count($filterItems) == 0){
            return new TenantCollection(Tenant::paginate());
        }else{
            $tenant = Tenant::where($filterItems)->paginate();
            return new TenantCollection($tenant->appends($request->query()));
        }
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
    public function store(StoreTenantRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Tenant $tenant)
    {
        return new TenantResource($tenant);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tenant $tenant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTenantRequest $request, Tenant $tenant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tenant $tenant)
    {
        //
    }
}
