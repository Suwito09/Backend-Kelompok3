<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChatRequest;
use App\Models\Chat;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Traits\ApiResponse;

class ChatController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreChatRequest $request, int $id)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $payload = $request->validated();
        $payload['user_id'] = $user->id;
        $payload['item_id'] = $id;
        $return = Chat::create($payload);

        return $this->successResponse(
            $return,
            'comment created succesfully.'
        );
    }

    /**
     * Display the specified resource.
     */
    public function showCommentsByItem(int $item_id)
    {
        $comments = Chat::with('user') // menampilkan data user yang berkomentar
                    ->where('item_id', $item_id)
                    ->orderBy('created_at', 'asc')
                    ->get();

        return $this->successResponse(
            $comments,
            'List of comments for item ID: ' . $item_id
        );
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $comment = Chat::find($id);

        // Pastikan komentar ditemukan dan pengguna yang membuatnya
        if (!$comment || $comment->user_id != $user->id) {
            return $this->errorResponse('Comment not found or unauthorized.', 404);
        }

        $comment->update([
            'message' => $request->message
        ]);

        return $this->successResponse(
            $comment,
            'Comment updated successfully.'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $comment = Chat::find($id);

        // Pastikan komentar ditemukan dan pengguna yang membuatnya
        if (!$comment || $comment->user_id != $user->id) {
            return $this->errorResponse('Comment not found or unauthorized.', 404);
        }

        // Hapus komentar
        $comment->delete();

        return $this->successResponse(
            null,
            'Comment deleted successfully.'
        );
    }
}
