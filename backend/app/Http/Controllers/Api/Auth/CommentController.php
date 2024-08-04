<?php

namespace App\Http\Controllers\api\auth;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function comment(Request $request)
    {
        try{
            $comment = new Comment;
            $comment->postId = $request->postId;
            $comment->userId = $request->userId;
            $comment->content = $request->content;
    
            $comment->save();

            return response()->json([
                'status' => 'success',
                'message' => 'comment posted',
            ], 200);
        }catch(\Throwable $th){
            return response()->json([
                'status' => 'failed',
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function updateComment($commentId, Request $request)
    {
        try{
           $comment = Comment::find($commentId);
           $comment->content = $request->content;
           
           $comment->update();

           return response()->json([
                'status' => 'success',
                'message' => 'comment updated',
           ], 200);
        }catch(\Throwable $th){
            return response()->json([
                'status' => 'failed',
                'message' => $th->getMessage(),
            ], 500);
        }
    }


}
