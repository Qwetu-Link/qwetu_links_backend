<?php

namespace App\Http\Controllers\Api\v1;

use App\Events\v1\accounts\StaffCreated;
use App\Events\v1\accounts\StaffUpdate;
use App\Filters\v1\accounts\StaffFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\accounts\StoreStaffRequest;
use App\Http\Requests\v1\accounts\UpdateStaffRequest;
use App\Http\Resources\v1\accounts\StaffCollection;
use App\Http\Resources\v1\accounts\StaffResource;
use App\Models\accounts\Business;
use App\Models\accounts\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new StaffFilter;
        $filterItems = $filter->transform($request); // [['column', 'operator', 'value']]

        if (count($filterItems) == 0) {
            return new StaffCollection(Staff::paginate());
        } else {
            $staff = Staff::where($filterItems)->paginate();

            return new StaffCollection($staff->appends($request->query()));
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
    public function store(StoreStaffRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {

                $user = request()->user();

                $event = new StaffCreated($user, $request->validated());

                event($event);

                return response()->json([
                    'staff' => new StaffResource($event->staff),
                    'status' => true,
                    'message' => 'Staff Created Successfully',
                ], 201);

            });
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed To Create Staff',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Business $business, Staff $staff)
    {
        return new StaffResource($staff);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Staff $staff)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStaffRequest $request, Staff $staff)
    {
        try {
            return DB::transaction(function () use ($request, $staff) {

                $event = new StaffUpdate($staff, $request->validated());

                event($event);

                return response()->json([
                    'staff' => new StaffResource($staff->fresh()),
                    'status' => true,
                    'message' => 'Staff Updated successfully',
                ], 200);
            });

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to update staff',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Business $business, Staff $staff)
    {
        try {

            $staff->user?->delete();

            // $staff->delete();

            return response()->json([
                'status' => true,
                'message' => 'Staff Deleted successfully',
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to Delete Staff',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
