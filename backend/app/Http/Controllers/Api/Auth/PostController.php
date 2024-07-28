<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\PostRequest;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Repository\PostRepository;
use App\Services\PostService;
class PostController extends Controller
{
    private $postRepository;
    private $postService;
    public function __construct(PostRepository $postRepository, PostService $postService)
    {
        $this->postRepository = $postRepository;
        $this->postService = $postService;
    }

    public function post(PostRequest $request)
    {
        $response = $this->postService->post($request);

        return $response;
    }

    public function getAllPost()
    {
        $posts = $this->postRepository->get();
            
        return response()->json($posts);
    }

    public function update(PostRequest $request, $postId)
    {
       $response = $this->postService->update($request, $postId);

       return $response;
    }

    public function deletePost($postId)
    {
        $response = $this->postService->delete($postId);

        return $response;
    }
}
