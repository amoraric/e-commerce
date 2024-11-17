<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(Request $request) {
        return response()->json($request->user());
    }
    
    public function update(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:70',
            'address' => 'nullable|string|max:70',
            'phone' => 'nullable|string|max:12',
        ]);
        $user = $request->user();
        $user->update($validated);
        return response()->json(['message' => 'Profile updated successfully']);
    }
    
}
