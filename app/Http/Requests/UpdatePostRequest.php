<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'sometimes|between:5,240|unique:posts',
            'anons' => 'sometimes|between:5,240',
            'text' => 'sometimes|min:10',
            'tags' => 'nullable',
            'image' => 'sometimes|image|mimes:jpg,png|max:2048'
        ];
    }
}
