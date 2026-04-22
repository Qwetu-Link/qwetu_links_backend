<?php

namespace App\Http\Controllers\Api\v1\finance;

use App\Events\v1\finance\PaymentCreated;
use App\Events\v1\finance\PaymentUpdated;
use App\Filters\v1\finance\PaymentFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\finance\StorePaymentRequest;
use App\Http\Requests\v1\finance\UpdatePaymentRequest;
use App\Http\Requests\v1\services\UpdateMaintainanceRequest;
use App\Http\Resources\v1\finance\PaymentCollection;
use App\Http\Resources\v1\finance\PaymentResource;
use App\Models\finance\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new PaymentFilter;

        $filterItems = $filter->transform($request);

        if(count($filterItems) == 0){
            return new PaymentCollection(Payment::paginate());
        }else{
            $payment = Payment::where($filterItems)->paginate(5)->withQueryString();

            return new PaymentCollection($payment);
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
    public function store(StorePaymentRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $user = request()->user();

                $event = new PaymentCreated($user, $request->validated());

                event($event);

                return response()->json([
                    'status' => true,
                    'message' => 'Payment Added Successfully',
                    'payment' => new PaymentResource($event->payment),
                ], 201);
            });
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to Add Payment',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        return new PaymentResource($payment);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        try {
            return DB::transaction(function () use ($request, $payment) {

                $event = new PaymentUpdated($payment, $request->validated());

                event($event);

                return response()->json([
                    'payment' => new PaymentResource($payment->fresh()),
                    'status' => true,
                    'message' => 'Payment Update Successfuly',
                ], 200);
            });

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to Update Payment',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        try {
            $payment->delete();

            return response()->json([
                'status' => true,
                'message' => 'Payment Deleted successfully',
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to Delete Payment',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
