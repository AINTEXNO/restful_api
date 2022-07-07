<?php

namespace App\Exceptions;

use Exception;

class CommentNotFoundException extends Exception
{
    public function report()
    {

    }

    public function render()
    {
        return response()->json([
            'message' => 'Comment not found'
        ], 404);
    }
}
