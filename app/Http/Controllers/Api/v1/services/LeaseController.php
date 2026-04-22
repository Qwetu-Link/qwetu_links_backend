<?php

namespace App\Http\Controllers\Api\v1\services;

use App\Events\v1\services\LeaseCreated;
use App\Events\v1\services\LeaseUpdated;
use App\Filters\v1\services\LeaseFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\services\StoreLeaseRequest;
use App\Http\Requests\v1\services\UpdateLeaseRequest;
use App\Http\Resources\v1\services\LeaseCollection;
use App\Http\Resources\v1\services\LeaseResource;
use App\Models\services\Lease;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new LeaseFilter;

        $filterItems = $filter->transform($request);

        if(count($filterItems) == 0){
            return new LeaseCollection(Lease::paginate());
        }else{
            $lease = Lease::where($filterItems)->paginate(5)->withQueryString();

            return new LeaseCollection($lease);
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
    public function store(StoreLeaseRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $user = request()->user();

                $event = new LeaseCreated($user, $request->validated());

                event($event);

                return response()->json([
                    'status' => true,
                    'message' => 'Lease Added Successfully',
                    'lease' => new LeaseResource($event->lease),
                ], 201);
            });
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to Add Lease',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Lease $lease)
    {
        return new LeaseResource($lease);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lease $lease)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLeaseRequest $request, Lease $lease)
    {
        try {
            return DB::transaction(function () use ($request, $lease) {

                $event = new LeaseUpdated($lease, $request->validated());

                event($event);

                return response()->json([
                    'lease' => new LeaseResource($lease->fresh()),
                    'status' => true,
                    'message' => 'Lease Update Successfuly',
                ], 200);
            });

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to Update Lease',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lease $lease)
    {
        try {
            $lease->delete();

            return response()->json([
                'status' => true,
                'message' => 'Lease Deleted successfully',
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to Delete Lease',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
