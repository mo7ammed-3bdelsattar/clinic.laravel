<?php

namespace App\Http\Requests;
use Toastr;

use Illuminate\Validation\Rule;
use App\Http\Requests\UserRequest;
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
        $userRules = UserRequest::rules(); 
        $doctorRules = [
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore(($this->doctor)?$this->doctor->user:null),
            ],
            'price' => 'required|numeric',
            'address'=> 'required|string',
            'major_id' => 'required|exists:majors,id',
        ];

        return array_merge($userRules, $doctorRules);
        
    }
    
}
