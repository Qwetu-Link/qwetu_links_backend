<?php

namespace App\Http\Controllers\Api\v1\property;

use App\Events\v1\property\PropertyCreated;
use App\Filters\v1\property\PropertyFilter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\v1\property\StorePropertyRequest;
use App\Http\Requests\v1\property\UpdatePropertyRequest;
use App\Http\Resources\v1\property\PropertyCollection;
use App\Http\Resources\v1\property\PropertyResource;
use App\Models\property\Property;
use Illuminate\Support\Facades\DB;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new PropertyFilter;
        $filterItems = $filter->transform($request);

        $includeGallery = $request->query('includeGallery');

        $includeUnits = $request->query('includeUnits');

        $includeAmenity = $request->query('includeAmenity');

        $property = Property::where($filterItems);

        if($includeGallery){
            $property->with('gallery');
        }

        if($includeUnits){
            $property->with('units');
        }

        if($includeAmenity){
            $property->with('amenities');
        }

        $property = $property->paginate(5)->withQueryString();

        return new PropertyCollection($property);
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
    public function store(StorePropertyRequest $request)
    {
        try{
            return DB::transaction(function () use ($request) {
               $user = request()->user();
               $event = new PropertyCreated($user, $request->validated());

               event($event);

               return response()->json([
                    'property' => new PropertyResource($event->property),
                    'status' => true,
                    'message' => 'Tenant Created Successfully',
                ], 201);

            });
        }catch(\Exception $e){
            return response()->json([
                'status' => false,
                'message' => 'Failed To Create Property',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        $includeGallery = request()->query('includeGallery');
        $includeUnits = request()->query('includeUnits');
        $includeAmenity = request()->query('includeAmenity');

        if($includeGallery){
            return new PropertyResource($property->loadMissing('gallery'));
        }

        if($includeUnits){
            return new PropertyResource($property->loadMissing('units'));
        }

        if($includeAmenity){
            return new PropertyResource($property->loadMissing('amenities'));
        }

        return new PropertyResource($property);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePropertyRequest $request, Property $property)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        //
    }
}
