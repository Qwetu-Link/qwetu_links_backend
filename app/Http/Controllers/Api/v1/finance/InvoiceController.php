<?php

namespace App\Http\Controllers\Api\v1\finance;

use App\Events\v1\finance\InvoiceCreated;
use App\Events\v1\finance\InvoiceUpdated;
use App\Filters\v1\finance\InvoiceFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\finance\StoreInvoiceRequest;
use App\Http\Requests\v1\finance\UpdateInvoiceRequest;
use App\Http\Resources\v1\finance\InvoiceCollection;
use App\Http\Resources\v1\finance\InvoiceResource;
use App\Models\finance\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new InvoiceFilter;

        $filterItems = $filter->transform($request);

        if(count($filterItems) == 0){
            return new InvoiceCollection(Invoice::paginate());
        }else{
            $invoice = Invoice::where($filterItems)->paginate(5)->withQueryString();

            return new InvoiceCollection($invoice);
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
    public function store(StoreInvoiceRequest $request)
    {
        try {

            return DB::transaction(function () use ($request) {
                $user = request()->user();

                $event = new InvoiceCreated($user, $request->validated());

                event($event);

                return response()->json([
                    'status' => true,
                    'message' => 'Invoice Added Successfully',
                    'invoice' => new InvoiceResource($event->invoice),
                ], 201);
            });

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed To Create Invoice',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        return new InvoiceResource($invoice);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        try {
            return DB::transaction(function () use ($request, $invoice) {

                $event = new InvoiceUpdated($invoice, $request->validated());

                event($event);

                return response()->json([
                    'invoice' => new InvoiceResource($invoice->fresh()),
                    'status' => true,
                    'message' => 'Invoice Update Successfuly',
                ], 200);
            });

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to Update Invoice',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        try {
            $invoice->delete();

            return response()->json([
                'status' => true,
                'message' => 'Invoice Deleted successfully',
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to Delete Invoice',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
