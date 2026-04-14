<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\accounts\StoreUserRequest;
use App\Http\Requests\accounts\UpdateUserRequest;
use App\Http\Resources\v1\accounts\UserCollection;
use App\Http\Resources\v1\accounts\UserResource;
use App\Models\accounts\User;
use App\Filters\v1\accounts\UserFilter;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new UserFilter();
        $filterItems = $filter->transform($request); //[['column', 'operator', 'value']]


        $includeStaff = $request->query('includeStaff');
        $includeTenant = $request->query('includeTenant');

        $user = User::where($filterItems);

        if ($includeStaff) {
            $user->with('staff');
        }

        if ($includeTenant) {
            $user->with('tenant');
        }

        return new UserCollection($user->paginate()->appends($request->query()));
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
    public function store(StoreUserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $includeStaff = request()->query('includeStaff');
        $includeTenant = request()->query('includeTenant');

        if ($includeStaff) {
            return new UserResource($user->loadMissing('staff'));
        }

        if ($includeTenant) {
            return new UserResource($user->loadMissing('tenant'));
        }
        
        return new UserResource($user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
