<?php

namespace App\Http\Requests;

use App\Http\Requests\ApiRequest;

class RegisterRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|between:2,30',
            'surname' => 'required|between:2,30',
            'patronymic' => 'required|between:2,30',
            'login' => 'required|between:2,30|unique:users',
            'email' => 'required|between:2,50|unique:users',
            'password' => 'required|between:5,30'
        ];
    }
}
