<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\DiscountCode;

class DiscountController extends Controller
{
    // Applying the discount if not applied yet
    public function applyDiscount(Request $request) {
        $code = DiscountCode::where('code', $request->code)->findOrFail();
        if ($code -> is_used) {
            return response()->json(['error' => 'Discount code already used!'], 400);
        }
        $code->update(['is_used' => true]); // changing state
        return response()->json(['message' => "Discount code applied!"], 200); // success
    }
}
