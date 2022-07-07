<?php

namespace App\Traits;

use App\Exceptions\PostNotFoundException;
use App\Models\Post;

trait NotfoundPostTrait
{
    /**
     * @throws PostNotFoundException
     */
    public function notfound($post)
    {
        try {
            Post::findOrFail($post);
        }
        catch (\Exception $exception) {
            throw new PostNotFoundException();
        }
    }
}
