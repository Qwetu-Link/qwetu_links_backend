<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\accounts\Staff;
use App\Http\Requests\accounts\StoreStaffRequest;
use App\Http\Requests\accounts\UpdateStaffRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\accounts\StaffCollection;
use App\Http\Resources\v1\accounts\StaffResource;
use App\Filters\v1\accounts\StaffFilter;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new StaffFilter();
        $filterItems = $filter->transform($request); //[['column', 'operator', 'value']]

        if(count($filterItems) == 0){
            return new StaffCollection(Staff::paginate());
        }else{
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Staff $staff)
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Staff $staff)
    {
        //
    }
}
