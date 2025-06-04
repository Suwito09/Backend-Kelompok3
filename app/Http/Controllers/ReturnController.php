<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReturnRequest;
use App\Http\Requests\UpdateStatusItemRequest;
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
    public function store(StoreReturnRequest $request, int $id)
    {
        $user = JWTAuth::parseToken()->authenticate();

        $payload = $request->validated();
        $payload['item_id'] = $id;
        $payload['user_id'] = $user->id;
        $payload['status'] = ReturnModel::STATUS_PENDING;

        $return = ReturnModel::create($payload);

        return $this->successResponse(
            $return,
            'Return created successfully.',
            201
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreReturnRequest $request, ReturnModel $return)
    {
        $payload = $request->validated();
        $return->update($payload);

        return $this->successResponse(
            $return,
            'Return updated successfully.',
            201
        );
    }

    public function updateStatus(UpdateStatusItemRequest $request, ReturnModel $return)
    {
        $payload = $request->validated();
        $return->update($payload);

        return $this->successResponse(
            null,
            'Return status updated successfully.',
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
