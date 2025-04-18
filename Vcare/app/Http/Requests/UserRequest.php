<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public static function rules()
    {
        return [
            'name'                => 'required|string|max:255',
            'email'               => 'required|email|unique:users,email',
            'phone'               => 'nullable|string',
            'gender'              => 'nullable|boolean',
            'type'                => 'required|int',
            'image'               => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password'            => 'required|string|min:6',
        ];
    }
}
