<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Http\Controllers\Traits\ApiResponse;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class ItemController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::all();

        return $this->successResponse(
            $items,
            'Items retrieved successfully.'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'image' => 'required|string|max:255',
            'type' => 'required|string|max:255',
        ]);

        $user = JWTAuth::parseToken()->authenticate();

        $validated['user_id'] = $user->id;
        $validated['status'] = 'pending';

        $item = Item::create($validated);

        return $this->successResponse(
            $item,
            'Item created successfully.',
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        return $this->successResponse(
            $item,
            'Item retrieved successfully.'
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'sometimes|string|max:255',
            'location' => 'sometimes|string|max:255',
            'image' => 'sometimes|string|max:255',
            'type' => 'sometimes|string|max:255',
        ]);

        $item->update($validated);

        return $this->successResponse(
            $item,
            'Item updated successfully.',
            201
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $item->delete();

        return $this->successResponse(
            null,
            'Item deleted successfully.'
        );
    }
}
