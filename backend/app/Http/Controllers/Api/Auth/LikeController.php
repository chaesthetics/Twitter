<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Like;
use App\Services\LikeService;
class LikeController extends Controller
{
    private $likeService;

    public function __construct(LikeService $likeService)
    {
        $this->likeService = $likeService;
    }
    public function like(Request $request)
    {
        $response = $this->likeService->create($request);

        return $response;
    }

    public function unlike(Request $request)
    {
     $response = $this->likeService->destroy($request);

     return $response;
    }
}
