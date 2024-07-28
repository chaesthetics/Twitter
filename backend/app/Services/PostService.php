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

    public function post($request){
        try{
            if($request->image || $request->text){
                $data['user_id'] = $request->user_id;
                $data['text'] = $request->text;
                $data['image'] = $request->image;

                Post::create($data);
                return response()->json([
                    'status' => true,
                    'message' => 'Posted successfully',
                ], 200);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'Unable action',
                ], 400);
            }
        }catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function update($request, $postId)
    {
        try{
            $post = Post::find($postId);
            $post->update([
                'text' => $request->text,
                'image' => $request->image,
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Post Updated Succesfully',
            ], 200);
        }catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
    
}