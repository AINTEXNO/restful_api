<?php

namespace App\Http\Controllers;

use App\Exceptions\PostNotFoundException;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    protected $service;

    public function __construct(PostService $service)
    {
        $this->service = $service;
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     * Получение всех постов
     */
    public function index()
    {
        $posts = Post::all();
        return PostResource::collection($posts);
    }

    /**
     * @param $post
     * @return JsonResponse|object
     * @throws PostNotFoundException
     * Получение одного поста
     */
    public function show($post)
    {
        $this->service->notfound($post);

        return new PostResource(Post::find($post));

        // TODO вывод комментариев в ответе
    }

    /**
     * @param StorePostRequest $request
     * @return JsonResponse
     * Создание постов
     */
    public function store(StorePostRequest $request)
    {
        $createdPost = $this->service->store($request);

        return response()->json(["status" => true, "post_id" => $createdPost->id], 201);
    }

    /**
     * @throws PostNotFoundException
     */
    public function update(UpdatePostRequest $request, $post): array
    {
        $updatedPost = $this->service->update($request, $post);

        return [
            'status' => true,
            'post' => new PostResource($updatedPost)
            ];
    }

    /**
     * @param $tag
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     * Поиск постов по тегу
     */
    public function search($tag)
    {
        $posts = Post::where('tags', 'LIKE', "%{$tag}%")->get();

        return PostResource::collection($posts);
    }

    /**
     * @param $post
     * @return JsonResponse
     * @throws PostNotFoundException
     * Удаление поста
     */
    public function delete($post)
    {
        $this->service->delete($post);

        return response()->json(['status' => true], 201);
    }
}
