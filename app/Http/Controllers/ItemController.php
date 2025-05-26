<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Item::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'location' => 'required|integer',
            'image' => 'required|string|max:255',
            'type' => 'required|string|max:255',
        ]);

        $user = JWTAuth::parseToken()->authenticate();

        $validated['user_id'] = $user->id;
        $validated['status'] = 'pending';
        $validated['created_at'] = now();

        $item = Item::create($validated);

        return response()->json($item, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        return response()->json($item);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'location' => 'required|integer',
            'image' => 'required|string|max:255',
            'type' => 'required|string|max:255',
        ]);

        $item->update($validated);

        return response()->json($item);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $item->delete();

        return response()->json(['message' => 'Item deleted successfully.']);
    }
}
