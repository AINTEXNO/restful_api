<?php

namespace App\Services;

use App\Exceptions\CommentNotFoundException;
use App\Exceptions\PostNotFoundException;
use App\Models\Comment;
use App\Models\Post;
use App\Traits\NotfoundPostTrait;

class CommentService
{
    use NotfoundPostTrait;

    /**
     * @throws CommentNotFoundException
     */
    public function commentNotfound($comment)
    {
        try {
            Comment::findOrFail($comment);
        }
        catch (\Exception $exception) {
            throw new CommentNotFoundException();
        }
    }

    /**
     * @throws PostNotFoundException
     */
    public function store($request, $post)
    {
        $this->notfound($post->id);

        $validated = $request->validated();
        $validated['post_id'] = $post->id;

        Comment::create($validated);
    }

    public function delete($post, $comment)
    {
        $this->notfound($post);
        $this->commentNotfound($comment);

        $comment = Comment::find($comment);

        $comment->delete();
    }
}
