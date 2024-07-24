<?php

namespace App\Services;

use App\Models\Post;
class PostService
{
    public function delete($postId){
        try{
            $post = Post::find($postId);
            $post->delete();
            return response()->json([
                "status" => true,
                "message" => "Post Deleted Succesfully",
            ], 200);
        }catch(\Throwable $th){
            return response()->json([
                "status" => false,
                "message" => $th->getMessage(),
            ], 500);
        }
    }
    
}