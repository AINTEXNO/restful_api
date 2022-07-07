<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StoreCommentRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        return [
            'author' => Rule::requiredIf(function () use ($request) {
                return !$request->bearerToken();
            }),
            'comment' => 'required|max:255'
        ];
    }
}
