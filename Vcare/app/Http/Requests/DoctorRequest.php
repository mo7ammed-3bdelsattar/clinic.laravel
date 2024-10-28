<?php

namespace App\Http\Requests;
use Toastr;

use Illuminate\Foundation\Http\FormRequest;

class DoctorRequest extends FormRequest
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
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:users,email',
            'phone'         => 'nullable|string',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'dates'         => 'nullable|min:3',
            'address'       => 'nullabe|string|min:5|max:100',
            'major_id'      => 'required|integer|exists:majors,id',
            'admin_id'       => 'required|integer|exists:admins,id',
        ];
        
    }
    
}
