<?php

namespace App\Http\Controllers;

use App\Exceptions\PostNotFoundException;
use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Services\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $service;

    public function __construct(CommentService $service)
    {
        $this->service = $service;
    }

    /**
     * @throws PostNotFoundException
     */
    public function store(StoreCommentRequest $request, Post $post)
    {
        $this->service->store($request, $post);

        return response()->json(['status' => true], 201);
    }

    public function delete($post, $comment)
    {
        $this->service->delete($post, $comment);

        return response()->json(['status' => true])->setStatusCode(201, 'Successful delete');
    }
}
