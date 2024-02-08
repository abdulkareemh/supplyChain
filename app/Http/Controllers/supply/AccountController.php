<?php

namespace App\Http\Controllers\supply;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    function index(Request $request)
    {
        $id = $request->user()->id;
        $supplier = Supplier::find($id);

        // Check if supplier exists
        if (!$supplier) {
            return response()->json(['message' => 'Supplier not found'], 404);
        }

        // Return supplier information
        return response()->json([
            'message' => 'Supplier retrieved successfully',
            'supplier' => $supplier
        ], 200);
    }
    public function update(Request $request, $id)
    {
        // Find the supplier
        $supplier = Supplier::find($id);
        if (!$supplier) {
            return response()->json(['message' => 'Supplier not found'], 404);
        }

        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:suppliers,email,' . $id,
            'password' => 'sometimes|required',
            'commercial_register_number' => 'nullable',
            'phone' => 'sometimes|required',
            'commercial_register_image' => 'nullable', // Add validation rules if needed
            'company_image' => 'nullable', // Add validation rules if needed
            'category' => 'sometimes|required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Update the supplier
        $supplier->update($request->only(['name', 'email', 'password', 'commercial_register_number', 'phone', 'category']));

        // If the password is being updated, hash it
        if ($request->has('password')) {
            $supplier->password = bcrypt($request->password);
            $supplier->save();
        }

        return response()->json(['message' => 'Supplier updated successfully.', 'supplier' => $supplier], 200);
    }
}
