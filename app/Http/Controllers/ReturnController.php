<?php

namespace App\Http\Controllers;

use App\Models\ReturnModel;
use App\Http\Controllers\Traits\ApiResponse;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class ReturnController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $returns = ReturnModel::all();

        return $this->successResponse(
            $returns,
            'Returns retrieved successfully.'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(ReturnModel $return)
    {
        return $this->successResponse(
            $return,
            'Return retrieved successfully.'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $id)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'student_number' => 'required|integer|max:12',
            'proof' => 'required|string|max:255',
        ]);

        $user = JWTAuth::parseToken()->authenticate();

        $validated['item_id'] = $id;
        $validated['user_id'] = $user->id;
        $validated['status'] = 'pending';

        $return = ReturnModel::create($validated);

        return $this->successResponse(
            $return,
            'Return created successfully.',
            201
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ReturnModel $return)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'student_number' => 'required|integer|max:12',
            'proof' => 'required|string|max:255',
        ]);

        $return->update($validated);

        return $this->successResponse(
            $return,
            'Return updated successfully.',
            201
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReturnModel $return)
    {
        $return->delete();

        return $this->successResponse(
            null,
            'Return deleted successfully.'
        );
    }
}
