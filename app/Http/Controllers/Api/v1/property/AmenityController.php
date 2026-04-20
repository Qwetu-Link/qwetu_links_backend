<?php

namespace App\Http\Controllers\Api\v1\property;

use App\Events\v1\property\AmenityCreated;
use App\Events\v1\property\AmenityUpdated;
use App\Filters\v1\property\AmenityFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\property\StoreAmenityRequest;
use App\Http\Requests\v1\property\UpdateAmenityRequest;
use App\Http\Resources\v1\property\AmenityCollection;
use App\Http\Resources\v1\property\AmenityResource;
use App\Listeners\v1\property\UpdateAmenity;
use App\Models\property\Amenity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AmenityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new AmenityFilter;
        $filterItems = $filter->transform($request);

        if (count($filterItems) == 0) {
            return new AmenityCollection(Amenity::paginate());
        } else {
            $amenity = Amenity::where($filterItems)->paginate(5)->withQueryString();

            return new AmenityCollection($amenity);
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
    public function store(StoreAmenityRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $user = request()->user();

                $event = new AmenityCreated($user, $request->validated());

                event($event);

                return response()->json([
                    'status' => true,
                    'message' => 'Amenity Added Successfully',
                    'amenity' => new AmenityResource($event->amenity),
                ], 201);
            });
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to Add Amenity',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Amenity $amenity)
    {
        return new AmenityResource($amenity);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Amenity $amenity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAmenityRequest $request, Amenity $amenity)
    {
        try {
            return DB::transaction(function () use ($request, $amenity) {

                $event = new AmenityUpdated($amenity, $request->validated());

                event($event);

                return response()->json([
                    'staff' => new AmenityResource($amenity->fresh()),
                    'status' => true,
                    'message' => 'Amenity Updated successfully',
                ], 200);
            });

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to Update Amenity',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Amenity $amenity)
    {
        try {
            $amenity->delete();

            return response()->json([
                'status' => true,
                'message' => 'Amenity Deleted successfully',
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to Delete Amenity',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
