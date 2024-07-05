<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Like;

class LikeController extends Controller
{
    public function like(Request $request)
    {
        try{
            $like = new Like;
            $like->user_id = $request->user_id;
            $like->post_id = $request->post_id;

            $like->save();
            return response()->json([
                'status' => true,
                'message' => 'Post has been liked',
            ], 200);
        }catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
