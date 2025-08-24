<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'currentPassword'=>['required',
            function ($attribute, $value, $fail) {
                if (!Hash::check($value, Auth::guard('admin')->user()?Auth::guard('admin')->user()->password:Auth::user()->password)) {
                    return $fail(__('The current password is incorrect.'));
                }
            },
        ],
            'password'=>'required|confirmed',
            'password_confirmation'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'password.required' => __('The password field is required.'),
            'password.confirmed' => __('The password confirmation does not match.'),
            'password_confirmation.required' => __('The password confirmation field is required.'),
            'currentPassword.required' => __('The current password field is required.'),
        ];
    }
}