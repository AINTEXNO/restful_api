<?php

namespace App\Exceptions;

use Exception;

class PostNotFoundException extends Exception
{
    public function report()
    {

    }

    public function render()
    {
        return response()->json([
            'message' => 'Post not found'
        ], 404);
    }
}
