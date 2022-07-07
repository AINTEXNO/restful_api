<?php

namespace App\Services;

use App\Exceptions\PostNotFoundException;
use App\Models\Post;
use App\Traits\NotfoundPostTrait;
use App\Traits\StoreFileTrait;

class PostService
{
    use StoreFileTrait;
    use NotfoundPostTrait;

    public function store($request)
    {
        $file = $request->file('image');

        $request = collect($request->all());
        $replacedRequest = $request->replace(['image' => $this->storeFile($file)]);

        return Post::create($replacedRequest->all());
    }

    /**
     * @throws PostNotFoundException
     */
    public function update($request, $post)
    {
        $this->notfound($post);

        $post = Post::find($post);
        $file = $request->file('image');

        if($file) {
            unlink(public_path("storage\post_images\\{$post->image}"));
            $request = collect($request->except(['image']));

            $post->image = $this->storeFile($file);
            $post->save();
        }

        $post->update($request->all());

        return $post;
    }

    /**
     * @throws PostNotFoundException
     */
    public function delete($post)
    {
        $this->notfound($post);
        $post->delete();
    }
}
