<?php

namespace App\Http\Controllers\Api\v1;

use App\Events\v1\accounts\TenantCreated;
use App\Events\v1\accounts\TenantUpdate;
use App\Filters\v1\accounts\TenantFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\accounts\StoreTenantRequest;
use App\Http\Requests\v1\accounts\UpdateTenantRequest;
use App\Http\Resources\v1\accounts\TenantCollection;
use App\Http\Resources\v1\accounts\TenantResource;
use App\Models\accounts\Business;
use App\Models\accounts\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new TenantFilter;
        $filterItems = $filter->transform($request); // [['column', 'operator', 'value']]

        if (count($filterItems) == 0) {
            return new TenantCollection(Tenant::paginate());
        } else {
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
        // explicit guard
        // $user = auth('api')->user();

        try {
            return DB::transaction(function () use ($request) {

                $user = request()->user();

                $event = new TenantCreated($user, $request->validated());

                event($event);

                return response()->json([
                    'tenant' => new TenantResource($event->tenant),
                    'status' => true,
                    'message' => 'Tenant Created Successfully',
                ], 201);
            });
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to Create Tenant',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Business $business, Tenant $tenant)
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
        try {
            return DB::transaction(function () use ($request, $tenant) {

                $event = new TenantUpdate($tenant, $request->validated());

                event($event);

                return response()->json([
                    'tenant' => new TenantResource($tenant->fresh()),
                    'status' => true,
                    'message' => 'Tenant Updated successfully',
                ], 200);
            });
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to Update Tenant',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Business $business, Tenant $tenant)
    {
        try {
            $tenant->user?->delete();

            return response()->json([
                'status' => true,
                'message' => 'Tenant Deleted successfully',
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to Delete Tenant',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
