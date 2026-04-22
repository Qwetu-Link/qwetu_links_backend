<?php

namespace App\Http\Controllers\Api\v1\services;

use App\Events\v1\services\MaintainanceCreated;
use App\Events\v1\services\MaintainanceUpdated;
use App\Filters\v1\services\MaintainanceFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\services\StoreMaintainanceRequest;
use App\Http\Requests\v1\services\UpdateMaintainanceRequest;
use App\Http\Resources\v1\services\MaintainaceCollection;
use App\Http\Resources\v1\services\MaintainaceResource;
use App\Models\services\Maintainance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaintainanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new MaintainanceFilter;

        $filterItems = $filter->transform($request);

        if(count($filterItems) == 0){
            return new MaintainaceCollection(Maintainance::paginate());
        }else{
            $maintainance = Maintainance::where($filterItems)->paginate(5)->withQueryString();

            return new MaintainaceCollection($maintainance);
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
    public function store(StoreMaintainanceRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $user = request()->user();

                $event = new MaintainanceCreated($user, $request->validated());

                event($event);

                return response()->json([
                    'status' => true,
                    'message' => 'Maintainance Added Successfully',
                    'maintainance' => new MaintainaceResource($event->maintainance),
                ], 201);
            });
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to Add Maintainance',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Maintainance $maintainance)
    {
        return new MaintainaceResource($maintainance);
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
        try {
            return DB::transaction(function () use ($request, $maintainance) {

                $event = new MaintainanceUpdated($maintainance, $request->validated());

                event($event);

                return response()->json([
                    'maintainance' => new MaintainaceResource($maintainance->fresh()),
                    'status' => true,
                    'message' => 'Maintainance Update Successfuly',
                ], 200);
            });

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to Update Maintainance',
                'error' => $e->getMessage(),
            ], 500);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Maintainance $maintainance)
    {
        try {
            $maintainance->delete();

            return response()->json([
                'status' => true,
                'message' => 'Maintenance Deleted successfully',
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to Delete Maintenance',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
