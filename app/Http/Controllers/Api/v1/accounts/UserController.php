<?php

namespace App\Http\Controllers\Api\v1\accounts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\accounts\StoreUserRequest;
use App\Http\Requests\v1\accounts\UpdateUserRequest;
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


        // $includeStaff = $request->query('includeStaff');
        // $includeTenant = $request->query('includeTenant');

        $user = User::where($filterItems)->with(['staff', 'tenant'])->paginate(5)->withQueryString();

        // if ($includeStaff) {
        //     $user->with('staff');
        // }

        // if ($includeTenant) {
        //     $user->with('tenant');
        // }

        // $user = $user->paginate(5)->withQueryString();

        return new UserCollection($user);
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
        // $user = User::create($request->validated());

        // $token = $user->createToken('mobile')->plainTextToken;

        // return response()->json([
        //     'user' => new UserResource($user),
        //     'token' => $token
        // ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        // $includeStaff = request()->query('includeStaff');
        // $includeTenant = request()->query('includeTenant');

        // if ($includeStaff) {
        //     return new UserResource($user->loadMissing('staff'));
        // }

        // if ($includeTenant) {
        //     return new UserResource($user->loadMissing('tenant'));
        // }
        $user->load(['staff', 'tenant']);
        
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
        try {
            $user->delete();

            return response()->json([
                'status' => true,
                'message' => 'User Deleted successfully',
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to Delete User',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
