<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
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
            'doctor_id'         => 'required|exists:doctors,id',
            'date'              => 'required|numeric|in:1,2,3,4,5,6,7',
            'start_at'          => 'required|date_format:H:i',
            'end_at'            => 'required|date_format:H:i|after:start_at',
        ];
    }
}
