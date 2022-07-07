<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|between:5,240|unique:posts',
            'anons' => 'required|between:5,240',
            'text' => 'required|min:10',
            'tags' => 'nullable',
            'image' => 'required|image|mimes:jpg,png|max:2048'
        ];
    }
}
