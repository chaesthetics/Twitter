<?php 

namespace App\Services;
use App\Models\Like;
class LikeService
{
    public function create($request)
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

    public function destroy($request)
    {
        try{
            $like = Like::where('user_id', $request->user_id)->where('post_id', $request->post_id);
            $like->delete();

            return response()->json([
                'status' => true,
                'message' => "Post unliked",
            ], 200);
        }catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}