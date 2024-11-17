<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    // Applying the discount if not applied yet
    public function applyDiscount(Request $request) {
        $code = DiscountCode::where('code', $request->code)->findOrFail();
        if ($code -> is_used) {
            return response()->json(['error' => 'Discount code already used!'], 400);
        }
        $code->update(['is_used' => true]); // changing state
        return response()->json(['message' => "Discount code applied!"], 200); // success
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
