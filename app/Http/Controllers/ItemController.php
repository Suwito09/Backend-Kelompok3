<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateStatusItemRequest;
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
     * Store a newly created resource in storage.
     */
    public function store(StoreItemRequest $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $payload = $request->only(['name', 'description', 'location', 'type']);

        $path = $request->file('image')->store('images', 'public');

        $payload['image'] = basename($path);
        $payload['user_id'] = $user->id;
        $payload['status'] = Item::STATUS_PENDING;

        $item = Item::create($payload);

        return $this->successResponse(
            $item,
            'Item created successfully.',
            201
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreItemRequest $request, Item $item)
    {
        $payload = $request->validated();

        $item->update($payload);

        return $this->successResponse(
            $item,
            'Item updated successfully.',
            201
        );
    }

    public function updateStatus(UpdateStatusItemRequest $request, Item $item)
    {
        $payload = $request->validated();
        $item->update($payload);

        return $this->successResponse(
            null,
            'Item status updated successfully.',
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
