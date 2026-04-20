<?php

namespace App\Http\Controllers\Api\v1\property;

use App\Events\v1\property\UnitCreated;
use App\Events\v1\property\UnitUpdated;
use App\Filters\v1\property\UnitFilter;
use App\Http\Controllers\Controller;
use App\Models\property\Units;
use App\Http\Requests\v1\property\StoreUnitsRequest;
use App\Http\Requests\v1\property\UpdateUnitsRequest;
use App\Http\Resources\v1\property\UnitCollection;
use App\Http\Resources\v1\property\UnitResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UnitsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new UnitFilter;
        $filterItems = $filter->transform($request);

        if (count($filterItems) == 0) {
            return new UnitCollection(Units::paginate());
        } else {
            $units = Units::where($filterItems)->paginate(5)->withQueryString();

            return new UnitCollection($units);
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
    public function store(StoreUnitsRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $user = request()->user();

                $event = new UnitCreated($user, $request->validated());

                event($event);

                return response()->json([
                    'status' => true,
                    'message' => 'Units Added Successfully',
                    'amenity' => new UnitResource($event->units),
                ], 201);
            });
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to Add Units',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Units $units)
    {
        return new UnitResource($units);
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
        try {
            return DB::transaction(function () use ($request, $units) {

                $event = new UnitUpdated($units, $request->validated());

                event($event);

                return response()->json([
                    'unit' => new UnitResource($units->fresh()),
                    'status' => true,
                    'message' => 'Units Updated successfully',
                ], 200);
            });

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to Update Unit',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Units $units)
    {
        try {
            $units->delete();

            return response()->json([
                'status' => true,
                'message' => 'Unit Deleted successfully',
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to Delete Unit',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
