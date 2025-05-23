<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MajorRequest extends FormRequest
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
    public function rules()
    {
        return [
            'title'                 => 'required|string|max:255',
            'description'           => 'nullable|string|max:300',
            'image'                 => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ];
    }
}
