<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\PostRequest;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
class PostController extends Controller
{
    public function post(PostRequest $request)
    {
        try{
            if($request->image || $request->text){
                $filename = null;

                if ($request->hasFile('image')) {
                    $filename = $request->getSchemeAndHttpHost() . '/assets/img/' . time() . '.' . $request->image->extension();
                    $request->image->move(public_path('/assets/img/'), $filename);
                }

                $data['user_id'] = $request->user_id;
                $data['text'] = $request->text;
                $data['image'] = $filename;

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

    public function getAllPost()
    {
        try{
            $allPost = Post::with('user')->get()->reverse()->values();
            return response()->json($allPost);
        }catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
