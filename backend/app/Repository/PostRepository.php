<?php

namespace App\Repository;

use App\Models\Post;
use Faker\Test\Provider\Collection;
class PostRepository 
{
    public function get()
    {   
        try{
            $allPost = Post::with('user','like')->with('comment')->get()->reverse()->values();
            return $allPost;
        }catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}